<?php

    /**
    *   Hide certain templates
    *   See through code to uncomment line which excludes superadmin.
    *
    *   @category Backend Mods
    *   @link
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @author Anton Smirnov aka Trendoman <tony.smirnov@gmail.com>
    *   @date   11.06.2019
    */

    if( !defined('K_ADMIN') ) return;

    $FUNCS->add_event_listener( 'alter_admin_menuitems', 'my_hide_admin_menuitems' );
    function my_hide_admin_menuitems( &$items ){
        global $AUTH;

        // set hidden templates -
        $tpls = array(
                //   'template-to-hide.php'
                //,   'another-template-to-hide.php'
                //,   'users'     // system 'USERS' section
        );

        // a freeway for superadmin -- always sees through
        // if( $AUTH->user->access_level == 10 ) return;

        if( array_key_exists('_modules_', $items) ){
            unset( $items['_modules_'] ); // hide empty Administration section?
        }

        foreach( $tpls as $tpl ){
            if( array_key_exists($tpl, $items) ){
                unset( $items[$tpl] );
            }
        }
    }
