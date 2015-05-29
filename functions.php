<?php

// Recommended plugins installer
require_once 'include/plugins/init.php';

// Shortcodes functions
require_once 'include/shortcodes.php';

// Custom functionality
require_once 'include/core.php';

//# Uncomit for add custom post type
// require_once('include/custom-cpt.php');
//# Register custom image size
// add_image_size( 'custom', '300', '300', true );
update_option('thumbnail_size_w', 200);
update_option('thumbnail_size_h', 200);
// update_option('medium_size_w', 400);
// update_option('medium_size_h', 350);
// update_option('large_size_w', 800);
// update_option('large_size_h', 400);


//#THEME SETINGS
//## Registered jQuery,  css and js file
function style_js() {
	wp_deregister_style('contact-form-7');
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
		wp_enqueue_script('jquery');
		// wp_enqueue_script('comment-reply');
	};
	// wp_enqueue_script('googlemaps', '//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array(), '', FALSE);
	wp_enqueue_script('libs', get_template_directory_uri() . '/js/lib.js', array('jquery'), '1.0', true);
	wp_enqueue_script('init', get_template_directory_uri() . '/js/init.js', array('jquery'), '1.0', true);
	wp_enqueue_style('style', get_template_directory_uri() . '/scss/main.css');
}
add_action('wp_enqueue_scripts', 'style_js');

//##Register menus
register_nav_menus(array(
	'head_menu' => 'Main navigation',
	'second_menu' => 'Second navigation',
	'foot_menu' => 'Footer navigation'
	));