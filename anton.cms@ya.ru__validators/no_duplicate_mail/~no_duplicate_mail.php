<?php

    /**
    *   Validator for custom email (no duplicates allowed).
    *
    *   @link   https://www.couchcms.com/forum/viewtopic.php?f=4&t=11513&p=30704#p30704
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   13.06.2019
    */

    function no_duplicate_mail( $field, $args ){
        global $FUNCS, $CTX;

        $email = trim( $field->get_data() );
        $current_page_id = $field->page->id;

        if( strlen($email) ){
             // Create Couch script..
            $html = "<cms:pages masterpage='contacts.php' id='NOT {$current_page_id}' custom_field='user_email=={$email}' "
            $html.= "show_future_entries='1' show_unpublished='1' count_only='1' />";

            // Pass on the code to Couch for execution using the 'embed' function
            $count = $FUNCS->embed( $html, $is_code=1 );
            if( $count ){
                return KFuncs::raise_error( "Email already exists" );
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
    // Write me at <anton.cms@ya.ru>, <tony.smirnov@gmail.com> "Anton S aka Trendoman"
    // Telegram: https://t.me/couchcms
    */
