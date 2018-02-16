<?php

function new_installation_page()

{

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

	$labels = array(
		'name'               => _x( 'Store Locator', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Store', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Store Locator', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Store', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Store', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Store', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Store', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Store', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Store', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Store', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Store', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Store:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Store found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Store found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'store' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail','custom-fields', 'excerpt', 'comments' )
	);

	register_post_type( 'install', $args );
}

  add_action( 'init', 'new_installation_page' );

  //Register Single Page For the Custom Post type

  /* Filter the single_template with our custom function*/
function load_person_template($template) {

    global $post;

    // Is this a "my-custom-post-type" post?
    if ($post->post_type == "install"){

        //Your plugin path 
        $plugin_path = plugin_dir_path( __FILE__ );

        // The name of custom post type single template
        $template_name = 'single-install.php';

        // A specific single template for my custom post type exists in theme folder? Or it also doesn't exist in my plugin?
        if($template === get_stylesheet_directory() . '/templates' . $template_name
            || !file_exists($plugin_path . $template_name)) {

            //Then return "single.php" or "single-my-custom-post-type.php" from theme directory.
            return $template;
        }

        // If not, return my plugin custom post type template.
        return $plugin_path . $template_name;
    }

    //This is not my custom post type, do nothing with $template
    return $template;
}
add_filter('single_template', 'load_person_template');
?>