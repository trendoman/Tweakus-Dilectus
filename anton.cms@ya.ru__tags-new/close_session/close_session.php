<?php

   /**
   *   Close session
   *
   *   @example <cms:close_session />
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   10.07.2022
   */

   namespace trendoman;

   if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

   $FUNCS->register_tag( 'close_session', function(){
      if(!session_id()) @session_start();
      session_write_close();
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
