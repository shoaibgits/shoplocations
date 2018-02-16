<?php
/**
* Plugin Name: Shop Locations
* Plugin URI: http://www.germanits.com
* Description: This plugin adds custom posts in the admin section with define layout and show them to the front.
* Author: Shoaib Fareed
* Version: 1.0.0
* Author URI: http://www.germanits.com
* License: GPL2
*/

include( plugin_dir_path( __FILE__ ) . 'store-files/create-db-table.php');
include( plugin_dir_path( __FILE__ ) . 'store-files/register-post-type.php');
include( plugin_dir_path( __FILE__ ) . 'store-files/metaboxes-register-save-class.php');
include( plugin_dir_path( __FILE__ ) . 'store-files/store-results.php');

//hook to create DB table and insert data
register_activation_hook(__FILE__,'create_install_database_table');

add_action('admin_menu', 'shop_locations');

  wp_enqueue_style( "shop_locations-css", plugins_url( 'css/stylesheet.css', __FILE__ ) );
  wp_enqueue_style( "font-awesom", plugins_url( 'assets/font-awesome/css/font-awesome.min.css', __FILE__ ) );
  wp_register_script('custom-script', plugin_dir_url(__FILE__) . 'js/custom-scripts.js', array('jquery'), '1.0', true);
  wp_enqueue_script( 'custom-script' );

  function shop_locations(){
        // add_menu_page( 'Store Locator', 'Store Locator', 'manage_options', 'locations', 'stores_init' );
        //add submenu
        //add_submenu_page('installations', 'Add New Installations', 'Add Installations', 'manage_options', 'new_installation', 'new_installation_page');
}
    
