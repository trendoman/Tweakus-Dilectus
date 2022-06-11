<?php

    /**
    *   'Separator' entry is just a little spacer between templates in the sidebar section.
    *   Can be placed inside a collapsible folder and aligned by weight.
    *
    *   @link   https://www.couchcms.com/forum/viewtopic.php?f=8&t=9887
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   21.01.2020
    */

    if( !defined('K_ADMIN') ) return;

    $FUNCS->add_event_listener( 'register_admin_menuitems', function (){
        global $FUNCS;


        $FUNCS->register_admin_menuitem( array('name'=>'_dummy_01_', 'title'=>'──────────────────', 'parent'=>' ', 'weight'=>'10', 'class'=>'my-separator', 'is_header'=>'0')  );
        $FUNCS->register_admin_menuitem( array('name'=>'_dummy_02_', 'title'=>'──────────────────', 'parent'=>'', 'weight'=>'20', 'class'=>'my-separator', 'is_header'=>'0')  );

        // change style and layout in /theme/../sidebar.html
        // thanks to added custom class 'my-separator' for each separator.
        // @example <cms:if k_menu_class eq 'my-separator'>..</cms:if>
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
