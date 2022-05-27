<?php
    /**
    *   Double declaration of func is *NOT* possible, but now errors can be avoided.
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   24.05.2020
    *   @last   30.06.2020
    */

    $FUNCS->add_event_listener( 'alter_tag_func_execute', function($tag_name, $params, $node, &$html){
        global $FUNCS;

        if( count($params) && is_null($params[0]['lhs']) ){ // user-defined function
            $name = trim( $params[0]['rhs'] );
            if( !$name ) return $skip_orig_tag = false;
            // no name - no game

            if( array_key_exists($name, $FUNCS->funcs) ) return $skip_orig_tag = true;
        }
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
