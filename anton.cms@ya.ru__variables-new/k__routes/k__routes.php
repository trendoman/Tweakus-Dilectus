<?php

    /**
    *   New variable to debug custom routes: "k__routes".
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   11.06.2019
    */

    $FUNCS->add_event_listener( 'add_render_vars', function (){
        global $CTX, $KROUTES;

        if( $KROUTES ) $CTX->set( 'k__routes', $KROUTES->routes, 'global', 1 );
    });
