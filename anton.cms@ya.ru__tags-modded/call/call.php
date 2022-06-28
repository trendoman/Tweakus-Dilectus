<?php

   /**
   *   Allow mixed named, unnamed params
   *   Trim output
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   24.06.2022
   */

   $FUNCS->add_event_listener( 'alter_tag_call_execute', function($tag_name, &$params, $node, &$html){
      global $FUNCS;

      $name = trim( $params[0]['rhs'] );
      if( !$name || !array_key_exists($name, $FUNCS->funcs) ) return $stop_propagation = false;

      $func = $FUNCS->funcs[$name];
      $_param = array_shift( $params );
      $params = _get_named_params( $func['params'], $params );
      array_unshift($params, $_param);

      return $stop_propagation = false;
   });

   $FUNCS->add_event_listener( 'tag_call_executed', function($tag_name, &$params, $node, &$html){
      $html = trim($html);
   });

   function _get_named_params ( $into, $from ) {
      $named = $unnamed = $params = array();

      foreach( $from as $param ){
         if( $param['lhs'] ){ $named[$param['lhs']] = $param['rhs']; }
         else { $unnamed[] = $param['rhs']; }
      }

      foreach( $into as $k=>$v ){
         if( isset($named[$k]) ){
            $into[$k] = $named[$k];
         } elseif ( isset($unnamed[0]) ){
            $into[$k] = array_shift($unnamed);
         }
      }

      $named = $into+$named;
      foreach( $named as $k=>$v ){
         $params[] = array('lhs'=>$k,'op'=>'=','rhs'=>$named[$k]);
      }

      return $params;
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
