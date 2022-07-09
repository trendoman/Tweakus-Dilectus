<?php

    /**
    *   Original tag is pretty powerful, but we can make it even more comfortable 8-)
    *
    *   1. Skip empty pieces: skip_empty='1'
    *   2. Loop from end to beginning: reverse='1'
    *   3. Use limit: limit='5'
    *   4. Retun count quickly: count_only='1'
    *
    *   @author @trendoman <tony.smirnov@gmail.com>
    *   @date   13.06.2019
    *   @last   09.07.2022
    */

    $FUNCS->add_event_listener( 'alter_tag_each_execute', 'my_tag_mod_each');
    function my_tag_mod_each( $tag_name, &$params, $node, &$html ){
            global $FUNCS, $CTX;
            extract( $FUNCS->get_named_vars(
                        array( 'var'=>'',
                               'as'=>'',
                               'sep'=>'|',
                               'key'=>'',
                               'startcount'=>'0',
                               'token'=>'',
                               'is_json'=>'0',
                               'is_regex'=>'0',
                               'skip_empty'=>'0',
                               'reverse'=>'0',
                               'limit'=>'0',
                               'count_only'=>'0'
                              ),
                        $params)
                   );

            $as = trim( $as ); if( $as=='' ){ $as='item'; }
            $key = trim( $key ); if( $key=='' ){ $key='key'; }
            $startcount = $FUNCS->is_int( $startcount ) ? intval( $startcount ) : 1;
            $token = trim( $token );
            $is_json = ( $is_json==1 ) ? 1 : 0;
            $is_regex = ( $is_regex==1 ) ? 1 : 0;
            $skip_empty = ( $skip_empty==1 ) ? 1 : 0;
            $reverse = ( $reverse==1 ) ? 1 : 0;
            $limit = ( $limit == 0 ) ? 0 : intval(trim($limit));
            $count_only = ( $count_only==1 ) ? 1 : 0;

            if( $is_json && !is_array($var) ){ $var = $FUNCS->json_decode( $var ); }

            if( !is_array($var) ){
                if( $is_regex ){
                    $regex = $sep;
                }
                else{
                    if( !$sep ) $sep = '|';
                    if( $sep == '\r\n' || $sep == '\r' || $sep == '\n' ){
                        $var = str_replace( array("\r\n", "\r", "\n" ), "\n", $var );
                        $sep = "\n";
                    }
                    elseif( $sep == '\t' ){
                        $sep = "\t";
                    }
                    else{
                        $use_preg=1;
                    }
                }

                if( $var ){
                    if( $regex ){
                        $arr_vars = array_map( "trim", preg_split( $regex, $var ) );
                    }
                    elseif( $use_preg ){
                        $arr_vars = array_map( "trim", preg_split( "/(?<!\\\)".preg_quote($sep, '/')."/", $var ) ); // allows escaping of separator with a backslash
                    }
                    else{
                        $arr_vars = array_map( "trim", explode( $sep, $var ) );
                    }
                }

                if( is_array($arr_vars) ){
                    $cnt_arr = count($arr_vars);
                    if( !$cnt_arr ) return;

                    $orig_cnt_arr = $cnt_arr;
                    if( $skip_empty ) $arr_vars = array_values(array_filter($arr_vars, 'strlen'));
                    if( $limit ) $arr_vars = array_slice($arr_vars, 0, $limit, true);
                    if( $reverse ) $arr_vars = array_reverse($arr_vars, false);
                    if( $skip_empty || $limit ) $cnt_arr = count($arr_vars);
                    if( $count_only ) return $cnt_arr;

                    $CTX->set( 'k_total_items', $cnt_arr );
                    $CTX->set( 'k_absolute_total', $orig_cnt_arr );
                    $children = $node->children;

                    for( $x=0; $x<$cnt_arr; $x++ ){
                        $CTX->set( 'k_count', $x + $startcount );
                        $CTX->set( 'k_first_item', ($x==0) ? '1' : '0' );
                        $CTX->set( 'k_last_item', ($x==$cnt_arr-1) ? '1' : '0' );
                        $CTX->set( $key, $x );
                        if( $use_preg ){
                            $CTX->set( $as, str_replace( '\\'.$sep, $sep, $arr_vars[$x] ) ); //unescape separator
                        }
                        else{
                            $CTX->set( $as, $arr_vars[$x] );
                        }

                        // setup a way for the child nodes to signal 'break' or 'continue'
                        $arr_config = array( 'break'=>0, 'continue'=>0 );
                        $CTX->set_object( '__config', $arr_config );

                        // HOOK: each_alter_ctx_xxx
                        if( $token ){
                            $FUNCS->dispatch_event( 'each_alter_ctx_'.$token, array($x /*key*/, $arr_vars[$x] /*value*/, $params, $node) );
                        }

                        foreach( $children as $child ){
                            $html .= $child->get_HTML();

                            if( $child->type==K_NODE_TYPE_CODE){
                                if( $arr_config['break'] ){ $count++; break 2; }
                                if( $arr_config['continue'] ){ $count++; continue 2; }
                            }
                        }
                    }
                }
            }
            else{
                $cnt_arr = count($var);
                if( !$cnt_arr ) return;
                $orig_cnt_arr = $cnt_arr;
                if( $skip_empty ) $var = array_values(array_filter($var, 'strlen'));
                if( $limit ) $var = array_slice($var, 0, $limit, true);
                if( $reverse ) $var = array_reverse($var, true);
                if( $skip_empty || $limit ) $cnt_arr = count($var);
                if( $count_only ) return $cnt_arr;

                $CTX->set( 'k_total_items', $cnt_arr );
                $CTX->set( 'k_absolute_total', $orig_cnt_arr );
                $children = $node->children;

                $count = 0;
                foreach( $var as $k=>$v ){
                    $CTX->set( 'k_count', $count + $startcount );
                    $CTX->set( 'k_first_item', ($count==0) ? '1' : '0' );
                    $CTX->set( 'k_last_item', ($count==$cnt_arr-1) ? '1' : '0' );
                    $CTX->set( $key, $k );
                    $CTX->set( $as, $v );

                    // setup a way for the child nodes to signal 'break' or 'continue'
                    $arr_config = array( 'break'=>0, 'continue'=>0 );
                    $CTX->set_object( '__config', $arr_config );

                    // HOOK: each_alter_ctx_xxx
                    if( $token ){
                        $FUNCS->dispatch_event( 'each_alter_ctx_'.$token, array($k /*key*/, $v /*value*/, $params, $node) );
                    }

                    foreach( $children as $child ){
                        $html .= $child->get_HTML();

                        if( $child->type==K_NODE_TYPE_CODE){
                            if( $arr_config['break'] ){ $count++; break 2; }
                            if( $arr_config['continue'] ){ $count++; continue 2; }
                        }
                    }

                    $count++;
                }
            }

            return $skip_orig_tag = true;
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
