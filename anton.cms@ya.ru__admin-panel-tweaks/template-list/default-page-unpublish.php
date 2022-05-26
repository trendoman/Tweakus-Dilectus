<?php

    /**
    *   A clonable template's first page now gets auto-un-published in case template was converted from non-clonable.
    *
    *   @category Backend Mods
    *   @link
    *   @author Kamran Kashif aka KK <kksidd@couchcms.com>
    *   @date   11.06.2019
    */

    $FUNCS->add_event_listener( 'template_modified', 'my_admin_unpublish_clonable_master' );
    function my_admin_unpublish_clonable_master( $rec, $attr, $prev_custom_values, $attr_custom, $modified ){
        global $PAGE, $DB, $FUNCS;

        // if the clonable status of masterpage is being modified ..
        if( array_key_exists('clonable', $modified) ){

            // get id of the masterpage
            if( $PAGE->is_master ){
                $id = $PAGE->id;
            }
            else{
                $rs = $DB->select( K_TBL_PAGES, array('id'), "template_id='" . $DB->sanitize( $PAGE->tpl_id ). "' AND is_master='1'" );
                if( !count($rs) ) return;
                $id = $rs[0]['id'];
            }

            if( $modified['clonable']==='1' ){
                // .. update page record to unpublish it
                $rs = $DB->update( K_TBL_PAGES, array('publish_date'=>'0000-00-00 00:00:00'), "id='" . $DB->sanitize( $id ). "'" );
            }
            elseif( $modified['clonable']==='0' ){
                // .. update page record to publish it
                $rs = $DB->update( K_TBL_PAGES, array('publish_date'=>$FUNCS->get_current_desktop_time() ), "id='" . $DB->sanitize( $id ). "'" );
            }
            if( $rs==-1 ) die( "ERROR: Unable to change publish status of masterpage" );
        }
    }
