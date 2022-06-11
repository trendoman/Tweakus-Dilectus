<?php

    /**
    *   <cms:if_empty var=myvar >...</cms:if_empty>
    *
    *   @example <cms:if_empty var=myvar >...</cms:if_empty>
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   17.04.2018
    *   @last   13.06.2019
    */

    $FUNCS->register_tag( 'if_empty', 'my_new_tag_if_empty' );
    function my_new_tag_if_empty( $params, $node ){
        global $FUNCS;

        $res = $FUNCS->strlen( trim(strip_tags($params[0]['rhs'])) ) ? 1 : 0;
        if( !$res )
        foreach( $node->children as $child ){
            $html .= $child->get_HTML();
        }
        return $html;
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
