<?php

    /**
    *   The very first cloned page created automatically now has a shorter default title - "Default page" - and gets auto-un-published.
    *   It is a significant time saver and helps avoid renaming page'd default title - 'Default page for xxx.php  * PLEASE CHANGE THIS TITLE * '.
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @date   11.06.2019
    */

    $FUNCS->add_event_listener( 'alter_create_insert', 'my_admin_replace_title_default_page' );
    function my_admin_replace_title_default_page( &$arr_insert, &$pg ){
        global $PAGE, $FUNCS;

        $is_master = $arr_insert['is_master'];
        $title = $arr_insert['page_title'];
        $name = $arr_insert['page_name'];
        $unwelcomed_title_str = '* PLEASE CHANGE THIS TITLE *';
        $unwelcomed_name_str = '-please-change-this-title';

        if( $is_master && strpos( $title, $unwelcomed_title_str )){
            $arr_insert['page_title'] = str_replace( $unwelcomed_title_str, '', $title);;
            $arr_insert['page_name'] = str_replace( $unwelcomed_name_str, '', $name);

            if( $pg->tpl_is_clonable ){
                $arr_insert['publish_date'] = '0000-00-00 00:00:00';
            }
            else{
                // don't know for sure if the template is indeed non-clonable.
                // The <cms:template> tag that might follow can set this as clonable.
                // This is therefore handled by the other hook.
            }
        }
    }


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
