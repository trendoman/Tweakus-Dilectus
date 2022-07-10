<?php

   /**
   *   Delete a file or remove PHP's error_log
   *
   *   @example <cms:delete_file 'log.txt' />
   *   @example <cms:delete_file '@php' />
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   09.07.2022
   */

   namespace trendoman;

   if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

   class FileTags {

      static function tag_delete_file_processor($params, $node)
      {
         global $AUTH;
         if( $AUTH->user->access_level < K_ACCESS_LEVEL_ADMIN ){  return; }

         $filename = trim($params[0]['rhs']);

         if( $filename == '@php' ){
            if( file_exists(ini_get('error_log')) ) @unlink(ini_get('error_log'));
            return;
         }

         if( file_exists(K_SITE_DIR . $filename) ) @unlink(K_SITE_DIR . $filename);

         return;
      }

   }

   $FUNCS->register_tag( 'delete_file', array('\trendoman\FileTags', 'tag_delete_file_processor') );

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
