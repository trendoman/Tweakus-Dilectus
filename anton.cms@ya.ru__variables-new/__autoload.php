<?php

    if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

    /**
    *   This file automatically registers *.php files with CouchCMS.
    *
    *   Only *.php files (not *.php5) that exist in child folders relevant to this file are taken into consideration.
    *   Only files that do not contain "~" symbol in any place in whole path are processed, therefore it is possible to -
    *     + skip existing file from loading by prepending that filename/foldername with "~"
    *         for example: mycode.php --> ~mycode.php
    *         for example: myfolder/mycode.php --> ~myfolder/mycode.php
    *
    *   Resume:
    *   Code traverses the child folders and subfolders and loads all found php files (with extension .php).
    *   This is done to quickly drop a code and have it loaded for every page where CouchCMS code is used.
    *
    *   Additionally edit this file to skip existing directories from loading by tweaking "$exclude" array. Be precise!
    *
    *   You should have downloaded this code from:
    *   @link https://github.com/trendoman/Tweakus-Dilectus
    *   @author Anton S aka trendoman <tony.smirnov@gmail.com>
    *   @date   01.03.2020
    *   @last   25.05.2022
    */

    $exclude = array_map(function($path){ return str_replace( array('\\','/'), DIRECTORY_SEPARATOR, $path); }, array(
        __FILE__,
        // __DIR__.DIRECTORY_SEPARATOR.'vendor',
    ));

    $directory = new RecursiveDirectoryIterator( __DIR__, FilesystemIterator::SKIP_DOTS );
    $iterator = new RecursiveIteratorIterator( $directory );
    foreach ($iterator as $file) {
        $pathname = $file->getPathname();
        //error_log('Testing pathname - '.$pathname);
        if( strpos($pathname, '~') !== false ) continue;
        if( false === $file->isFile() ) continue;
        if( false === $file->isReadable() ) continue;
        if( strtolower( $file->getExtension() ) !== 'php' ) continue;
        foreach($exclude as $ignored){
            if( false !== strpos($pathname, $ignored) ) continue 2;
        }
        //error_log('Loading - '.$pathname);
        require_once $pathname;
    }

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
