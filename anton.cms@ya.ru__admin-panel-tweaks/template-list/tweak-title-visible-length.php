<?php

    /**
    *   List-view: Increase page's titles visible length before ellipsis (...) kicks in.
    *
    *   @category Backend Mods
    *   @link   https://www.couchcms.com/forum/viewtopic.php?f=2&t=10250#p24782
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @date   11.06.2019
    */

    $FUNCS->add_event_listener( 'alter_pages_list_default_fields', 'my_admin_page_title_length_set' );
    function my_admin_page_title_length_set( &$fields ){
        global $FUNCS;

        // set length here
        $length = '90';


        $route = $FUNCS->current_route;
        if( is_object($route) && $route->module=='pages' && $route->class=='KPagesAdmin' ){
            if( array_key_exists('k_page_title', $fields) ){
                $fields['k_page_title']['content']="<cms:render 'list_title' '{$length}' />";
            }
        }
    }
