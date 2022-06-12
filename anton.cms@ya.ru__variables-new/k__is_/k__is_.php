<?php

   /**
   *   Add "k__is_superadmin", "k__is_admin" etc. to the global context.
   *
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   11.06.2022
   */

   $FUNCS->add_event_listener( 'add_render_vars', function () {
      global $CTX, $AUTH;
      $access_level = array($AUTH->user->access_level => true);

      $k__is = array(
            'k__is_superadmin' => isset( $access_level[ K_ACCESS_LEVEL_SUPER_ADMIN ] )
         ,  'k__is_admin' => isset( $access_level[ K_ACCESS_LEVEL_ADMIN ] )
         ,  'k__is_user' => isset( $access_level[ K_ACCESS_LEVEL_AUTHENTICATED ] ) || isset( $access_level[ K_ACCESS_LEVEL_AUTHENTICATED_SPECIAL ])
         ,  'k__is_anon' => isset( $access_level[ K_ACCESS_LEVEL_UNAUTHENTICATED ] )
       );
       $CTX->set_all($k__is, 'global');
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
