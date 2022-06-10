<?php
    if( !defined('K_ADMIN') ) return;

    /*
     * Click without reload in Admin-panel
     *
     * @author Antony S <tony.smirnov@gmail.com>
     * @date   10.06.2022
     */

    $FUNCS->add_event_listener( 'add_admin_js', function(){
        global $FUNCS;
        $js = '';

        ob_start();
?>
    /*
    *   Component to Smooth Click Load
    *   @author: Antony <tony.smirnov@gmail.com>
    *   @date: 10.06.2022
    */

    function forceReloadEmptyJS() {
        $.each($('script:not(:empty)'), function(index, el) {
            var oldText = $(el).text();
            $(el).remove();
            $('<script/>').text(oldText).appendTo('head');
        })
    }

    function forceReloadJS(srcUrlContains) { /* courtesy of https://stackoverflow.com/a/53164215/7524904 */
        $.each($('script:empty[src*="' + srcUrlContains + '"]'), function(index, el) {
            var oldSrc = $(el).attr('src');
            var t = +new Date();
            var newSrc = oldSrc.split('?')[0] + "?" + t;
            $(el).remove();
            $('<script/>').attr('src', newSrc).appendTo('head');
        });
    }

    $('div#sidebar li.nav-group a, tbody#listing td:not(:last-child) a, tbody#listing td:last-child a:not(:nth-last-child(-n+2))').on('click', function(event){
        event.preventDefault();
        event.stopPropagation();
        $(this).fadeTo(250, 0.7);
        var myURL = this.href;
        jQuery.ajax(myURL).done(function (result) {

            history.pushState({}, '', myURL);
            $('html').get(0).innerHTML = result;

            var path = "<? echo(K_COUCH_DIR);  ?>";
            var couch_dir = path.match(/([^\/]*)\/*$/)[1];

            forceReloadJS('/' + couch_dir +'/');
            forceReloadEmptyJS();
            COUCH.init();
        });
    });
    window.onpopstate = function (event) { window.location = window.location; }


<?
        $js = ob_get_clean();
        $FUNCS->add_js( $js );

    });

    /*
    // ~~~~~~~~~~~~~
    // Credits
    // ~~~~~~~~~~~~~
    // You should have downloaded this code from https://github.com/trendoman
    // ~~~~~~~~~~~~~
    // Support
    // ~~~~~~~~~~~~~
    // Ask any question via forum or email <anton.cms@ya.ru>, <tony.smirnov@gmail.com> "Anton S"
    // Browse helpful Tips&Tricks subforum: https://www.couchcms.com/forum/viewforum.php?f=8
    // Telegram: https://t.me/couchcms
    */
