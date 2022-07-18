<?php

   /**
   *   Echo PHP_EOL
   *
   *   @example <cms:eol />
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   10.07.2022
   */

   if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

   $FUNCS->register_tag( 'eol', function(){
      return PHP_EOL;
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
