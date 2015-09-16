<?php

//enqueue parent css

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_style', 30 );

function enqueue_child_theme_style() {
	wp_register_style( 'cfh', get_stylesheet_uri(), array('uu2014-stylesheet'));
    wp_enqueue_style( 'cfh' );
}

add_action( 'after_setup_theme', 'my_child_theme_setup' );
function my_child_theme_setup() {
    load_child_theme_textdomain( 'uu2014-cfh', get_stylesheet_directory() . '/languages' );
}


// hide ACF for site users

// add_filter('acf/settings/show_admin', 'my_acf_show_admin');

// function my_acf_show_admin( $show ) {
    
//     return current_user_can('manage_network');

// }



// remove menu items

function remove_menus(){
  
//  remove_menu_page( 'index.php' );                  //Dashboard
//  remove_menu_page( 'edit.php' );                   //Posts
//  remove_menu_page( 'upload.php' );                 //Media
//  remove_menu_page( 'edit.php?post_type=page' );    //Pages
//  remove_menu_page( 'edit-comments.php' );          //Comments
//  remove_menu_page( 'themes.php' );                 //Appearance
//  remove_menu_page( 'plugins.php' );                //Plugins
//  remove_menu_page( 'users.php' );                  //Users
//  remove_menu_page( 'tools.php' );                  //Tools
//  remove_menu_page( 'options-general.php' );        //Settings
  
}
add_action( 'admin_menu', 'remove_menus' );

// Register Custom Taxonomy
function custom_taxonomy_event() {

	$labels = array(
		'name'                       => _x( 'Events', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Event', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Event', 'text_domain' ),
		'all_items'                  => __( 'All Events', 'text_domain' ),
		'parent_item'                => __( 'Parent Event', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Event:', 'text_domain' ),
		'new_item_name'              => __( 'New Event', 'text_domain' ),
		'add_new_item'               => __( 'Add New Event', 'text_domain' ),
		'edit_item'                  => __( 'Edit Event', 'text_domain' ),
		'update_item'                => __( 'Update Event', 'text_domain' ),
		'view_item'                  => __( 'View Event', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate events with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove events', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Events', 'text_domain' ),
		'search_items'               => __( 'Search Events', 'text_domain' ),
		'not_found'                  => __( 'No events found.', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'event', array( 'post' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy_event', 0 );

// Gets post cat slug and looks for single-[cat slug].php and applies it
// Found on: https://wordpress.org/support/topic/how-to-change-single-post-template-based-on-category
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(STYLESHEETPATH . "/single-{$cat->slug}.php") )
		return STYLESHEETPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

// This snippet fixes Vimeo embedding 
// Found on: http://tinygod.pt/vimeo-embedding-on-wordpress/
add_filter( 'oembed_fetch_url', 'add_param_oembed_fetch_url', 10, 3);

function add_param_oembed_fetch_url($provider, $url, $args) {
    return $provider . '&' . urlencode(http_build_query($args));
}

