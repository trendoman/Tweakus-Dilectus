<?php
    if( !defined('K_ADMIN') ) return;

    /**
    *   1. Override '- No Data -' message
    *   2. Add empty row to DOM if no data present
    *   3. Disable default row -- !!Fixed in CouchCMS!!
    *   4. Avoid empty-row DOM jumping
    *
    *   @author Antony S aka Trendoman <tony.smirnov@gmail.com>
    *   @date   16.06.2020
    *   @last   26.05.2022
    */

    $FUNCS->add_event_listener( 'alter_render_output_repeatable_assets', function($html, $name, $args){
        global $FUNCS;


        ob_start();
?>
        /*
        *   Component to override RepeatableRegion's empty message
        *   It even overrides the message set by /couch/lang/EN.php file
        *   @author: Antony <tony.smirnov@gmail.com>
        *   @date: 16.06.2020
        */

        COUCH.t_no_data_message = "- Empty -";

        /*  Component to redefine RepeatableRegion's tableGear plugin
        *   "TABLEGEAR WITH B and H"
        */
        (function($){
        /*
        *   PRIORITY: Core behavior is changed before Couch invokes the plugin
        *   WHY: No other way to extend defaults of the plugin without touching core.
        *
        *   REASON 1: --ATTN: Default Row is fixed in default CouchCMS--
        *
        *   REASON 2: If Admin wants to delete multiple rows, Alert pops up on each action.
        *   Alert doesn't make much sense, because data is NOT deleted before PAGE SAVE.
        *   Page can be reloaded without saving to restore visibility of 'deleted' rows.
        *
        *   @author: Antony <tony.smirnov@gmail.com>
        *   @date: 14.06.2020
        */
            function setDefaults(name, value, hash){
                if(hash[name] === undefined) hash[name] = value;
            }
            jQuery.fn.tableGear = (function(options) {
              /* https://stackoverflow.com/a/39023887/7524904 */
              return eval("(" + jQuery.fn.tableGear.toString()
                .replace("options = options || {};", "options = options || {}; options['deletePrompt'] = false;")                    /* no confirmation */
                .replace("_sortorder = $('#_' + id + '_sortorder');", "_sortorder=$('#_'+id+'_sortorder');if(0===nextid){return;}")  /* no second empty row */
                + ")");
            })();
        })(jQuery);
        /*  End of "TABLEGEAR WITH B and H"
        */

        /*  Companion Component to avoid DOM jump when empty row appears.
        *
        *   REASON: When table is empty, plugin tableGear adds an 'empty' row with 'empty' message on DOM ready, which causes jump.
        *   If plugin senses that an empty row already was attached, then there is no jump.
        *   This tweak is a COMPANION to the previous one that takes care of plugin changes.
        *   Here we insert empty row into emty TBODY (which comes empty from backend if there's no data)
        *   @author: Antony <tony.smirnov@gmail.com>
        *   @date: 16.06.2020
        */
        $(".k___repeatable > .repeatable-region.tableholder > table.rr tbody").each(function(i, el){
            if( 0 === $(el).children().length ){
                var message = COUCH.t_no_data_message;
                var colspan = $(el).parent().find('thead th').length;
                var noDataRow = $('<tr id="" class="noDataRow odd"><td align="center" colspan="'+colspan+'">'+message+'</td></tr>');
                $(el).append(noDataRow);
            }
        });

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
    // Ask any question via forum or email <anton.cms@ya.ru>, <tony.smirnov@gmail.com> "Anton S aka Trendoman"
    // My CouchCMS forum posts: https://www.couchcms.com/forum/search.php?author_id=18478&sr=posts
    // New Telegram channel: https://t.me/couchcms
    */
