<?php

include( plugin_dir_path( __FILE__ ) . 'ajax-store-result.php');

//Get Stores From DB Post type
function getStores(){

     $args = array('post_type'=>'install' ,'posts_per_page' => -1, 'offset' => 0);
 
     $events_new = get_posts($args);

        foreach ($events_new as $calendar_events_new) {
	       setup_postdata( $post ); 
	        
           $locCity[] =  get_post_meta($calendar_events_new->ID, "loc_city", true);
           $locCountry[] =  get_post_meta($calendar_events_new->ID, "loc_country", true);
           $locContinent[] =  get_post_meta($calendar_events_new->ID, "loc_continents", true);

        ?> 

  <?php  }
  return array( 'cities' => $locCity , 'countries' => $locCountry, 'continents' => $locContinent);
   wp_reset_postdata();
}

// create shortcode
function new_installation($atts) {
		global $post , $wpdb;
        $storesMetaInfo = getStores() ;

        $citieOptions = array_unique($storesMetaInfo['cities']); 
        $countriesOptions = array_unique($storesMetaInfo['countries']);
        $continentsOptions = array_unique($storesMetaInfo['continents']);
        
        //get all countries from DB
		$table_name = $wpdb->prefix . "countries";
		$store_countries = $wpdb->get_results( "SELECT * FROM $table_name" );
		$decodeArray = json_decode($loc_country); 

    ?>
    <div class="form-main-wrapper">
      <img style="height: 300px; width: 100%;" src="<?php echo plugins_url('Shoplocations/images/countries-flags.jpg'); ?>" />
      <h2 class="banner-under">Contact Worldwide</h2>
      <div class="head-information">
        <span class="small-orange-heading">Are You looking For your contact in sales worldwide?</span>
        <p>Simply Select Your Country and Other Information to find your contact Righ away!</p>
      </div>
      <form method="POST" action="" name="storelocator" id="storelocator">
              <input type="hidden" name="searQuery">
                <div class="store-input-selector">
                  	<div class="formInputs">
                  		<select id="country" name="country">
							<option value="">Please, Choose a Country</option>
							<?php 
								foreach ($store_countries as $scountry) { 
								$selected = "";
									if(in_array($scountry->iso, $decodeArray)) {
										$selected = "selected='selected'";
									}
							?>
							<option value="<?php echo $scountry->iso ;?>" <?php echo $selected ?> ><?php echo $scountry->name ;?></option>

							<?php
								}
							?>
						</select>
					</div>
                </div>
                <div class="store-submit-input" style="display: none;">
                  <input type="submit" name="searhStores" value="Store Search" />
                </div>
        </form>
  </div>
   <div class="store-post-data"></div>
   <div style="clear: both;"></div>
   <div class="global-map-section">
      <img style="width: 100%;" src="<?php echo plugins_url('Shoplocations/images/map-global.png'); ?>" />
   </div> 
<?php  
}
add_shortcode('new_installation', 'new_installation');
