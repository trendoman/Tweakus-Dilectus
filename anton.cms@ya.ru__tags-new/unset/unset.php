<?php

  /**
   * Unset a variable
   * <cms:unset vars />
   *
   * @author @trendoman <tony.smirnov@gmail.com>
   * @date   30.06.2022
   */

   $FUNCS->register_tag( 'unset', 'my_new_tag_unset' );
   function my_new_tag_unset( $params, $node )
   {
      global $CTX, $TAGS;
      if( count($node->children) ) {die("ERROR: Tag \"".$node->name."\" is a self closing tag");}

      $var_names = $TAGS->show( $params, $node );
      if( !is_string($var_names) ) return;

      $scope = ( $params[1]['rhs'] == 'global' ) ? 2 : false; // 'parent' is default
      foreach( array_map( "trim", explode( ',', $var_names )) as $var )
      {
         if( false === strpos($var, '.') )
         {
             if($scope)
             {
                 // search only in global scope
                 if( isset($CTX->ctx[0]['_scope_']) )
                 {
                     unset( $CTX->ctx[0]['_scope_'][$var] );
                 }
                 continue;
             }

             // search and destroy a variable in the first scope it was found hiding.
             for( $x=count($CTX->ctx)-1; $x>=0; $x-- )
             {
                 if( isset($CTX->ctx[$x]['_scope_']) && isset($CTX->ctx[$x]['_scope_'][$var]) )
                 {
                     unset( $CTX->ctx[$x]['_scope_'][$var] );
                     break;
                 }
             }
             continue;
         }

         // we are dealing with arrays now e.g "zoo.mammals.dogs.small"
         $keys = array_map( "trim", explode('.', $var) );
         $arr_name = array_shift( $keys ); // 'zoo'
         $source = $CTX->_get( $arr_name, $scope ); // content of 'zoo'
         $pointer = &$source; // will modify the content of 'zoo'
         $cnt_keys = count( $keys );
         for( $x=0; $x<$cnt_keys; $x++ )
         {
             $key = $keys[$x];
             if( $key=='' ) $key=0;

             if( is_array($pointer) && isset($pointer[$key]) )
             {
                 if( $x==$cnt_keys-1 )
                 {
                     $pointer[$key] = null;
                     unset( $pointer[$key], $pointer );
                     break 1;
                 }
                 else{
                     $pointer = &$pointer[$key];
                 }
             }
             else{
                 unset( $pointer );
                 continue;
             }
         }

         $scope = ( $scope ) ? 'global' : 'parent';
         $CTX->set( $arr_name, $source, $scope );
      }
   }
