<?php

add_action( 'init', 'register_cpt' );
function register_cpt() {
//custom taxonomy attached to  CPT
	$taxlabels = array(
		'name'                       => 'taxcpt',
		'singular_name'              => 'taxcpt',
		'search_items'               => 'Search taxcpt',
		'popular_items'              => 'Popular taxcpt',
		'all_items'                  => 'All taxcpts',
		'parent_item'                => 'Parent taxcpt',
		'edit_item'                  => 'Edit taxcpt',
		'update_item'                => 'Update taxcpt',
		'add_new_item'               => 'Add New taxcpt',
		'new_item_name'              => 'New taxcpt',
		'separate_items_with_commas' => 'Separate types with commas',
		'add_or_remove_items'        => 'Add or remove types',
		'choose_from_most_used'      => 'Choose from most used types'
	);
	$taxarr    = array(
		'label'             => 'taxcpt',
		'labels'            => $taxlabels,
		'public'            => true,
		'hierarchical'      => true,
		'show_in_nav_menus' => true,
		'args'              => array( 'orderby' => 'term_order' ),
		'query_var'         => true,
		'show_ui'           => true,
		'rewrite'           => true,
	);
	register_taxonomy( 'taxcpt', 'cpt', $taxarr );
	register_post_type( 'cpt',
		array(
			'labels'            => array(
				'name'               => 'Custom post type',
				'singular_name'      => 'cpt',
				'add_new'            => 'Add New',
				'add_new_item'       => 'Add New',
				'edit_item'          => 'Edit',
				'new_item'           => 'New',
				'all_items'          => 'All',
				'view_item'          => 'View',
				'search_items'       => 'Search',
				'not_found'          => 'Not found',
				'not_found_in_trash' => 'No found in Trash',
				'parent_item_colon'  => '',
				'menu_name'          => 'Custom pt'
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'supports'          => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'menu_icon'         => 'dashicons-flag',
			'rewrite'           => array( 'slug' => 'cpt' /* , 'with_front' => false */ ),
			'has_archive'       => true,
			'hierarchical'      => true,
			'show_in_nav_menus' => true,
			'capability_type'   => 'page',
			'query_var'         => true,
		) );
// flush_rewrite_rules();
}
