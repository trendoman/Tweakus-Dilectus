<?php

    /**
    *   Quickly access 'safe' name of current template via
    *     - "k_template_name_safe" variable, or, without extension:
    *     - "k_template_name_safe_ex"
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   11.06.2019
    */

    $FUNCS->add_event_listener( 'add_render_vars', 'my_context_k_template_name_safe_handler' );
    function my_context_k_template_name_safe_handler(){
        global $CTX, $FUNCS;

        $tpl_name_safe = $FUNCS->get_clean_url( $CTX->get('k_template_name') );
        $tpl_name_safe_ne = ( strpos($tpl_name_safe, '-php') !== false ) ? str_replace('-php', '', $tpl_name_safe) :  $tpl_name_safe;
        if( !$tpl_name_safe || !$tpl_name_safe_ne ) return;

        $pos = array_search( 'k_template_name', array_keys($CTX->ctx['0']['_scope_']) );
        $first_array = array_splice( $CTX->ctx['0']['_scope_'], 0, $pos+1 );
        $CTX->ctx['0']['_scope_'] = array_merge( $first_array, array (
                'k_template_name_safe' => $tpl_name_safe,
                'k_template_name_safe_ex' => $tpl_name_safe_ne
            ), $CTX->ctx['0']['_scope_'] );

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
