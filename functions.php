<?php
define('HOME_PAGE_ID', get_option('page_on_front'));
define('BLOG_ID', get_option('page_for_posts'));
define('POSTS_PER_PAGE', get_option('posts_per_page'));
/* INCLUD CUSTOM FUNCTIONS
   ========================================================================== */
// Recommended plugins installer
require_once 'include/plugins/init.php';
// Custom functionality
require_once 'include/core.php';
require_once 'include/acf/acf-settings.php';
//require_once 'include/woocommerce.php';
// require_once('include/cpt.php');

//update image  size
//add_image_size('size_580_700', 580, 700, array('center', 'top'));

/* REGISTER MENUS
   ========================================================================== */
register_nav_menus(array(
    'main_menu' => 'Main navigation',
    'second_menu' => 'Second navigation',
    'foot_menu' => 'Footer navigation'
));

