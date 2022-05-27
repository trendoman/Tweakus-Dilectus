<?php

    /**
    *   Update template's settings if cms:config_list_view / cms:config_form_view were removed from cms:template.
    *   By default CouchCMS can not 'see' removed tags and keeps old values in database.
    *	So this mod allows to clean saved values from database when the tag/tags are not present.
    *
    *   @author Anton Smirnov aka Trendoman <tony.smirnov@gmail.com>
    *   @date   12.06.2019
    *   @last   14.02.2020
    */


    $FUNCS->add_event_listener( 'tag_config_list_view_executed', 'admin_template_configs_post_process');
    $FUNCS->add_event_listener( 'tag_config_form_view_executed', 'admin_template_configs_post_process');

    // Note to PHP Developer:
    // Each tag creates a flag if tag was executed.
    // If tag was not executed it means it is not present inside cms:template.
    // If the tag is not present, assume it was deleted and we need to clear the db.
    // To clear the db, we forcibly re-run the missing tag without params,
    // because tag's native code will handle the db update naturally.

    function admin_template_configs_post_process($tag_name){
        global $PAGE;
        switch( $tag_name ){
            case 'config_list_view':
                $PAGE->tpl_has_config_list_view = 1;
                break;
            case 'config_form_view':
                $PAGE->tpl_has_config_form_view = 1;
                break;
        }
        return false;
    }

    $FUNCS->add_event_listener( 'tag_template_executed', 'admin_template_configs_update');
    function admin_template_configs_update($tag_name){
        global $PAGE, $TAGS, $AUTH, $FUNCS;
        if( $AUTH->user->access_level < K_ACCESS_LEVEL_SUPER_ADMIN ){ return false; }

        $debug = ( false ) ? 1 : 0;
        if( !$PAGE->tpl_has_config_list_view ){
            // execute empty <cms:config_list_view /> to update db
            $FUNCS->remove_event_listener( 'tag_config_list_view_executed', 'admin_template_configs_post_process');
            $TAGS->config_list_view( $params = array(), $node = new KNode( K_NODE_TYPE_TEXT ) );
        }
        if( !$PAGE->tpl_has_config_form_view ){
            // execute empty <cms:config_form_view /> to update db
            $FUNCS->remove_event_listener( 'tag_config_form_view_executed', 'admin_template_configs_post_process');
            $TAGS->config_form_view( $params = array(), $node = new KNode( K_NODE_TYPE_TEXT ) );
        }

        return false;
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
