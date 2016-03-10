<?php
/* INCLUD CUSTOM FUNCTIONS
   ========================================================================== */
// Recommended plugins installer
require_once 'include/plugins/init.php';
// Shortcodes functions
// require_once 'include/shortcodes.php';
// Custom functionality
require_once 'include/core.php';
// Uncomit for add custom post type
// require_once('include/custom-cpt.php');
/* REGISTER CUSTOM IMAGE SIZE
   ========================================================================== */
// add_image_size( 'custom', '300', '300', true );

//Default Thumbnail Sizes
// if(get_option('thumbnail_size_w')!=160)update_option('thumbnail_size_w',160);
// if(get_option('thumbnail_size_h')!=80)update_option('thumbnail_size_h',80);
// if(get_option('medium_size_w')!=640)update_option('medium_size_w',640);
// if(get_option('medium_size_h')!=320)update_option('medium_size_h',320);
// update_option('large_size_w',1920);
// update_option('large_size_h',640);

/* REGISTER MENUS
   ========================================================================== */
register_nav_menus(array(
    'head_menu' => 'Main navigation',
    'second_menu' => 'Second navigation',
    'foot_menu' => 'Footer navigation'
));
