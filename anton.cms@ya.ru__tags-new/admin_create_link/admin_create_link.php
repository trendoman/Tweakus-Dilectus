<?php

    /**
    *   TAG: <cms:admin_create_link /> - outputs 'create page' admin link
    *
    *   @link   https://www.couchcms.com/forum/viewtopic.php?f=2&t=12096&p=33263#p33263
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @date   13.06.2019
    */

    $FUNCS->register_tag( 'admin_create_link', function( $params, $node ){
        global $FUNCS, $CTX, $AUTH;

        if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}

        // if current user is not an administrator or template is non-clonable, return.
        if( $AUTH->user->access_level < K_ACCESS_LEVEL_ADMIN || $CTX->get('k_is_list_page')) return;

        $nonce = $FUNCS->create_nonce( 'create_page_'.$CTX->get('k_template_id') );
        $link = K_ADMIN_URL . K_ADMIN_PAGE . '?o='. $CTX->get('k_template_name') .'&q=create/'. $nonce;

        return $link;
    });
