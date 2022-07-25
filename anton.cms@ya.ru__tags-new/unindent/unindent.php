<?php

    /**
    *   Remove excessive indentation
    *
    *   @example <cms:unindent 'text' />
    *   @example <cms:unindent my_text />
    *   @example <cms:unindent>my text</cms:unindent>
    *   @link
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   25.06.2019
    *   @last   25.07.2022
    */

    $FUNCS->register_tag( 'unindent', 'my_new_tag_unindent' );
    function my_new_tag_unindent( $params, $node ){
        global $FUNCS;

        extract( $FUNCS->get_named_vars(
                    array(
                          'text'=>'',
                          'full'=>'0',
                        ),
                    $params)
               );

        $text = trim($text);
        $full = intval($full) ? 1 : 0;
        if( !$FUNCS->strlen($text) ){
            foreach( $node->children as $child ){
                $text .= $child->get_HTML();
            }
        }
        $text = trim($text);
        if( $text == '' ) return;

        if( $full ){
           $lines = array_values( array_filter( array_map( "trim", explode( "\n", $text ) ), "strlen") );
           return implode("\n", $lines);
        }
        $lines = array_filter( explode( "\r\n", $text ), function($str){
            return strlen(trim($str)) !== 0;
        });
        $indents = array();
        foreach( $lines as $line ){
            preg_match('/^(&nbsp;|\s*)*/', $line, $matches);
            if( strlen($matches[0]) > 0 ) $indents[] = $matches[0];
        }
        $excess = (!empty($indents)) ? min($indents) : '';
        foreach( $lines as $k=>$line ){
           $lines[$k] = preg_replace("/^($excess)/", '', $line);
        }

        $text = implode("\n", $lines);
        return trim($text);
    }
