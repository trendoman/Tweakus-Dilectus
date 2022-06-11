<?php

    /**
    *   Performs base64 encoding
    *
    *   @example <cms:base64_encode var=myvar />
    *   @example <cms:base64_encode>Sample text</cms:base64_encode>
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   13.06.2019
    */

    $FUNCS->register_tag( 'base64_encode', 'my_new_tag_base64encode' );
    function my_new_tag_base64encode( $params, $node ){
        if( count($node->children) ){
            foreach( $node->children as $child ){
                $html .= $child->get_HTML();
            }
        }
        else{
            $html = $params[0]['rhs'];
        }

        return base64_encode( $html );
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
