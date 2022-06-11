<?php

    /**
    *   The code is overriding the core functions inside Couch which are outputting the dates in admin listing pages.
    *   (there are actually two formats of dates used - one for normal pages and the other used in 'Drafts' listing).
    *
    *   Tweak: change the "M jS Y" and "M jS Y @ H:i" strings to whatever format you desire.
    *   The details of that format is found at - http://docs.couchcms.com/tags-reference/date.html
    *
    *   For example -
    *   $html = $FUNCS->date( $publish_date, "d.m.Y" );
    *   $html = $FUNCS->date( $mod_date, "d.m.Y @ H:i" );
    *
    *   @link   https://www.couchcms.com/forum/viewtopic.php?f=4&t=11313&p=30107#p30107
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @author Anton S aka Trendoman <tony.smirnov@gmail.com>
    *   @date   26.05.2022
    */

    $FUNCS->add_event_listener( 'override_renderables', function(){
        global $FUNCS;

        $FUNCS->override_render( 'list_date', array('renderable'=>'MyOverrides::_render_list_date') );
        $FUNCS->override_render( 'list_mod_date', array('renderable'=>'MyOverrides::_render_list_mod_date') );
    });


    class MyOverrides{
        static function _render_list_date(){
            global $CTX, $FUNCS;

            $publish_date = $CTX->get( 'k_page_date' );

            if( $publish_date != '0000-00-00 00:00:00' ){
                $html = $FUNCS->date( $publish_date, "M jS Y" );
            }
            else{
                $html = '<span class="label label-error">'.$FUNCS->t('unpublished').'</span>';
            }

            return $html;
        }

        static function _render_list_mod_date(){
            global $CTX, $FUNCS;

            $mod_date = $CTX->get( 'modification_date' );
            $html = $FUNCS->date( $mod_date, "M jS Y @ H:i" );

            return $html;
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
