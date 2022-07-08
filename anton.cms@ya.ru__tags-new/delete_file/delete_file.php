<?php

   namespace trendoman;

   if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

   class FileTags {

      static function tag_delete_file_processor($params, $node)
      {
         global $AUTH;
         if( $AUTH->user->access_level < K_ACCESS_LEVEL_ADMIN ){  return; }

         $filename = trim($params[0]['rhs']);

         if( $filename == '@php' ){
            if( file_exists(ini_get('error_log')) ) unlink(ini_get('error_log'));
            return;
         }

         if( file_exists(K_SITE_DIR . $filename) ) @unlink(K_SITE_DIR . $filename);

         return;
      }

   }

   $FUNCS->register_tag( 'delete_file', array('\trendoman\FileTags', 'tag_delete_file_processor') );
