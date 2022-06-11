<?php

    /**
    *   List-view: Define global limit for all clonable templates if not set explicitly via <cms:config_list_view limit='' />
    *
    *   @author Anton S aka Trendoman <tony.smirnov@gmail.com>
    *   @date   21.06.2019
    */

    $FUNCS->add_event_listener( 'alter_pages_list_default_fields', 'my_admin_list_new_global_limit' ); // ALSO: alter_admin_list_default_limit
    function my_admin_list_new_global_limit( $fields, &$tpl ){

        // Set global limit for list-view.
        // Note, that limit in cms:config_list_view prevails and will *not* be changed, hence giving an extra option.
        $global_limit = '50';

        if( intval($global_limit)<1 ) return;
        $arr_config = $tpl->arr_config;
        if( is_array($arr_config) ){
            if( !isset($arr_config['limit']) || $arr_config['limit'] == '' ){ $arr_config['limit'] = trim($global_limit); }
        } else {
            $arr_config = array( 'limit' => $global_limit );
        }
        $tpl->arr_config = $arr_config;
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
