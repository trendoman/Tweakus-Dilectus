<?php

   /**
   *   Work with querystring arrays and '<cms:gpc>'
   *
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   19.07.2022
   */
   $FUNCS->add_event_listener( 'alter_tag_gpc_execute', function($tag_name, $params, $node, &$html){
         global $FUNCS;
         if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}

         extract( $FUNCS->get_named_vars(
                     array(
                           'var'=>'',
                           'method'=>'', /* get/post/cookie */
                           'strip_tags'=>'1',
                           'default'=>'',
                           ),
                     $params)
                );

         $var = trim( $var );
         $method = strtolower( trim($method) );
         if( !in_array($method, array('get', 'post', 'cookie')) ){ $method=''; }
         $strip_tags = ( $strip_tags==0 ) ? 0 : 1;
         $has_default = ( strlen($default) ) ? 1 : 0;

         switch( $method ){
             case 'get':
                 $method = $_GET;
                 $no_xss_check = 1;
                 break;
             case 'post':
                 $method = $_POST;
                 break;
             case 'cookie':
                 $method = $_COOKIE;
                 break;
             default:
                 $method = $_REQUEST;
         }

         if( isset($method[$var]) ){
             $val = $method[$var];
             $val = is_array( $val ) ? $FUNCS->json_encode($val) : trim($val);
             if( !$no_xss_check ){
                 $val = $FUNCS->cleanXSS( $val );
                 if( $strip_tags ){ $val = strip_tags($val); }
             }
         }
         if( $has_default && !strlen($val) ){ $val = $default; }

         $html = $val;
         return 1; // skip orig tag
    });

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
