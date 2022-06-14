<?php
    /**
    *   <cms:is_not /> - opposite of cms:is, which is an alias for cms:arr_val_exists
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   02.06.2020
    */

    $FUNCS->register_tag( 'is_not', function( $params, $node ){
        global $TAGS;

        return !$TAGS->arr_val_exists( $params, $node );
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
