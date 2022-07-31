<?php

   namespace trendoman\CmsFu;

   /*  ADDON: Find and register `<cms:func>` from a snippet
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   04.07.2022
   */
   if( is_file(__DIR__.'/config.php') === false ){
      echo 'Error: Addon "func-on-demand" could not open "config.php"';
      error_log( 'Error: Addon "func-on-demand" could not open config: '.__DIR__.'/config.php' );
      return;
   }
   require_once(__DIR__.'/config.php');

   class Autoload {

      static $known_files = array();
      static $f_extension = FOD_FILE_EXTENSION;

      static function add_dir( /*string*/ $path )
      {
         if( false === ( $valid_dir = static::validate_path($path)) ) return;

         static::make_dir_traversable($valid_dir);
         static::set_tag_listener();
      }

      static function validate_path( /*string*/ $path )
      {
         $splFile = new \SplFileInfo($path);
         if(  false === $splFile->getRealPath() || !$splFile->isReadable() || !$splFile->isDir() )
         {
            // return false;
            error_log( "ERROR: \"func-on-demand\": Not readable path — \"" . $path . '"');
            die( "ERROR: \"func-on-demand\": Not readable path — \"" . $path . '"');
         }

         return $splFile->getRealPath();
      }

      static function set_tag_listener()
      {
         if( defined('FOD_ADD_LISTENER_DONE') ) return;

         global $FUNCS;
         $Class = get_called_class();

         $FUNCS->add_event_listener( 'alter_tag_call_execute', function($tag_name, $params, &$node) use ($FUNCS, $Class)
         {
            $func_name = trim( $params[0]['rhs'] );
            if( !$func_name || array_key_exists($func_name, $FUNCS->funcs) ){ return $stop_propagation = false; }

            $msg = '';
            $loaded = $Class::find_and_read($func_name);
            if( !$loaded )
            {
               $msg = $Class::file_not_found($func_name.'.'.$Class::$f_extension);
            }
            elseif( !array_key_exists($func_name, $FUNCS->funcs) )
            {
               $msg = $Class::func_not_available($func_name, $loaded);
            }

            if( trim($msg) != '' ){ $node->fod_addon_err_msg = $msg; }

            return $stop_propagation = false;
         }, 1000); //higher priority

         $FUNCS->add_event_listener( 'tag_call_executed', function($tag_name, $params, $node, &$html)
         {
            if( isset($node->fod_addon_err_msg) ){ $html .= "\r\n<hr>Addon F.O.D.: ".$node->fod_addon_err_msg."<hr>"; }
         });

         define( 'FOD_ADD_LISTENER_DONE', 1 );
      }

      static function make_dir_traversable( /*string*/ $dir)
      {
         $Iterator = new \RecursiveDirectoryIterator( $dir, \FilesystemIterator::SKIP_DOTS );
         $Iterator = new \RecursiveIteratorIterator( $Iterator, \RecursiveIteratorIterator::LEAVES_ONLY );
         $Iterator = new \NoRewindIterator($Iterator);
         static::get_current_iterator()->append($Iterator);
      }

      static function get_current_iterator()
      {
         static $AppendIterator = null;
         if( is_null($AppendIterator) ){ $AppendIterator = new \AppendIterator(); }

         return $AppendIterator;
      }

      static function find_and_read( /*string*/ $func_name )
      {
         if( array_key_exists( $func_name, static::$known_files ) )
         {
            return static::read( static::$known_files[$func_name] );
         }
         $Iterator = static::get_current_iterator();
         foreach ($Iterator as $splFile)
         {
            $_ext = strrchr($splFile->getFilename(),'.');
            if (false === $_ext){ continue; }
            if( substr($_ext, 1) !== static::$f_extension ) continue;

            $cur_func = $splFile->getBasename( '.'.static::$f_extension );
            static::$known_files[$cur_func] = $splFile;
            if( $cur_func != $func_name ){continue;}

            $Iterator->next();
            return static::read( static::$known_files[$func_name] );
         }

         return false;
      }

      static function file_not_found( /*string*/ $func_name )
      {
         return("ERROR: Could not locate file \"$func_name\"");
      }

      static function func_not_available( /*string*/ $func_name, $path )
      {
         $path = str_replace('\\', '/', $path);
         $path = str_replace(K_SITE_DIR, '', $path);
         return('ERROR: File "'.$path.'" does not contain a func "'.$func_name.'"');
      }

      static function read( \SplFileInfo $splFile )
      {
         $filepath = $splFile->getRealPath();
         $html = @file_get_contents( $filepath );
         if( false === $html )
         {
            error_log('Error reading file: ' . htmlspecialchars( $filepath ));
            die('Error reading file: ' . htmlspecialchars( $filepath ));
         }
         $html = preg_replace( $pattern='/<cms:ignore\s*>[\s\S]*?<\/cms:ignore\s*>/', $replacement='', trim($html) );
         if( false === strpos($html, '<cms:func') ) return $filepath;

         $parser = new \KParser( $html );
         if( FOD_USE_COUCHCACHE && K_CACHE_OPCODES ){
            $html = $parser->get_cached_HTML( $filepath );
         }
         else{
            $html = $parser->get_HTML();
         }

         return true;
      }

   } // end Class

   class AutoloadFiltered extends Autoload {

      static function make_dir_traversable( /*string*/ $dir)
      {

         $Iterator = new \RecursiveDirectoryIterator( $dir, \FilesystemIterator::SKIP_DOTS );
         $ExFilter = new \trendoman\CmsFu\SimpleExtensionFilter($Iterator);
         $Iterator = new \RecursiveIteratorIterator( $ExFilter, \RecursiveIteratorIterator::LEAVES_ONLY );
         $Iterator = new \NoRewindIterator($Iterator);
         $Iterator->getInnerIterator()->rewind();
         static::get_current_iterator()->append($Iterator);
      }
   } // end Class

   class SimpleExtensionFilter extends \RecursiveFilterIterator {

      public function __construct ( \RecursiveIterator $iterator )
      {
         $this->f_extension = ( $ext=AutoloadFiltered::$f_extension ) ? $ext : FOD_FILE_EXTENSION;
         parent::__construct($iterator);
      }

      public function accept()
      {
         $name = $this->current()->getFilename();
         if ($name[0] === '.'){ return false; }
         if( !$this->current()->isDir() )
         {
            $_ext = strrchr($name, '.');
            if (false === $_ext){ return false; }
            $extn = substr($_ext, 1);
            if( $extn !== $this->f_extension ){ return false; }
         }
         return true;
      }
   } // end Class

   class Preload extends AutoloadFiltered {

      static function add_funcs_from_config (/* string */ $config_paths)
      {
         if( file_exists(__DIR__.'/'.$config_paths) ){ $funcs = include($config_paths); }
         if( !is_array($funcs) || !count($funcs) ) return;

         foreach($funcs as $func_name => $path)
         {
            $path = K_SITE_DIR . ltrim($path, "\/");
            $splFile = new \SplFileInfo($path);
            $filepath = $splFile->getRealPath();
            if( false === $filepath ) continue;
            if( true === array_key_exists( $func_name, static::$known_files ) ) continue;

            static::$known_files[$func_name] = $splFile;

            /* Following ::read() is optional;
             * helps with funcs that require other funcs –
             * when the required one is wrapped in otherwise
             * dead-end condition: (if 'cms:func_exists')
             */
            static::read( $splFile ); // optional force embed?
         }
      }

      static function get_funcs_from_cachefile ()
      {
         if( !defined('FOD_CACHE_FILE') ){ return false; }

         $cachefile = __DIR__.DIRECTORY_SEPARATOR.FOD_CACHE_FILE;
         if( !is_readable($cachefile) ){ return; }

         $lines = file($cachefile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
         $line_md4 = array_pop($lines);
         $line_src = array_pop($lines);
         $hash = strtr( $line_md4, array('VALIDATE_HASH:' => '') );
         $rehash = hash('md4', $line_src );
         if( $hash === $rehash ){ return $line_src; }
         else {@unlink($cachefile); return false;}
      }

      static function add_funcs_from_cachefile ()
      {
         global $FUNCS;
         if( false === $cache = static::get_funcs_from_cachefile() ){ return false; }

         $cache = str_replace('\\ ', '', $cache);
         if( function_exists('hex2bin') ){ $cache = hex2bin($cache); }
         else { $cache = pack("H*" , $cache); }
         $cache = gzinflate( $cache );
         $funcs = unserialize( $cache );

         if( !is_array($funcs) ){ return; }
         if( !is_array($FUNCS->funcs) ){ $FUNCS->funcs = array(); }

         $FUNCS->funcs = array_merge( $FUNCS->funcs, $funcs);
         if( count($FUNCS->funcs) ){ return true; }

         return false;
      }

      static function save_funcs_to_cachefile ()
      {
         global $FUNCS;

         if( !defined('FOD_CACHE_FILE') || !is_writable(__DIR__) ){ return false; }
         if( !is_array($FUNCS->funcs)   || !count($FUNCS->funcs) ){ return 0; }

         $cachefile_name = __DIR__.DIRECTORY_SEPARATOR.FOD_CACHE_FILE;
         $tmp_name = $cachefile.'.tmp';
         $funcs_signatures = array();
         $funcs_reference = '';

         $cache = serialize( $FUNCS->funcs );
         $cache = gzdeflate( $cache, 5 ); // 1:fastest
         $cache = bin2hex( $cache );
         $cache = chunk_split($cache, 76, '\\ ');

         foreach( $FUNCS->funcs as $name=>$func )
         {
            $args = '';
            array_walk( $func['params'], function ($v, $k) use (&$args) { $args .= "$k='$v' "; } );
            $funcs_signatures[$name] = "<cms:func '$name' $args />";
         }
         ksort($funcs_signatures);

         foreach($funcs_signatures as $func_name => $signature)
         {
            $funcs_reference .= PHP_EOL."### {$func_name}".PHP_EOL;
            $funcs_reference .= PHP_EOL."```xml".PHP_EOL.$signature.PHP_EOL."```".PHP_EOL;
         }

         $header = <<<MARKDOWN
# FOD cache

This file is part of the addon [***FUNCS-ON-DEMAND***](https://github.com/trendoman/Tweakus-Dilectus/tree/main/anton.cms@ya.ru__func-on-demand) for CouchCMS.

Content is **GENERATED AUTOMATICALLY** and has `<cms:func>` functions in their parsed state.

**IT IS SAFE TO DELETE** this file, it can be re-created using tag —

```xml
<cms:gen_func_cache />
```

## Content

{$funcs_reference}

---

MARKDOWN;

         $content = "$header\n$cache\nVALIDATE_HASH:".hash('md4', $cache);
         @unlink($tmp_name);

         if( true === is_file($cachefile_name) ){ @unlink($cachefile_name); }
         if( true === is_file($tmp_name) ){ @unlink($tmp_name); }
         if( strlen($content) === file_put_contents($tmp_name, $content, LOCK_EX) )
         {
            rename($tmp_name, $cachefile_name); // Atomic
         }

         @unlink($tmp_name);

         return count($funcs_signatures);
      }

   } // end Class

   $FUNCS->register_tag( 'gen_func_array', function ($params, $node)
   {
      $ClassName = '\trendoman\CmsFu\Preload';
      if( !class_exists($ClassName) || (!is_subclass_of($ClassName, '\trendoman\CmsFu\AutoloadFiltered')) ) return;

      $funcs = array();
      $path = trim($params[0]['rhs']);

      if( $path == '' || false===strpos($path, K_SITE_DIR) )
      {
         return('<h2>Error: "&lt;cms:gen_func_array&gt;": full disk path expected starting with "'.K_SITE_DIR.'". Try &lt;cms:gen_func_array path=k_site_path /&gt;</h2>');
      }

      $ClassName::add_dir($path);
      if( false === $ClassName::find_and_read('-') )
      {
         foreach( $ClassName::$known_files as $func_name => $splFile )
         {
            $dir = str_replace('\\', '/', $splFile->getRealPath());
            $dir = str_replace(K_SITE_DIR, '', $dir);
            $funcs[$func_name] = $dir;
         }
         asort($funcs);

         echo "<h3>Copy-paste the code below into ".str_replace('\\', '/', __DIR__)."/config-paths.php</h3>";
         echo "<hr><pre>&lt;?php<br><br>return<br>",var_export($funcs),";<br><br><hr></pre>";
      }
      return;
   });

   $FUNCS->register_tag( 'gen_func_cache', function ($params, $node)
   {
      $ClassName = '\trendoman\CmsFu\Preload';
      if( !class_exists($ClassName) || (!is_subclass_of($ClassName, '\trendoman\CmsFu\Autoload')) ) return;

      $funcs = array();
      $path = trim($params[0]['rhs']);

      if( !defined('FOD_CACHE_FILE') )
      {
         return('<h2>Error: "&lt;cms:gen_func_cache&gt;": must have defined "FOD_CACHE_FILE" constant.</h2>');
      }
      $count = $ClassName::save_funcs_to_cachefile();
      if( false === $count ){ return('<h3>Error: &lt;cms:gen_func_cache&gt;: attempt unsuccessful. Is dir writeable?</h3>'); }
      if( 0 === $count ){ return('<h3>Error: &lt;cms:gen_func_cache&gt;: attempt unsuccessful. Couch doesn\'t know any func.</h3>'); }
      return "OK (".$count.")";
   });


   if( !defined('FOD_FILE_EXTENSION') ) { die('FOD addon: Must define FOD_FILE_EXTENSION in config.php'); }

   if( defined('FOD_PRELOAD_PATHS') && FOD_PRELOAD_PATHS == 1 )
   {
      \trendoman\CmsFu\Preload::add_funcs_from_config('config-paths.php');
   }
   if( defined('FOD_CACHE_FILE_ON') && FOD_CACHE_FILE_ON == 1 )
   {
      if( !defined('FOD_CACHE_FILE') ) { die('FOD addon: Must define FOD_CACHE_FILE in config.php'); }
      \trendoman\CmsFu\Preload::add_funcs_from_cachefile();
   }

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
