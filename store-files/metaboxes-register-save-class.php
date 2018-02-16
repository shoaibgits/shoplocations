<?php

//actions for the meta fields
add_action("admin_init", "add_meta_for_cities");
add_action("admin_init", "add_meta_for_continents");
add_action("admin_init", "add_meta_for_country");
add_action("admin_init", "add_meta_for_latitude");
add_action("admin_init", "add_meta_for_store_address");
add_action("admin_init", "add_meta_for_store_contacts");

//Save Actions For meta options
add_action('save_post', 'save_loc_city');
add_action('save_post', 'save_loc_continents');
add_action('save_post', 'save_loc_country');
add_action('save_post', 'save_loc_latitude');
add_action('save_post', 'save_loc_longitude');
add_action('save_post', 'save_loc_address');
add_action('save_post', 'save_loc_phone');
add_action('save_post', 'save_loc_email');
add_action('save_post', 'save_loc_fax');
add_action('save_post', 'save_loc_website');

//Meta Box for Store Countries
function add_meta_for_store_contacts() {
    add_meta_box("loc_contacts", "Store Contact", "meta_options_contacts", "install" /* important link to the relevant post type */, "normal" /* ($context) where to position it on page */, "high");
}
//Meta Box for Store Countries
function add_meta_for_store_address() {
    add_meta_box("loc_address", "Store Address", "meta_options_address", "install" /* important link to the relevant post type */, "normal" /* ($context) where to position it on page */, "high");
}

//Meta Box for Store Countries
function add_meta_for_country() {
    add_meta_box("loc_country", "Store Country", "meta_options_countries", "install" /* important link to the relevant post type */, "normal" /* ($context) where to position it on page */, "high");
}

//Meta Box for Store Cities
function add_meta_for_cities() {
    add_meta_box("loc_city", "Store City", "meta_options_city", "install" /* important link to the relevant post type */, "normal" /* ($context) where to position it on page */, "high");
}

//Meta Box for Store Continents
function add_meta_for_continents() {
    add_meta_box("loc_continents", "Store Continent", "meta_options_continents", "install" /* important link to the relevant post type */, "normal" /* ($context) where to position it on page */, "high");
}

//Meta Box for Store Countries
function add_meta_for_latitude() {
    add_meta_box("loc_latitude", "Latitude / Longitude", "meta_options_latitude", "install" /* important link to the relevant post type */, "normal" /* ($context) where to position it on page */, "high");
}


function meta_options_contacts() {
    global $post;
    $custom = get_post_custom($post->ID);
    $loc_phone = $custom["loc_phone"][0];
    $loc_email = $custom["loc_email"][0];
    $loc_fax = $custom["loc_fax"][0];
    $loc_website = $custom["loc_website"][0];

    ?>

    <label>Store Phone:</label> <input type="text" name="loc_phone" value="<?php echo $loc_phone; ?>">
    <label>Store Fax:</label> <input type="text" name="loc_fax" value="<?php echo $loc_fax; ?>">  
    <label>Store Email:</label> <input type="text" name="loc_email" value="<?php echo $loc_email; ?>">
    <label>Store Website:</label> <input type="text" name="loc_website" value="<?php echo $loc_website; ?>">   
    <?php
}

function meta_options_address() {
    global $post;
    $custom = get_post_custom($post->ID);
    $loc_address = $custom["loc_address"][0];

    ?>

    <label>Add Store Address:</label> <input type="text" name="loc_address" value="<?php echo $loc_address; ?>" style="width: 600px;">  <?php
}

function meta_options_latitude() {
    global $post;
    $custom = get_post_custom($post->ID);
    $loc_latitude = $custom["loc_latitude"][0];
    $loc_longitude = $custom["loc_longitude"][0];

    ?>

  <label>Latitude of Sotr Location:</label> <input type="text" name="loc_latitude" value="<?php echo $loc_latitude; ?>"> 
  <label>Longitude of Sotr Location:</label> <input type="text" name="loc_longitude" value="<?php echo $loc_longitude; ?>">
  <?php
}
function meta_options_countries() {
    global $post;
    global $wpdb;
    $custom = get_post_custom($post->ID);
    //get the current selected countries
    $loc_country = $custom["loc_country"][0];
    $table_name = $wpdb->prefix . "countries";
    //get all countries from DB
    $store_countries = $wpdb->get_results( "SELECT * FROM $table_name" );        
    $decodeArray = json_decode($loc_country);
?>
<label>Keep Press the ctrl button and then select multiple countries*</label>
 <select id="country" name="loc_country[]" multiple="multiple">
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
    <?php
}
function meta_options_continents() {
    global $post;
    $custom = get_post_custom($post->ID);
    $loc_continents = $custom["loc_continents"][0];

    ?>

    <label>Add Store Continents:</label> <input type="text" name="loc_continents" value="<?php echo $loc_continents; ?>" style="width: 600px;">  <?php
}
function meta_options_city() {
    global $post;
    $custom = get_post_custom($post->ID);
    $loc_city = $custom["loc_city"][0];

    ?>

    <label>Add Store City:</label> <input type="text" name="loc_city" value="<?php echo $loc_city; ?>" style="width: 600px;">  <?php
}

//Save Fucntions For the meta options

function save_loc_website() {

    global $post;

    update_post_meta($post->ID, "loc_website", $_POST["loc_website"]);
}

function save_loc_phone() {

    global $post;

    update_post_meta($post->ID, "loc_phone", $_POST["loc_phone"]);
}

function save_loc_email() {

    global $post;

    update_post_meta($post->ID, "loc_email", $_POST["loc_email"]);
}

function save_loc_fax() {

    global $post;

    update_post_meta($post->ID, "loc_fax", $_POST["loc_fax"]);
}

function save_loc_address() {

    global $post;

    update_post_meta($post->ID, "loc_address", $_POST["loc_address"]);
}

function save_loc_country() {

    global $post;

    $posted_countries = $_POST["loc_country"];
    $encodedArray = json_encode($posted_countries);
    update_post_meta($post->ID, "loc_country", $encodedArray);
}
function save_loc_city() {

    global $post;

    update_post_meta($post->ID, "loc_city", $_POST["loc_city"]);
}
function save_loc_continents() {

    global $post;

    update_post_meta($post->ID, "loc_continents", $_POST["loc_continents"]);
}
function save_loc_latitude() {

    global $post;

    update_post_meta($post->ID, "loc_latitude", $_POST["loc_latitude"]);
}
function save_loc_longitude() {

    global $post;

    update_post_meta($post->ID, "loc_longitude", $_POST["loc_longitude"]);
}
?>