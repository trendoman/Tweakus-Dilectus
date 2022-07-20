<?php

    /**
    *   Quickly access 'safe' name of current template via
    *     - "k__template_name_safe" variable, or, without extension:
    *     - "k__template_name_safe_ex"
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   11.06.2022
    */

    $FUNCS->add_event_listener( 'add_render_vars', function () {

        global $CTX, $FUNCS;

        $tpl_name_safe = $FUNCS->get_clean_url( defined('K_ADMIN') ? $_GET['o'] : $CTX->get('k_template_name') );
        $tpl_name_safe_ex = rtrim($tpl_name_safe, "ph");
        $tpl_name_safe_ex = rtrim($tpl_name_safe_ex, "-");

        $CTX->set_all( array(
                'k__template_name_safe' => $tpl_name_safe,
                'k__template_name_safe_ex' => $tpl_name_safe_ex
        ), 'global');

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
