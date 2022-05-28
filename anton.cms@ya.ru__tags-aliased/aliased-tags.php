<?php

/**
*   The Class below allows to specify tag aliases which upon call would correctly invoke the base tag.
*   As of 04.02.2020 Couch features an event that allows to customize the error message when an unknown tag is encountered.
*   That event would also allow to do much more e.g. execute the correct tag if it was misspelled, giving way to tag aliases.
*
*   @link   https://www.couchcms.com/forum/viewtopic.php?f=3&t=12536
*   @author Kamran Kashif aka KK <kksidd@couchcms.com>
*   @author Antony S aka Trendoman <tony.smirnov@gmail.com>
*   @date   08.02.2020
*   @last   14.02.2020
*/


class MyAltTags{
    var $aliases = array(
        /* 'alias'      => 'real_tag' */

        /* COUCHCMS STOCK TAGS: */
        'add_slashes'   => 'addslashes',
        'slashes'       => 'addslashes',
        'addquerystring'=> 'add_querystring',
        'add_qs'        => 'add_querystring',
        'addqs'         => 'add_querystring',
        'qs'            => 'add_querystring',

        /* CUSTOM / NEW / USER TAGS: */
        'base64dec'     => 'base64_decode',
        'base64enc'     => 'base64_encode',
        'decode_base64' => 'base64_decode',
        'encode_base64' => 'base64_encode',

        'json_print'    => 'print_json',
        'json_escape'   => 'escape_json',
        'trim_char'     => 'trim_characters',
        'trim_chars'    => 'trim_characters',
    );

    function __construct(){
        global $FUNCS;
        $FUNCS->add_event_listener( 'tag_unknown', array($this, 'alt_tag') );
    }

    function alt_tag( $tagname, &$node, &$html ){
        global $FUNCS;

        if( array_key_exists($tagname, $this->aliases) ){
            $node->name = $this->aliases[$tagname]; // correct the tag name ..
            $ok = 1;
        }
        if( array_key_exists($tagname, $FUNCS->funcs) ){
            $node->name = 'call';
            $node_attributes = array( "value" => $tagname,  "value_type" => 1,  "quote_type" => "'",  "op" => "="  ); // try <cms:call '{$tagname}' params />
            array_unshift($node->attributes, $node_attributes);
            $ok = 1;
        }

        if( $ok ){
            $skip = self::execute_tag( $node, $html ); // and execute
            if( $skip ){
                return 1; // skip further processing this tag
            }
            else{
                $html = 'ERROR! Unknown tag: "'. $tagname . '"';
            }
        }
    }

    static function execute_tag( &$node, &$html ){
        global $TAGS, $FUNCS;

        $tagname = $node->name;

        if( !in_array($tagname, array('if', 'else', 'else_if', 'while', 'break', 'continue', 'not', 'extends')) ){
            if( method_exists($TAGS, $tagname) || array_key_exists( $tagname, $FUNCS->tags) ){
                $params = $FUNCS->resolve_parameters( $node->attributes );

                // HOOK: alter_tag_<tag_name>_execute
                $skip = $FUNCS->dispatch_event( 'alter_tag_'.$tagname.'_execute', array($tagname, &$params, &$node, &$html) );

                if( !$skip ){
                    if( method_exists($TAGS, $tagname) ){
                        $html = call_user_func( array($TAGS, $tagname), $params, $node );
                    }
                    else{
                        $html = call_user_func( $FUNCS->tags[$tagname]['handler'], $params, $node );
                    }
                }

                // HOOK: tag_<tag_name>_executed
                $FUNCS->dispatch_event( 'tag_'.$tagname.'_executed', array($tagname, &$params, &$node, &$html) );

                return 1;
            }
        }
        return 0;
    }
}// end class MyAltTags
new MyAltTags();

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
