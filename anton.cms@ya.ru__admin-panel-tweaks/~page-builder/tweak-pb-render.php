<?php
    if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

    /*
     * Instructions from Documentation on CouchCMS's PageBuilder, quoted verbatim -
     *
     * ~~~~~~~~~~~~ quote ~~~~~~~~~~~~~~
     * OK, with that understood, let us finally associate the markups with the blocks.
     * This step involves just a wee bit of PHP but let that not disconcert you if you are not comfortable with the language.
     * It is boiler-plate code that you can just copy and paste into the indicated file.
     * Please open couch/addons/kfunctions.php in your text editor and paste the following code within it -
     *
     * [code is already in this file]
     *
     * ~~~~~~~~~~~~ end quote ~~~~~~~~~~
     *
     * See __readme__ file for further details or refer the Docs
     * @link https://www.couchcms.com/forum/viewtopic.php?f=5&t=13148
     */
    $FUNCS->add_event_listener( 'override_renderables', function(){
        global $FUNCS;

        $FUNCS->override_render( 'pb_wrapper', array('template_path'=>K_SITE_DIR.K_SNIPPETS_DIR.'/pb/misc/theme/') );
        $FUNCS->override_render( 'pb_tile', array('template_path'=>K_SITE_DIR.K_SNIPPETS_DIR.'/pb/', 'template_ctx_setter'=>array('MyPB', '_render_pb_tile')) );
    });

    class MyPB{
        static function _render_pb_tile(){
            global $FUNCS, $CTX;

            $tpl_type = $CTX->get( 'k_template_type' );
            if( $tpl_type == 'tile' ){

                $tpl = $CTX->get( 'k_template__pb_template' ); // the template to render

                $tpl = trim( $tpl );
                if( $tpl!='' ){
                    return array( $tpl );
                }
            }
        }
    } // end class MyPB

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
