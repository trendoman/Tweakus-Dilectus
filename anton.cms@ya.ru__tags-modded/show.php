<?php

    /**
    *   Add 'case', 'encoding' params to <cms:show> tag
    *
    *   @example  <cms:show case='upper' />
    *   @example  <cms:show case='title' />
    *   @example  <cms:show case='lower' encoding='Windows-1251' />
    *   @link https://www.couchcms.com/forum/viewtopic.php?f=8&t=13015
    *   @author @dmore54, @trendoman <tony.smirnov@gmail.com>
    *   @date   20.05.2021
    */
    $FUNCS->add_event_listener( 'tag_show_executed', function ( $tag_name, $params, $node, &$html ){
        global $FUNCS;
        extract( $FUNCS->get_named_vars(
            array(
               'case'=>'',
               'encoding'=>'UTF-8'
            ),
            $params)
        );

        switch ($case) {
            case "u":
            case "upper":
              $type = MB_CASE_UPPER;
              break;
            case "l":
            case "lower":
              $type = MB_CASE_LOWER;
              break;
            case "t":
            case "title":
              $type = MB_CASE_TITLE;
              break;
            default:
              return null;
        }

        $html = mb_convert_case($html, $type, trim($encoding));

        return null;
    });

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
