<?php
add_action( 'wp_enqueue_scripts', 'mgt_dequeue_stylesandscripts', 100 );
function mgt_dequeue_stylesandscripts() {
	if ( class_exists( 'woocommerce' ) ) {
		wp_dequeue_style( 'select2' );
		wp_deregister_style( 'select2' );
		wp_dequeue_script( 'select2' );
		wp_deregister_script( 'select2' );
	}
}

add_action( 'after_setup_theme', 'yourtheme_setup' );


//declare WC support
function aventurine_child_wc_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'aventurine_child_wc_support' );

function yourtheme_setup() {
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}


add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
	// $cols contains the current number of products per page based on the value stored on Options -> Reading
	// Return the number of products you wanna show per page.
	$cols = 12;

	return $cols;
}
