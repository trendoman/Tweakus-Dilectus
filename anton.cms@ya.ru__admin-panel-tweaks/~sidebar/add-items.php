<?php

    /**
    *   Add new sidebar sections.
    *
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @date   11.06.2019
    */

    if( !defined('K_ADMIN') ) return;

    $FUNCS->add_event_listener( 'register_admin_menuitems', function (){
        global $FUNCS;

        // Example of a new sidebar section 'MyFolder' which can be used as a parent for templates - <cms:template ... parent='_myfolder_' ... />
        $FUNCS->register_admin_menuitem( array('name'=>'_myfolder_', 'title'=>'MyFolder', 'is_header'=>'1', 'weight'=>'-1')  );
    });

    /*
    // ~~~~~~~~~~~~~
    // Credits
    // ~~~~~~~~~~~~~
    // You should have downloaded this code from https://github.com/trendoman
    // ~~~~~~~~~~~~~
    // Support
    // ~~~~~~~~~~~~~
    // Ask any question via forum or email <anton.cms@ya.ru>, <tony.smirnov@gmail.com> "Anton S aka Trendoman"
    // My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts
    // New Telegram channel: https://t.me/couchcms
    */
