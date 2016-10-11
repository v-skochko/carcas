<?php
define( 'HOME_PAGE_ID', get_option( 'page_on_front' ) );
define( 'BLOG_ID', get_option( 'page_for_posts' ) );
define( 'POSTS_PER_PAGE', get_option( 'posts_per_page' ) );
/* INCLUD CUSTOM FUNCTIONS
   ========================================================================== */
// Recommended plugins installer
require_once 'include/plugins/init.php';
// Custom functionality
require_once 'include/core.php';
// Uncomit for add custom post type
// require_once('include/custom-cpt.php');
/*CUSTOM IMAGE SIZE
   ========================================================================== */
// add_image_size( '300x300_cropped', '300', '300', true );
//Default Thumbnail Sizes
// update_option('thumbnail_size_w',160);
// update_option('thumbnail_size_h',80);
// update_option('medium_size_w',640);
// update_option('medium_size_h',320);
// update_option('large_size_w',1920);
// update_option('large_size_h',640);
/* REGISTER MENUS
   ========================================================================== */
register_nav_menus( array(
	'main_menu'   => 'Main navigation',
	'second_menu' => 'Second navigation',
	'foot_menu'   => 'Footer navigation'
) );
function socail_link() { ?>
	<a href="<?php if ( get_field( 'facebook', 'options' ) ) {
		the_field( 'facebook', 'options' );
	} else {
		echo 'https://www.facebook.com/';
	} ?>" class="i-c-bk" title="Official Facebook page" target="_blank"></a>
	<a href="<?php if ( get_field( 'instagram', 'options' ) ) {
		the_field( 'instagram', 'options' );
	} else {
		echo 'https://www.instagram.com/';
	} ?>" class="i-c-ism" title="Official Instagram accounts" target="_blank"></a>
	<a href="<?php if ( get_field( 'twitter', 'options' ) ) {
		the_field( 'twitter', 'options' );
	} else {
		echo 'https://twitter.com/';
	} ?>" class="i-c-tr" title="Official Twitter accounts" target="_blank"></a>
	<a href="<?php if ( get_field( 'linkedin', 'options' ) ) {
		the_field( 'linkedin', 'options' );
	} else {
		echo 'https://www.linkedin.com/';
	} ?>" class="i-c-ln" title="Official Linkedin profile" target="_blank"></a>
	<a href="<?php if ( get_field( 'google', 'options' ) ) {
		the_field( 'google', 'options' );
	} else {
		echo 'https://plus.google.com/';
	} ?>" class="i-c-gp" title="Official Google+ page" target="_blank"></a>
	<a href="<?php if ( get_field( 'pinterest', 'options' ) ) {
		the_field( 'pinterest', 'options' );
	} else {
		echo 'https://pinterest.com/';
	} ?>" class="i-c-pr" title="Official Pinterest accounts" target="_blank"></a>
	<a href="<?php if ( get_field( 'youtube', 'options' ) ) {
		the_field( 'youtube', 'options' );
	} else {
		echo 'https://www.youtube.com/';
	} ?>" class="i-c-yb" title="Official Youtube channel" target="_blank"></a>
<?php }