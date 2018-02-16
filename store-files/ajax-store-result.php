<?php
add_action( 'wp_ajax_my_ajax', 'my_ajax' );
add_action("wp_ajax_nopriv_my_ajax", "my_ajax");

function my_ajax() {

$countryInput = $_POST['country'];

global $wpdb;

$result = $wpdb->get_results ( "SELECT post_id
            FROM `wp_postmeta`
            WHERE `meta_value` LIKE '%".$countryInput."%'
            AND meta_key = 'loc_country'
" );

      $currentStoreiD  =  $result[0]->post_id;
      
       $storeData = wp_get_single_post($currentStoreiD, $mode = OBJECT );
       $storeID =  $storeData->ID;
                
           if(!empty($storeData)) { ?>

<div class="store-locator-wrapper">
    <?php
        $storeHtml = '';

                $storeHtml .= '<div class="main-store-container">
                      <div class="store-wrapper">

                        <div class="store-image">
                          <a href=" '.get_permalink($storeID) . '">
                          '. get_the_post_thumbnail($storeID, "large").
                        '</a></div>
                        <div class="store-contents">
                          <div class="store-title">
                          <h2>'.
                            $storeTiele = $storeData->post_title .'
                          </h2></div>
                          <div class="str-address">
                           <i class="fa fa-home" aria-hidden="true"></i> '. $storeAddress =  get_post_meta($storeID , "loc_address", true) .'
                          </div>
                          <div class="str-phone">
                           <i class="fa fa-phone" aria-hidden="true"></i>  <span class="extra-infos">'. $storePhone =  get_post_meta($storeID , "loc_phone", true) .'</span>
                          </div>
                           <div class="str-fax">
                           <i class="fa fa-fax" aria-hidden="true"></i>  <span class="extra-infos">'. $storeFax =  get_post_meta($storeID , "loc_fax", true) .'</span>
                          </div>
                          <div class="str-email">
                           <i class="fa fa-envelope-o" aria-hidden="true"></i>  <span class="extra-infos"><a href="mailto:'.get_post_meta($storeID , "loc_email", true).'">'. $storeEmail=  get_post_meta($storeID , "loc_email", true) .'</a></span>
                          </div>
                          <div class="str-website">
                           <i class="fa fa-globe" aria-hidden="true"></i>  <span class="extra-infos"><a href="'.get_post_meta($storeID , "loc_website", true).'">'.$storeWebsite =  get_post_meta($storeID , "loc_website", true).'</a></span>
                          </div>
                        </div>
                      </div>
                      <div class="loaction-map-store">
                        <iframe src="https://maps.google.com/maps?q='.get_post_meta($storeID , "loc_latitude", true).','.get_post_meta($storeID , "loc_longitude", true).'&hl=en&z=14&amp;output=embed" width="100%" height="385" frameborder="0" style="border:0" allowfullscreen></iframe>
                       </div></div>';              

          echo $storeHtml;
           ?>
          </div>

   <?php  } else {

          echo "No Store Found, Please Search Instead!";
   }
   exit();
}
?>