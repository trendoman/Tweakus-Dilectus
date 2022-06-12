<?php

    /**
    *   New variable to access $_SERVER
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   12.06.2022
    */

    $FUNCS->add_event_listener( 'add_render_vars', function () {
        global $CTX;
        $CTX->set( 'k__server', $_SERVER, 'global' );
    });

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
