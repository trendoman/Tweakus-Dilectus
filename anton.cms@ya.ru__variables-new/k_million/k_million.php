<?php

    /**
    *   Really big limit - '1.000.000' - with "k_million" variable.
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   11.06.2019
    *   @last   13.02.2020
    */

    $FUNCS->add_event_listener( 'add_render_vars', 'my_context_k_unlimited_handler' );
    function my_context_k_unlimited_handler(){
        global $CTX;
        $CTX->set('k_million', 1000000);
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
