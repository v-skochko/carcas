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
/*CUSTOM IMAGE SIZE
   ========================================================================== */
// add_image_size( 'custom', '300', '300', true );

//Default Thumbnail Sizes
// update_option('thumbnail_size_w',160);
// update_option('thumbnail_size_h',80);
// update_option('medium_size_w',640);
// update_option('medium_size_h',320);
// update_option('large_size_w',1920);
// update_option('large_size_h',640);


/* REGISTER MENUS
   ========================================================================== */
register_nav_menus(array(
    'main_menu' => 'Main navigation',
    'second_menu' => 'Second navigation',
    'foot_menu' => 'Footer navigation'
));

//simple function for wp_get_attachment_image_src()
//  echo  image_src( get_field('top_background') , 'medium', true ); 
function image_src($id, $size = 'full', $background_image = false, $height = false) {
    if ($image = wp_get_attachment_image_src($id, $size, true)) {
        return $background_image ? 'background-image: url('.$image[0].');' . ($height?'height:'.$image[2].'px':'') : $image[0];
    }
}
