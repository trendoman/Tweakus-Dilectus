<?php

    /**
    *   Alter sidebar entries
    *
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @date   11.06.2019
    */

    if( !defined('K_ADMIN') ) return;

    $FUNCS->add_event_listener( 'alter_admin_menuitems', 'my_alter_admin_menuitems' );
    function my_alter_admin_menuitems( &$items ){
        global $FUNCS;

        // var_dump( $items );
        if( array_key_exists('_templates_', $items) ){
            unset( $items['_templates_'] ); // removed this so now all templates by default go in '_root_'.
        }
        $items['_modules_']['weight']=100; // move administration group further down

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
