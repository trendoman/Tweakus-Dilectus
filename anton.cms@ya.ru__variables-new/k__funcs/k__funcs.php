<?php

   /**
   *   New variable to list available funcs
   *
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   13.07.2022
   */

   $FUNCS->add_event_listener( 'add_render_vars', function () {
      global $CTX, $FUNCS, $TAGS;

      $funcs_signatures = array();
      foreach( $FUNCS->funcs as $name=>$func )
      {
         $args = '';
         array_walk( $func['params'], function ($v, $k) use (&$args) { $args .= "$k='$v' "; } );
         $funcs_signatures[$name] = "<cms:call '$name' $args />";
      }
      ksort($funcs_signatures);

      $CTX->set('k__funcs', $funcs_signatures, 'global' );
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

