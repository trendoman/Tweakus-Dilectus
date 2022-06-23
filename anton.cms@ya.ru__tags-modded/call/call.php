<?php

   /**
   *   Allow mixed named, unnamed params
   *   Trim output
   *   @author @trendoman <tony.smirnov@gmail.com>
   *   @date   24.06.2022
   */

   $FUNCS->add_event_listener( 'alter_tag_call_execute', function($tag_name, &$params, $node, &$html){
      global $FUNCS;

      if (!is_null($params[0]['lhs']) ) return $break = false; // only user-defined functions
      $name = trim( $params[0]['rhs'] );
      if( !$name ) return $break = true;
      if( !array_key_exists($name, $FUNCS->funcs) ) return $break = true;

      $func = $FUNCS->funcs[$name];
      $_param = array_shift( $params );

      function prefill_params( $into, $from ){
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
            $params[] = array('lhs'=>$k,'op'=>'=','rhs'=>$into[$k]);
         }
         return $params;
      }

      $params = prefill_params( $func['params'], $params );
      array_unshift($params, $_param);

      return $break = false;
   });

   $FUNCS->add_event_listener( 'tag_call_executed', function($tag_name, &$params, $node, &$html){
      $html = trim($html);
   });

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
