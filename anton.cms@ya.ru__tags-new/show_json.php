<?php

    /**
    *   <cms:show_json myvar as_html='1' no_escape='1' no_validate='1' />
    *   Shortcut to <cms:show myvar as_json='1' /> with option to prettify output
    *
    *   JSON Format thanks to Dave Perrett @ https://www.daveperrett.com/articles/2008/03/11/format-json-with-php/
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   13.06.2019
    *   @last   30.05.2022
    */

    $FUNCS->register_tag( 'show_json', 'my_new_tag_show_json' );
    function my_new_tag_show_json( $params, $node ){
        global $FUNCS, $TAGS;
        if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}

        /* tag cms:show handles scope and arrays;
         * returned payload is either json or a non-encoded text */
        $value = $TAGS->show( $params, $node );

        extract( $FUNCS->get_named_vars(
                    array(
                          'as_html'=>'0',     /* show json as HTML-markup for best browser-view */
                          'no_escape'=>'0',   /* strip slashes for best readability (ATTN! JSON WILL BE INVALID for copy-paste) */
                          'no_validate'=>'0',  /* CAUTION: if json is 100% valid, this reduces time for performance */
                          'spaces'=>'2'       /* indent with 2 or more spaces */
                        ),
                    $params)
               );
        $as_html = ( $as_html==1 ) ? 1 : 0;
        $no_escape = ( $no_escape==1 ) ? 1 : 0;
        $no_validate = ( $no_validate==1 ) ? 1 : 0;
        $spaces = intval($spaces);

        /* validate to make sure of JSON in hands */
        if( !$no_validate && !is_array(json_decode($value, true)) ){

          return; /* JSON malformed :( */
        }

        $json = $value;
        if( $no_escape ) $json = stripslashes($json);

        $result       = '';
        $pos          = 0;
        $strLen       = strlen($json);
        $indentStr    = ( $as_html ) ? str_repeat('&nbsp;',$spaces) : str_repeat(' ',$spaces);
        $newLine      = ( $as_html ) ? "<br>"  : "\r\n";
        $prevChar     = '';
        $prevPrevChar = '';
        $outOfQuotes  = true;

        for ($i = 0; $i <= $strLen; $i++) {

            /* Grab the next character in the string. */
            $char = substr($json, $i, 1);

            /* Are we inside a quoted string?
             * The next character is only escaped if the previous was "\" and the one before wasn't "\". */
            $escaped = $prevChar == '\\' && $prevPrevChar != '\\';
            if ($char == '"' && !$escaped) {
                $outOfQuotes = !$outOfQuotes;

                /* If this character is the end of an element,
                 * output a new line and indent the next line. */
            } else {
                if (($char == '}' || $char == ']') && $outOfQuotes) {
                    if (substr($json, $i - 1, 1) !== '[') {
                        $result .= $newLine;
                    }
                    $pos--;
                    if (substr($json, $i - 1, 1) !== '[') {
                        $result .= str_repeat($indentStr, $pos);
                    }
                }
            }

            /* Add the character to the result string. */
            $result .= $char;

            /* If the last character was the beginning of an element,
             * output a new line and indent the next line. */
            if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
                if (substr($json, $i + 1, 1) !== ']') {
                    $result .= $newLine;
                }
                if ($char == '{' || $char == '[') {
                    $pos++;
                }

                if (substr($json, $i + 1, 1) !== ']') {
                    $result .= str_repeat($indentStr, $pos);
                }
            }

            $prevPrevChar = $prevChar;
            $prevChar     = $char;
        }

        return $result;
    }
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
