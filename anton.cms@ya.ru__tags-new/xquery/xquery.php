<?php

   /**
   *   Tag <cms:xquery /> enumerates nodes following DOMXPATH->query().
   *
   *   @author "Anton S." <anton.cms@ya.ru>
   *   @date   24.07.2022
   */

   $FUNCS->register_tag( 'xquery', function ( $params, $node ) use ($FUNCS) {
      global $CTX;

      extract( $FUNCS->get_named_vars(
                 array(
                       'html'=>'',
                       'query'=>'',
                     ),
                 $params)
            );

      /* sanitize params */
      $html = trim( $html );
      $query = trim( $query );

      if( !$html ){
         $CTX->set( 'k_success', '0' );
         $CTX->set( 'k_error', 'HTML is empty' );
         return null;
      }

      libxml_use_internal_errors(true);

      $DOMDOC = new DOMDocument();
      $DOMDOC->loadHTML($html, LIBXML_NOBLANKS | LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NOWARNING | LIBXML_NONET);
      if( false === $DOMDOC ){
         $CTX->set( 'k_success', '0' );
         $CTX->set( 'k_error', 'HTML loading failed' );
         return null;
      }

      $XPATH = new DOMXPath( $DOMDOC );

      // Register the php: namespace (required)
      $XPATH->registerNamespace("php", "http://php.net/xpath");

      // Register PHP functions (no restrictions)
      $XPATH->registerPHPFunctions();

      $DOMNodeList = $XPATH->query( $query ); // ex: "//a/@href"

      if( false === $DOMNodeList ){
         $CTX->set( 'k_success', '0' );
         $CTX->set( 'k_error', 'QUERY is malformed' );
         return null;
      }
      $cnt_nodes = $DOMNodeList->count();
      $CTX->set( 'k_success', '1' );
      $CTX->set( 'k_total_items', $cnt_nodes );

      $children = $node->children;
      $html = '';
      $count = 0;
      foreach( $DOMNodeList as $DOMNode )
      {
         $str_content='';

         $CTX->set( 'k_count', $count );
         $CTX->set( 'k_first_item', ($count==0) ? '1' : '0' );
         $CTX->set( 'k_last_item', ($count==$cnt_nodes-1) ? '1' : '0' );

         $str_content = trim($DOMNode->nodeValue);
         $arr_lines = array_values( array_filter( array_map( "trim", explode( "\n", $str_content ) ), "strlen") );
         $CTX->set( 'nodeName', $DOMNode->nodeName );
         $CTX->set( 'nodeValue', $str_content );
         $CTX->set( 'nodeValue_lines', isset($arr_lines[0])? $arr_lines : '' );
         $CTX->set( 'nodePath', $DOMNode->getNodePath() );
         $CTX->set( 'parentNode', trim($DOMNode->parentNode->nodeName) );
         $CTX->set( 'parentValue', trim($DOMNode->parentNode->textContent) );
         $CTX->set( 'hasAttributes', $DOMNode->hasAttributes() );

         foreach( $DOMNode->attributes as $a ){
            //$attr[$a->nodeName] = trim($a->nodeValue);
            $CTX->set( '_'.$a->nodeName, trim($a->nodeValue) );
         }

        foreach( $children as $child ){
            $html .= $child->get_HTML();

            if( intval($CTX->get('_xquery_stop')) === 1 ){
               unset($CTX->ctx[count($CTX->ctx) - 1]['_scope_']['_xquery_stop']);
               $count++; break 2;
            }

            if( intval($CTX->get('_xquery_skip')) === 1 ){
               unset($CTX->ctx[count($CTX->ctx) - 1]['_scope_']['_xquery_skip']);
               $count++; continue 2;
            }
        }

        $count++;
      }
      libxml_clear_errors();
      return $html;
   }, 1, 1);
