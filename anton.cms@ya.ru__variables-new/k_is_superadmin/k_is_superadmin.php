<?php

    /**
    *   Add "k_is_superadmin", "k_user_superadmin" to the global context in case SuperAdmin is logged in.
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   11.06.2019
    *   @last   25.02.2020
    */

    $FUNCS->add_event_listener( 'add_render_vars', 'my_context_is_superadmin_handler' );
    function my_context_is_superadmin_handler(){
        global $CTX, $AUTH;

        if( $AUTH->user->access_level >= K_ACCESS_LEVEL_SUPER_ADMIN ){
            $pos = array_search( 'k_user_access_level', array_keys($CTX->ctx['0']['_scope_']) );
            $first_array = array_splice( $CTX->ctx['0']['_scope_'], 0, $pos+1 );
            $CTX->ctx['0']['_scope_'] = array_merge( $first_array, array (
                'k_is_superadmin' => '1',
                'k_user_superadmin' => '1'
                ), $CTX->ctx['0']['_scope_'] );
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
