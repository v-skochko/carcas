<?php
/*
/* Predefined settings
   ========================================================================== */
function my_acf_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyDUPkH8XAlVE39QDX5C-NZOqe-gciMfdA4' );
	acf_update_setting( 'enqueue_select2', false );
}

add_action( 'acf/init', 'my_acf_init' );
/*
/* ACF option page
   ========================================================================== */
if ( function_exists( 'acf_add_options_page' ) ) {
	// add parent
	$parent = acf_add_options_page( array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'redirect'   => false
	) );
	// add sub page
	acf_add_options_sub_page( array(
		'page_title'  => 'Global components',
		'menu_title'  => 'Components',
		'parent_slug' => $parent['menu_slug'],
	) );
}

/*
/* ACF Repeater Styles
   ========================================================================== */
function acf_repeater_even() {
	$scheme = get_user_option( 'admin_color' );
	$color  = '';
	switch ( $scheme ) {
		case 'fresh':
			$color = '#0073aa';
			break;
		case 'light':
			$color = '#d64e07';
			break;
		case 'blue':
			$color = '#52accc';
			break;
		case 'coffee':
			$color = '#59524c';
			break;
		case 'ectoplasm':
			$color = '#523f6d';
			break;
		case 'midnight':
			$color = '#e14d43';
			break;
		case 'ocean':
			$color = '#738e96';
			break;
		case 'sunrise':
			$color = '#dd823b';
			break;
	}
	echo '<style>.acf-repeater > table > tbody > tr:nth-child(even) > td.order {color: #fff !important;background-color: ' . $color . ' !important; text-shadow: none}.acf-fc-layout-handle {color: #fff !important;background-color: #23282d!important; text-shadow: none}</style>';
}

add_action( 'admin_footer', 'acf_repeater_even' );
/*
/* ACF Local JSON load point
   ========================================================================== */
add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );
function my_acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset( $paths[0] );
	// append path
	$paths[] = get_stylesheet_directory() . '/include/acf/load_point';

	// return
	return $paths;
}

add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );
function my_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/include/acf/save_point';

	// return
	return $path;
}
