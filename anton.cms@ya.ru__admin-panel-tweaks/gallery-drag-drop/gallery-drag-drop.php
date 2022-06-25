<?php

   if ( !defined('K_COUCH_DIR') ) die(); // cannot be loaded directly

   /**
   *   Server-side component for 'gallery-drag-drop' feature
   *   @author Anton S. aka Trendoman <tony.smirnov@gmail.com>
   *   @date   26.06.2022
   */

   $FUNCS->add_event_listener( 'ajax_action_reorder_gallery', function(){
      global $FUNCS, $DB;

      $ids_orig_order = (array)$_POST['source'];
      $ids_dest_order = (array)$_POST['target'];

      $count_ids_orig = count( $ids_orig_order );
      $count_ids_dest = count( $ids_dest_order );
      if( $count_ids_orig < 2 || $count_ids_orig!=$count_ids_dest ) return;
      if( count($ids_orig_order) != $count_ids_orig ) return;
      if( count($ids_dest_order) != $count_ids_dest ) return;

      // sanitize
      $ids_orig_order = array_filter( $ids_orig_order, array($FUNCS, '_validate_natural') );
      $ids_dest_order = array_filter( $ids_dest_order, array($FUNCS, '_validate_natural') );

      // get selected pages
      $ids = implode( ",", $ids_orig_order );
      $my_query_fields = array( 'p.id', 'p.k_order' );
      $my_sql = "p.id IN(". $ids .")";
      $my_sql .= " ORDER BY FIELD(p.id,". $ids .")";
      $rs = $DB->select( K_TBL_PAGES . ' p', $my_query_fields, $my_sql );

      if( !count($rs) ) die( 'Pages not fetched..' );

      // propagate new order
      $DB->begin();

      foreach( $ids_dest_order as $k=>$id ){
         $DB->update( K_TBL_PAGES, array('k_order'=>$rs[$k]['k_order']), "id='". $DB->sanitize($id) ."'" );
      }

      $DB->commit();
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
