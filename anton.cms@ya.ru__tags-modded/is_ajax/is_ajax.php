<?php

   /**
   *   Ajax calls may be checked for 'local_only'
   *   @author Anton aka Trendoman <tony.smirnov@gmail.com>
   *   @date   26.06.2022
   */

   $FUNCS->add_event_listener( 'tag_is_ajax_executed', function($tag_name, &$params, $node, &$html){
      if( $html == '0' ) return;

      global $FUNCS;
      extract( $FUNCS->get_named_vars(
                 array(
                        'local_only'=>'0'
                       ),
                 $params)
            );

      if( trim($local_only) == '1' ){
         if( $_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR'] )
         $html = '0';
      }
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
