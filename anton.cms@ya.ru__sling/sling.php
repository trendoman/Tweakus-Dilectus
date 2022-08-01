<?php

   namespace trendoman;

   /**
   * ADDON:  "SLING"
   * @author "Anton S" <anton.cms@ya.ru>
   * @date   28.07.2022
   */

   class Sling {

      public function register ( $params, $func, $bind=1 )
      {
         global $FUNCS, $CTX, $DB;

         if( !session_id() ) session_start();
         $code = $FUNCS->funcs[$func];
         $code['name'] = $func;
         $context = new \KContext();
         foreach( $CTX->ctx as $k=>$v ){
            if( ! isset($v['_scope_']) ){ continue; }
            $context->ctx[] = array('name'=>$v['name'], '_scope_'=>$v['_scope_']);
         }

         $row = array(
               'bind'=>$bind,
               'session_id'=>session_id(),
               'user'=>$CTX->get('k_user_name'),
               'code'=>\gzdeflate(serialize($code), 3),
               'params'=>\gzdeflate(serialize($params), 3),
               'context'=>\gzdeflate(serialize($context), 3),
               'expiration_date'=>@date("Y-m-d H:00:00", strtotime(' +1 week'))
            );
         $DB->insert( A_TBL_SLING_JOBS, $row );
      }

      /**
      * Inspired by $GC->can_continue()
      */
      static function is_memory_ok ()
      {
         if( function_exists('memory_get_usage') )
         {
            $current_memory =  memory_get_usage(true) / 1024 / 1024 * 1.1;
            if( $current_memory >= 32 ){ error_log("Sling: memory limit (32) reached. Used: $current_memory"); return 0; }
         }
         return 1;
      }

      /**
      * Borrowed from $TAGS->call to avoid popping $CTX
      */
      static function call_ex ( $params )
      {
         global $FUNCS, $CTX;

         $name = trim( $params[0]['rhs'] );
         $func = $FUNCS->funcs[$name];
         array_shift( $params );
         $vars = $FUNCS->get_named_vars( $func['params'], $params );

         $CTX->set_all( $vars );
         $args = $named_args = array();
         for( $x=0; $x<count($params); $x++ ){
             if( $params[$x]['op']=='=' ){
                 if( $params[$x]['lhs'] ){
                     $named_args[$params[$x]['lhs']] = $params[$x]['rhs'];
                 }
                 $args[] = array( 'name'=>($params[$x]['lhs'])?$params[$x]['lhs']:'', 'val'=>$params[$x]['rhs'] );
             }
         }
         $CTX->set( 'k_func', $name );
         $CTX->set( 'k_args', $args );
         $CTX->set( 'k_named_args', $named_args ); // make available original arguments

         foreach( $func['code'] as $child ){
             $html .= $child->get_HTML();
         }

         return $html;
      }

      static function set_context ()
      {
         global $FUNCS, $PAGE, $CTX;

         if( 0 === count($CTX->ctx) )
         {
            $CTX->push( '__ROOT__' );
            $FUNCS->set_userinfo_in_context();
            $PAGE->set_context();

            $FUNCS->dispatch_event( 'add_render_vars' );
            if( K_THEME_NAME ){
                $FUNCS->dispatch_event( K_THEME_NAME.'_add_render_vars' );
            }
         }
         else{
            $CTX->push( '__NESTED_ROOT__' );
         }
      }

      /**
      * "array_merge_recursive_distinct"
      * @author Daniel <daniel (at) danielsmedegaardbuus (dot) dk>
      * @author Gabriel Sobrinho <gabriel (dot) sobrinho (at) gmail (dot) com>
      * https://www.php.net/manual/en/function.array-merge-recursive.php#92195
      */
      static function set_context_vars ( &$into, &$from )
      {
         $merged = $into;

         foreach ( $from as $key => &$value )
         {
          if ( 'k_' == substr($key, 0, 2) ) continue; // do not overwrite user or page info
          if ( is_array ( $value ) && isset ( $merged [$key] ) && is_array ( $merged [$key] ) )
          {
            $merged [$key] = self::set_context_vars ( $merged [$key], $value );
          }
          else
          {
            $merged [$key] = $value;
          }
         }
         return $merged;
      }

      static function process_tag_instances ()
      {
         global $FUNCS, $CTX, $TAGS, $DB;

         $session_id = session_id();
         if( !$DB->get_lock( "lock_sling_{$session_id}" ) ){ return; }

         //////////////////////////////////////////L O C K E D/////////////////////////////////////

         $cond = "`session_id` = '$session_id' AND `bind` = 1 ORDER BY `id` ASC LIMIT 25"; // greedy
         $rows = $DB->select( A_TBL_SLING_JOBS, array('`params`', '`context`', '`code`', '`id`'), $cond);

         if( empty ( $rows ) ){

         $cond = "`bind` = 0 LIMIT 1"; // lazy
         $rows = $DB->select( A_TBL_SLING_JOBS, array('`params`', '`code`', '`id`'), $cond );

         }

         if( empty ( $rows ) ){ return; }

         self::set_context();
         $CTXShared = null;

         foreach( $rows as $tag )
         {
            $id = $tag['id'];
            $func = unserialize( \gzinflate( $tag['code'] ) );
            $context= ( isset($tag['context']) ) ? unserialize( \gzinflate( $tag['context'] ) ) : $CTX;
            $params = unserialize( \gzinflate( $tag['params'] ) );
            $node = new \KNode( K_NODE_TYPE_TEXT );
            $html = '';

            if( false === array_key_exists($func['name'], $FUNCS->funcs) ){
               $FUNCS->funcs[$func['name']] = $func;
            }

            if( static::is_memory_ok() === 0 ){ continue; }

            // three variants of Context ordered by priority ASC:
            // 0. Initial — set before the loop
            // 1. Attached — is coming along with the tag
            // 2. Shared — updated within tag for the next tag in queue
            // "k_" vars set in (0) are not touched by (1) or (2).
            $CTX->ctx = self::set_context_vars( $CTX->ctx, $context->ctx );
            if( !is_null($CTXShared) ){
            $CTX->ctx = self::set_context_vars( $CTX->ctx, $CTXShared->ctx );
            }

            $CTX->push('__then__', 1);

            // "<cms:then>" connecting to known funcs behaves as a "<cms:call/>", so let's process their events
            $skip = $FUNCS->dispatch_event( 'alter_tag_call_execute', array('call', &$params, &$node, &$html) );
            if( !$skip ){
                $html = self::call_ex($params);
            }
            $FUNCS->dispatch_event( 'tag_call_executed', array('call', &$params, &$node, &$html) );

            $CTXShared = clone $CTX; // assign by value

            $cond = "`id` = $id";
            $DB->delete( A_TBL_SLING_JOBS, $cond ); // successfully completed tag
         }

         $DB->release_lock( "lock_sling_{$session_id}" );

         ///////////////////////////////////////U N L O C K E D////////////////////////////////////

         return;
      }

      static function _detach_admin_page_($html)
      {
         global $PAGE, $DB;

         // use admin-panel ?? to auto-clean stale jobs
         $cond = "`expiration_date` < '" . date('Y-m-d H:i:s') ."' LIMIT 250";
         $DB->delete( A_TBL_SLING_JOBS, $cond );

         $content_type_header = "Content-Type: text/html; charset=utf-8";
         self::_detach_page_($html, $PAGE, null, null, $content_type_header);
      }

      static function _detach_page_($html, $PAGE, $k_cache_file, $redirect_url, $content_type_header)
      {
         global $FUNCS, $DB;
         if( trim($redirect_url) !== '' ){ return; }

         $session_id = session_id();
         $cond = "`session_id` = '$session_id' OR `bind` = 0 LIMIT 1"; // lazy
         $res = $DB->select( A_TBL_SLING_JOBS, array('1'), $cond );
         if( empty($res) ){ return; }

         if( defined('K_IS_MY_TEST_MACHINE') ){
            $html .= "\n<!-- in: ".k_timer_stop()." -->\n";
            $html .= "\n<!-- Queries: ".$DB->queries." -->\n";
         }
         $html = \gzencode($html, 3);
         $length = strlen($html);

         if( function_exists('set_time_limit') ){ set_time_limit(0); }
         ignore_user_abort(true);

         header($content_type_header);
         header("Transfer-Encoding: gzip");
         header("Content-Encoding: gzip");
         header("Content-Length: ".$length);
         header("Connection: Close");

         while (ob_get_level() !== 0){ ob_end_clean(); }
         ob_start();
         echo $html;
         ob_end_flush();
         flush();

         if( $session_id ) session_write_close();
         if( is_callable('fastcgi_finish_request') ) { fastcgi_finish_request(); }
         $DB->commit(1);

         self::process_tag_instances();

         die();
      }

      /* Code defined by "<cms:then bind='0'>" executed by the user later
       * or "any" other visitor that happens to trigger final events. In
       * practice it allows parallel task execution. */
      static function tag_then_processor ($params, $node)
      {
         global $FUNCS, $TAGS;

         $bind = $func = '';
         foreach($params as $param){
            if($param['lhs']=='func') $func = is_string($param['rhs']) ? trim($param['rhs']) : '';
            if($param['lhs']=='bind') $bind = is_string($param['rhs']) ? trim($param['rhs']) : '';
         }
         if( $func == '' && is_string($params[0]['rhs']) ) $func = trim($params[0]['rhs']); /* only named */
         $bind = in_array( $bind, array("0", "all", "any", "anyone") ) ? 0 : 1;

         if( count($node->children) )
         {
            /* code becomes a new func */
            $func = 'then_'.md5($node->ID);
            $params = array();
            $params[] = array('lhs' => null, 'op' => null, 'rhs' => $func);
            $params[] = array('lhs' =>'bind', 'op' => null,'rhs' => $bind);
            if( false === array_key_exists($func, $FUNCS->funcs) ){
               $FUNCS->dispatch_event( 'alter_tag_func_execute', array('func', &$params, &$node, &$html) );
               $rs = $TAGS->func($params, $node);
               $FUNCS->dispatch_event( 'tag_func_executed', array('func', &$params, &$node, &$html) );
            }
         }

         if( true === array_key_exists($func, $FUNCS->funcs) ){
            self::register($params, $func, $bind);
         } else {
            die("Error: &lt;cms:then&gt; can't register func \"$func\"");
         }

         return;
      }

      static function tag_sleep_processor ($params, $node)
      {
         $timeout = trim($params[0]['rhs']);
         if( \filter_var($timeout, FILTER_VALIDATE_FLOAT, array('options' => array('min_range' => 0.01))) )
         {
            \usleep(1000*1000 * $timeout);
         }
         return;
      }

   } // end Class


   define( 'A_SLING_VERSION', '2.0728' );
   define( 'A_TBL_SLING_JOBS', K_DB_TABLES_PREFIX . 'sling_jobs' );

   // need installation?
   if( is_null( $FUNCS->get_setting( 'sling_version' ) ) ){
      require_once( __DIR__.'/install.php' );
   }

   $FUNCS->register_tag( 'then', array('\trendoman\Sling', 'tag_then_processor') );
   $FUNCS->register_tag( 'sleep', array('\trendoman\Sling', 'tag_sleep_processor') );
   $FUNCS->add_event_listener( 'alter_final_page_output', array('\trendoman\Sling', '_detach_page_'), -100);
   $FUNCS->add_event_listener( 'alter_final_admin_page_output', array('\trendoman\Sling', '_detach_admin_page_'), -100);

   /*
   // ~~~~~~~~~~~~~
   // Credits
   // ~~~~~~~~~~~~~
   // You should have downloaded this code from https://github.com/trendoman/Tweakus-Dilectus
   // ~~~~~~~~~~~~~
   // Support
   // ~~~~~~~~~~~~~
   // Write me at <anton.cms@ya.ru>, <tony.smirnov@gmail.com> "Anton S aka Trendoman"
   // Telegram: https://t.me/couchcms
   */
