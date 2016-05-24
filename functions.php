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


function wpa__prelicense() {
    if( !acf_pro_is_license_active() ) {
        $args = array(
            '_nonce'  => wp_create_nonce('activate_pro_licence'),
            'acf_license' => base64_encode('order_id=37918|type=personal|date=2014-08-21 15:02:59'),
            'acf_version' => acf_get_setting('version'),
            'wp_name'  => get_bloginfo('name'),
            'wp_url'  => home_url(),
            'wp_version' => get_bloginfo('version'),
            'wp_language' => get_bloginfo('language'),
            'wp_timezone' => get_option('timezone_string'),
        );

        $response = acf_pro_get_remote_response( 'activate-license', $args );
        $response = json_decode($response, true);
        if( $response['status'] == 1 ) {
            acf_pro_update_license($response['license']);
        }
    }
}
add_action( 'after_setup_theme', 'wpa__prelicense' );
