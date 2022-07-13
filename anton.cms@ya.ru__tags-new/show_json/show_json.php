<?php

    /**
    *   <cms:show_json myvar />
    *   JSON Format thanks to Dave Perrett @ https://www.daveperrett.com/articles/2008/03/11/format-json-with-php/
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   13.06.2019
    *   @last   30.06.2022
    */

    $FUNCS->register_tag( 'show_json', 'my_new_tag_show_json' );
    function my_new_tag_show_json( $params, $node ){
        global $FUNCS, $TAGS;
        if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}

        /* tag cms:show handles scope and arrays */
        $params[] = array('lhs'=>'as_json', 'op'=>'=', 'rhs'=>'1');
        if( !$json = $TAGS->show( $params, $node ) ) return;
        array_pop($params);

        extract( $FUNCS->get_named_vars(
                    array(
                          'json'=>'',
                          'as_html'=>'1',     /* show json as HTML-markup for best browser-view */
                          'html_encode'=>'1', /* HTML content in JSON nodes will be encoded, but pretty-markup will be not (if as_html=1)*/
                          'escape'=>'0',      /* strip slashes for best readability (ATTN! Some parsers do not like this valid JSON) */
                          'spaces'=>'3',      /* indent with 0 or more spaces */
                          'monospace'=>'1'    /* wrap in <pre> (if as_html=1)*/
                        ),
                    $params)
               );

        $as_html = ( $as_html==0 ) ? 0 : 1;
        $html_encode = ( $html_encode==0 ) ? 0 : 1;
        $escape = ( $escape==1 ) ? 1 : 0;
        $spaces = intval($spaces);
        $monospace = ( $monospace==0 ) ? 0 : 1;
        if( !$escape ) $json = stripslashes($json);
        if( $as_html && $html_encode ) $json = htmlspecialchars( $json, ENT_QUOTES, K_CHARSET );

        $result       = '';
        $pos          = 0;
        $strLen       = strlen($json);
        $indentStr    = ( $as_html==1 ) ? str_repeat("&nbsp;",$spaces) : str_repeat(" ",$spaces);
        $newLine      = ( $as_html==1 ) ? "<br>"  : (($spaces==0) ? "" : "\r\n");
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

        if( $as_html && $monospace ) $result = "<pre>".$result."</pre>";

        return $result;
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
