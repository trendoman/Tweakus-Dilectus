<?php

    /**
     *  Fix: The same user accounts appear at two different places.
     *
     *  @link   https://www.couchcms.com/forum/viewtopic.php?f=4&t=11057&start=10#p28616
     *  @author Kamran Kashif aka KK <kksidd@couchcms.com>
     *  @author Anton S aka Trendoman <tony.smirnov@gmail.com>
     *  @date   26.05.2022
     */

    if( !$_GET['debug'] ){
        $FUNCS->add_event_listener( 'alter_render_vars_content_list_inner', 'my_alter_render_vars', -10 );
    }

    function my_alter_render_vars( &$templates, $render ){
        global $CTX, $FUNCS, $DB, $KUSER;

        if( $render=='content_list_inner' ){

            $route = $FUNCS->current_route;
            if( is_object($route) ){

                $tables = K_TBL_USERS .' as u, '. K_TBL_USER_LEVELS .' as lvl';
                $where = 'u.access_level = lvl.k_level AND u.access_level >= '.K_ACCESS_LEVEL_AUTHENTICATED_SPECIAL;

                if( $route->module=='users' ){
                    // modify SQL for cms:query within the template to exclude non-admins from core users listing
                    $fields = 'u.id as id, u.name as name, u.title as title, u.email as email, u.system as is_system, lvl.title as level_str, lvl.k_level as level';
                    $orderby .= 'u.access_level DESC, u.name ASC';

                    $sql = 'SELECT ' . $fields . ' FROM ' . $tables . ' WHERE ' . $where . ' ORDER BY ' . $orderby;

                    $CTX->set( 'k_selected_query', $sql );
                }
                elseif( $route->module=='pages' && is_object($KUSER) && $KUSER->users_tpl!='' && $route->masterpage==$KUSER->users_tpl ){
                    $fields = array( 'u.name as name' );

                    // exclude admins from extended-users listing
                    $rows = $DB->select( $tables, $fields, $where );
                    $str_users = '';
                    foreach( $rows as $r ){
                        $str_users .= ',' . $r['name'];
                    }

                    $exclude = $CTX->get( 'k_selected_exclude', 2 /*global*/ );
                    $CTX->set( 'k_selected_exclude', $exclude.$str_users, 'global' );
                }
            }
        }
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

