<?php

    /**
    *   Calculates MD5 hash
    *
    *   @example <cms:md5 var=myvar />
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   13.06.2019
    */

    $FUNCS->register_tag( 'md5', 'my_new_tag_md5' );
    function my_new_tag_md5( $params, $node ){
        if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}

        $res = $params[0]['rhs'];
        return md5( $res );
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
