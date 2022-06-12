<?php

   /**
   *   New variable to list available tags
   *
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   12.06.2022
   */

   $FUNCS->add_event_listener( 'add_render_vars', function () {
      global $CTX, $FUNCS, $TAGS;

      $tags = $core_tags = $plug_tags = $all__tags = array();
      $core_tags = array_values( get_class_methods($TAGS) );
      $plug_tags = array_keys( $FUNCS->tags );
      $all__tags = array_merge( $core_tags, $plug_tags );

      foreach( $all__tags as $tag ){
         if( $tag[0] == '_' ) continue(1);
         if( $tag[0] == 'k' && $tag[1] == '_'  ) $tag = substr( $tag, 2 );
         $tags[] = $tag;
      }
      sort( $tags );

      $CTX->set('k__tags', $tags, 'global' );
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
