<?php
/* Includ custom functions
   ========================================================================== */
// Recommended plugins installer
require_once 'include/plugins/init.php';
// Shortcodes functions
// require_once 'include/shortcodes.php';
// Custom functionality
require_once 'include/core.php';
// Uncomit for add custom post type
// require_once('include/custom-cpt.php');
/* Register custom image size
   ========================================================================== */
// add_image_size( 'custom', '300', '300', true );


/* Register menus
   ========================================================================== */
register_nav_menus(array(
    'head_menu' => 'Main navigation',
    'second_menu' => 'Second navigation',
    'foot_menu' => 'Footer navigation'
));

//excerpt custom  echo gebid($post->ID, '140' );
function gebid($post_id, $num, $readmore = ''){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = strip_tags(strip_shortcodes($the_post->post_content)); //Strips tags and images
    $more = trim(strip_tags(substr($the_post->post_content, 0, strpos($the_post->post_content, '<!--more'))));//check if post has more tag
    $words = explode(' ', $the_excerpt, $num + 1);
    if(count($words) > $num) :
    array_pop($words);
    array_push($words, '...');
    $the_excerpt = implode(' ', $words);
    endif;
    if($more != '') {
        $content = $more;
    } else {
        $content = '<p>' . $the_excerpt . '</p>';
    }
    return $content . ($readmore != ''?'<p class="readmore"><a href="' . get_permalink($post_id) . '">' . $readmore . '</a></p>':'');
}


//acf custom style
function acf_repeater_even() {
    $scheme = get_user_option( 'admin_color' );
    $color = '';
    if($scheme == 'fresh') {
        $color = '#0073aa';
    } else if($scheme == 'light') {
        $color = '#d64e07';
    } else if($scheme == 'blue') {
        $color = '#52accc';
    } else if($scheme == 'coffee') {
        $color = '#59524c';
    } else if($scheme == 'ectoplasm') {
        $color = '#523f6d';
    } else if($scheme == 'midnight') {
        $color = '#e14d43';
    } else if($scheme == 'ocean') {
        $color = '#738e96';
    } else if($scheme == 'sunrise') {
        $color = '#dd823b';
    }
    echo '<style>.acf-repeater>.acf-input-table > tbody > tr:nth-child(even)>.order {color: #fff !important;background-color: '.$color.' !important; text-shadow: none}</style>';
}
add_action('admin_footer', 'acf_repeater_even');
