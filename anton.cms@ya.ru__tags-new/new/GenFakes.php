<?php

    namespace com\couchadmin;

    /**
    *   @example <cms:new />
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   15.07.2020
    *   @last   12.07.2022
    */

    class GenFakes {

        const DEFAULT_LOCALE = 'en_US';

        private static $instance;

        public $faker;
        public $current_locale = '';
        public $localized_fakers = array();

        public static $anon_func = array();

        private function __construct(){
            if( !class_exists('\Faker\Factory') ) require( __DIR__ . '/~vendor/autoload.php');
            $this->current_locale = $this::DEFAULT_LOCALE;
        }

        public static function getInstance(){
            if( is_null(self::$instance) ) self::$instance = new self();

            return self::$instance;
        }

        public function init($locale = self::DEFAULT_LOCALE){

            $locale = filter_var($locale, FILTER_SANITIZE_STRING);
            $this->current_locale = preg_match("/^[A-Za-z]{2,4}([_-][A-Za-z]{4})?([_-]([A-Za-z]{2}|[0-9]{3}))?$/", $locale) ? $locale : $this::DEFAULT_LOCALE;

            if( empty($this->localized_fakers[$this->current_locale]) ){
                $this->localized_fakers[$this->current_locale] = \Faker\Factory::create($this->current_locale);
            }
            $this->faker =& $this->localized_fakers[$this->current_locale];

            return $this->faker;
        }

        public function triage_tag_params( array $params){

            $tag_attributes = array(
                'hinted'=>array(),
                // ex: param='1'
                'noname'=>array(),
                // ex: '1'
                'reserved'=>array('formatter'=>'', 'locale'=>'', 'unique'=>'', 'reset'=>'', 'optional'=>'', 'default'=>'', 'validator'=>'', 'seed'=>'')
            );

            foreach($params as $param){
                $value = is_array($param['rhs']) ? $param['rhs'] : trim($param['rhs']);
                if( empty($param['lhs']) ){
                    $tag_attributes['noname'][] = $value;
                } else {
                    $tag_attributes['hinted'][strtolower($param['lhs'])] = $value;
                }
            }

            $tag_attributes['reserved'] = array_merge($tag_attributes['reserved'], $tag_attributes['hinted']);
            $formatter =& $tag_attributes['reserved']['formatter'];
            if( !$formatter ) $formatter = array_shift($tag_attributes['noname']);

            $this->current_locale = $tag_attributes['reserved']['locale'];
            $validator =& $tag_attributes['reserved']['validator'];
            if( !empty($validator['code']) ) $this::$anon_func = $validator;

            return $tag_attributes;
        }

        public static function tag_processor( array $params, \KNode $node ){

            $GF = self::getInstance();
            $tag_attributes = $GF->triage_tag_params($params); // updates locale
            $faker = $GF->init( $GF->current_locale );
            if( count($params) === 0 ) return $GF->show_user_help();

            // 'formatter'=>'', 'locale'=>'', 'unique'=>'', 'reset'=>'', 'optional'=>'', 'default'=>'', 'validator'=>'', 'seed'=>''
            extract( $tag_attributes['reserved'] );

            $seed = (int) $seed;
            if( $seed ){
                $faker->seed($seed);
                return;
            }

            $default = empty($default) ? null : $default;
            $optional = (strpos($optional, '%') !== false) ? (int) str_replace('%', '', $optional) : filter_var( $optional, FILTER_VALIDATE_BOOLEAN);
            $reset = filter_var( $reset, FILTER_VALIDATE_BOOLEAN);
            $unique = filter_var( $unique, FILTER_VALIDATE_BOOLEAN);
            $weight = is_int($optional) ? $optional : 50;

            if( !$formatter ) die("ERROR: Tag '".$node->name."' &ndash; formatter missing! For help type: <pre>&lt;cms:".$node->name." /&gt;</pre>.");

            // Research formatter's signature
            $expected_args = array();
            try{
                $obj = $faker->getFormatter($formatter);
            } catch (\Exception $e) {
                $msg = "ERROR: Tag <b>cms:new</b> — re-check parameters syntax!";
                $msg.= "<p>Using formatter:";
                $msg.= "<pre>" . $formatter . "</pre>";
                $msg.= "<p>Print complete syntax reference by typing tag without params as in – <pre>&lt;cms:new /&gt;</pre>";
                $msg.= "<hr>";
                $msg.= "<p>Error report:";
                $msg.= "<pre>" . $e->getMessage() . "</pre>";
                die( $msg );
            }

            $reflection = new \ReflectionMethod( get_class(array_shift($obj)), $formatter); // ($class, $method)
            foreach($reflection->getParameters() as $input){
                $arr = array();
                if( $input->isDefaultValueAvailable() ){
                    $arr['type'] = strtolower(gettype($input->getDefaultValue()));
                    $arr['default_value'] = $input->getDefaultValue();
                } else {
                    $arr['type'] = 'mixed';
                }
                $expected_args[strtolower($input->name)] = $arr;
            }

            // Build matching arguments types
            $method_attributes = array();
            foreach( $expected_args as $expected_name=>$details ){
                $attr = isset($tag_attributes['hinted'][$expected_name]) ? $tag_attributes['hinted'][$expected_name] : array_shift($tag_attributes['noname']);
                if( null === $attr && !empty($details['default_value']) ) $attr = $details['default_value'];

                switch($details['type']){
                    case 'boolean':
                        $method_attributes[] = filter_var( $attr, FILTER_VALIDATE_BOOLEAN);
                        break;

                    case 'integer':
                        if( $attr=='' && !empty($details['default_value']) ) $attr = $details['default_value'];
                        $method_attributes[] = (int) $attr;
                        break;

                    case 'array':
                        if( is_string($attr) ) $attr = json_decode($attr, true);
                        if( is_array($attr) ) $method_attributes[] = $attr;
                        else $method_attributes[] = null;
                        break;

                    case 'null':
                        if( $attr=='' && !empty($details['default_value']) ) $attr = $details['default_value'];
                        if( $attr=='' ) $method_attributes[] = NULL;
                        break;

                    case 'string':
                    case 'mixed':
                    default:
                        $method_attributes[] = $attr;
                }
            }

            // Intercept warnings during format
            set_error_handler( function(int $errno, string $errstr){
                throw new \Exception($errstr);
            }, E_WARNING);
            try {
                if( $unique ){
                    $result = call_user_func_array( array($faker->unique($reset), $formatter), $method_attributes );
                } elseif( $optional ) {
                    $result = call_user_func_array( array($faker->optional($weight, $default), $formatter), $method_attributes );
                } elseif( $validator ) {
                    $result = call_user_func_array( array($faker->valid( array( $GF, 'callable_validator'), $max_retries = 1000 ), $formatter), $method_attributes );
                } else {
                    $result = call_user_func_array( array($faker, $formatter), $method_attributes );
                }
            } catch (\Exception $e) {
                $msg = "ERROR: Tag <b>cms:new</b> – re-check parameters syntax!";
                $msg.= "<p>Using formatter:";
                $msg.= "<pre>" . $formatter . "</pre>";
                $msg.= "<p>Passed params:";
                $msg.= "<pre>" . "&lt;cms:new ";
                $msg.= implode(" ", array_map(function($v) {return empty($v['lhs']) ? "'".(is_array($v['rhs'])?'Array':$v['rhs'])."'" : $v['lhs']."='".(is_array($v['rhs'])?'Array':$v['rhs'])."'";},$params));
                $msg.= "/&gt;" . "</pre>";
                $msg.= "<p>Expected params:";
                $msg.= "<pre>" . "&lt;cms:new '".$formatter."' ";
                $msg.= implode(" ", array_map(function($v) {return $v."=''";},array_keys($expected_args)));
                $msg.= "/&gt;" . "</pre>";
                $msg.= "<p>Print complete syntax reference by typing tag without params as in &ndash; <pre>&lt;cms:new /&gt;</pre>";
                $msg.= "<hr>";
                $msg.= "<p>Error report: ".$e->getMessage();
                die( $msg );
            }
            restore_error_handler();

            // All ok
            switch( gettype($result) ){
                case 'array':
                    return json_encode($result);
                case 'string':
                    return trim($result);
                case 'object':
                    if( $result instanceof \DateTime ) return $result->format('Y-m-d H:i:s');
            }

            return $result;
        }


        public static function callable_validator($value){
            global $TAGS;

            $node = new \KNode( K_NODE_TYPE_TEXT );
            $params = array( 0 => array('lhs' => NULL, 'op' => "=", 'rhs' => static::$anon_func) );
            $params[0]['rhs']['params']['new_value'] = $value;
            return filter_var( $TAGS->call($params, $node), FILTER_VALIDATE_BOOLEAN );
        }


        public function documentor(){
            $providers = array_reverse($this->faker->getProviders());
            $providers[] = new \Faker\Provider\Base($this->faker);
            $formatters = array();
            foreach ($providers as $provider) {
                $providerClass = get_class($provider);
                $refl = new \ReflectionObject($provider);
                foreach ($refl->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflmethod) {
                    if ($reflmethod->getDeclaringClass()->getName() == 'Faker\Provider\Base' && $providerClass != 'Faker\Provider\Base') {
                        continue;
                    }
                    if ($reflmethod->isConstructor()) {
                        continue;
                    }
                    $methodName = $reflmethod->name;
                    if( in_array( $methodName, array(
                        'optional',
                        'unique',
                        'valid',
                        'calculateRoutingNumberChecksum' // problematic source
                    ) ) ) continue;
                    $shortClassName = $reflmethod->getDeclaringClass()->getShortName();
                    $parameters = array();
                    foreach ($reflmethod->getParameters() as $reflparameter) {
                        $parameter = $reflparameter->getName();
                        if ($reflparameter->isDefaultValueAvailable()) {
                            $parameter .= "='".(is_array($reflparameter->getDefaultValue())?json_encode($reflparameter->getDefaultValue()):$reflparameter->getDefaultValue())."'";
                        } else {
                            $parameter .= "=''";
                        }
                        $parameters[] = $parameter;
                    }
                    $parameters = $parameters ? join(' ', $parameters) : '';
                    $formatters[$shortClassName][$methodName] = $parameters;
                }
            }
            ksort($formatters);

            return $formatters;
        }


        public function show_user_help(){
            global $FUNCS;

            return $FUNCS->render('tag-new-helper');
        }


        public static function ctx_setter(){
            global $CTX;
            $GF = self::getInstance();
            $CTX->set('k_render_vars', array('formatters'=>$GF->documentor()) );
        }

    }

    $FUNCS->register_tag( 'new', array('\com\couchadmin\GenFakes', 'tag_processor') );
    $FUNCS->add_event_listener( 'register_renderables', function (){
        global $FUNCS;
        $theme_dir = str_replace('\\', '/', realpath(__DIR__)) . "/theme/";
        $FUNCS->register_render( 'tag-new-helper', array('template_path'=>$theme_dir, 'template_ctx_setter'=>array('\com\couchadmin\GenFakes', 'ctx_setter')) );
    });
