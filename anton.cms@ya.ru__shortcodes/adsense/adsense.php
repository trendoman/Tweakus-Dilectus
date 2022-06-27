<?php

   /**
   *   Adsense shortcode.
   *   @date   12.06.2019
   */

   $FUNCS->register_shortcode( 'adsense', function ( $params, $content=null ){
   return '<script type="text/javascript"><!--
      google_ad_client = "pub-XXXXXXXXXXXXXXXX"; /* Put your own value here */
      google_ad_slot = "XXXXXXXXXX"; /* Put your own value here */
      google_ad_width = 468;
      google_ad_height = 60;
      //-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>';
   });
