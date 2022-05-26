<?php
    if( !defined('K_ADMIN') ) return;

    /**
    *   Adds <br> after alert's label to keep display of validation errors each on separate line and not messy.
    *
    *   @category 
    *   @link
    *   @author "Anton aka Trendoman" <tony.smirnov@gmail.com>
    *   @date   14.06.2020
    */

    $FUNCS->add_event_listener( 'alter_render_output_alert', function($html, $name, $args){
        global $FUNCS;

        ob_start();
?>

        /*  
        *   "ALIGNED ALERT"
		*	Adds <br> after alert's label to keep validation errors each on separate line and not messy.
        *
        *   This code comes from "couch/addons/anton.cms@ya.ru__admin-panel-tweaks/alert-aligned"
        *
		*   @link https://github.com/CouchCMS/CouchCMS/pull/115
        *   @author: Antony <tony.smirnov@gmail.com>
        *   @date: 06.06.2020
        */
        (function($){
            $(".alert.alert-error > b").after('<br>');
        })(jQuery);
        /* End of "ALIGNED ALERT" */

<?
        $js = ob_get_contents();
        ob_end_clean();

        $FUNCS->add_js( $js );
    });
