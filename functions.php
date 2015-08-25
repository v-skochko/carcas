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
