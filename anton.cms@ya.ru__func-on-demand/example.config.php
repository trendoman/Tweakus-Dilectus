<?php

   if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

   ///////////EDIT BELOW THIS////////////////////////////////////////

   // 0.
   // Directory to scan for funcs
   // Mind the slashes! Constant K_SITE_DIR has a trailing slash, K_SNIPPETS_DIR does not.
   define( 'FOD_FUNCS_DIRECTORY', K_SITE_DIR.K_SNIPPETS_DIR.'/funcs' );

   // 1.
   // If necessary, change the extension for the files with funcs
   define( 'FOD_FILE_EXTENSION', 'func' );

   ///////////ADVANCED CONFIGURATION/////////////////////////////////

   // 2a.
   // Do not comment this line!
   // Connecting the first mandatory directory.
   \trendoman\CmsFu\AutoloadFiltered::add_dir( FOD_FUNCS_DIRECTORY );

   // 2b.
   // If necessary, add more directories to scan. Mind the slashes!
   // Uncomment the line below and duplicate it if more dirs are needed.
   //\trendoman\CmsFu\AutoloadFiltered::add_dir( K_SITE_DIR.'#CmsFu' );


   // 3.
   // Addon will follow Couch's setting K_CACHE_OPCODES and K_CACHE_SETTINGS
   // If set to 0, files will be loaded from disk all the time.
   define( 'FOD_USE_COUCHCACHE', 0 );

   // 4.
   // Use the tag <cms:gen_func_array path=k_site_path /> to generate func paths.
   // When generated code is pasted to 'config-paths.php' set this setting to 1.
   define( 'FOD_PRELOAD_PATHS', 0 );

   // 5a.
   // Additionally load funcs from a single cache file.
   // Must be generated by tag <cms:gen_func_cache />
   // Name of the file (5b) must be uncommented too!
   define( 'FOD_CACHE_FILE_ON', 1 );

   // 5b.
   // Name of the single cache file.
   // Must be uncommented with the previous setting.
   define( 'FOD_CACHE_FILE', 'funcs.dat.md' );

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