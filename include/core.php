<?php
/* ==========================================================================
    THEME TWEAKS
   ========================================================================== */
/* Registered jQuery,  css and js file
   ========================================================================== */
function style_js() {
	wp_deregister_style( 'contact-form-7' );
	wp_deregister_style( 'wp-pagenavi' );
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js' );
		wp_enqueue_script( 'jquery' );
	};
	// wp_enqueue_script('googlemaps', '//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array(), '', FALSE);
	wp_enqueue_script( 'libs', get_template_directory_uri() . '/js/lib.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'init', get_template_directory_uri() . '/js/init.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/scss/main.css' );
	wp_enqueue_style( 'plugins', get_template_directory_uri() . '/scss/components/100_lib.css' );
	//wp_enqueue_style('style', get_template_directory_uri() . '/scss/main.css?uid='.md5(uniqid(rand(),1)));
}

add_action( 'wp_enqueue_scripts', 'style_js' );
/* After_switch_theme
   ========================================================================== */
add_action( 'after_switch_theme', 'my_theme_activation' );
function my_theme_activation() {
	//Set permalink settings
	global $wp_rewrite;
	$wp_rewrite->set_permalink_structure( '%postname%' );
}

/* Thumbnails theme support
   ========================================================================== */
add_theme_support( 'post-thumbnails' );
/* Add wiget
   ========================================================================== */
function aside_widget_init() {
	register_sidebar( array(
		'name'          => 'Aside widget',
		'id'            => 'aside_widget',
		'before_widget' => '<div class="widget_item">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'aside_widget_init' );
/* Update wp-scss setings
   ========================================================================== */
if ( class_exists( 'Wp_Scss_Settings' ) ) {
	$wpscss = get_option( 'wpscss_options' );
	if ( empty( $wpscss['css_dir'] ) && empty( $wpscss['scss_dir'] ) ) {
		update_option( 'wpscss_options', array(
			'css_dir'           => '/scss/',
			'scss_dir'          => '/scss/',
			'compiling_options' => 'scss_formatter_expanded'
		) );
	}
}
/* ==========================================================================
/*
/*
Remove default wordpress function
- Clean up wp_head()
- Remove WP Generator Meta Tag
- Remove wp version param from any enqueued scripts
- Remove dashboard wigets
- Remove default wigets
- Hide the Admin Bar
- For coments: remove Email & Url fields
========================================================================== */
/* clean_up_wp_head()
========================================================================== */
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
function clean_up_wp_head() {
	// Remove the REST API lines from the HTML Header
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	// Remove the REST API endpoint.
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	// Turn off oEmbed auto discovery.
	add_filter( 'embed_oembed_discover', '__return_false' );
	// Don't filter oEmbed results.
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}

add_action( 'after_setup_theme', 'clean_up_wp_head' );
/* Remove wp version param from any enqueued scripts
   ========================================================================== */
function vc_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}

add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
/* Remove dashboard wigets
   ========================================================================== */
remove_action( 'welcome_panel', 'wp_welcome_panel' );
function rem_dash_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'normal' );
}

add_action( 'admin_init', 'rem_dash_widgets' );
/* Remove default wigets
   ========================================================================== */
function cwwp_unregister_default_widgets() {
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Calendar' );
	// unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	// unregister_widget( 'WP_Widget_Text' );
}

add_action( 'widgets_init', 'cwwp_unregister_default_widgets' );
/* remove dafaul class for menu
   ========================================================================== */
add_filter( 'nav_menu_css_class', 'wpa_discard_menu_classes', 10, 2 );
add_filter( 'nav_menu_item_id', '__return_false', 10 );
function wpa_discard_menu_classes( $classes, $item ) {
	$classes = array_filter(
		$classes, create_function( '$class', 'return in_array( $class, array( "current-menu-item", "current-menu-parent", "menu-item-has-children" ) );' )
	);

	return array_merge(
		$classes,
		(array) get_post_meta( $item->ID, '_menu_item_classes', true )
	);
}

/* ==========================================================================
CUSTOM STYLE
- Custom logo on login page
- Custom css in admin panel
- Custom info to admin footer area
- Color scheme "Midnight" set as default
========================================================================== */
/* Custom logo on login page
   ========================================================================== */
add_action( 'login_head', 'namespace_login_style' );
function namespace_login_style() {
	echo '<style>.login h1 a { background-image: url( ' . get_template_directory_uri() . '/img/login-logo.png ) !important;height: 135px!important; }</style>';
}

/* Change admin post/page color by status – draft, pending, future, private
   ========================================================================== */
function c_css() { ?>
    <style>
        .status-draft {
            background: #E6E6E6 !important;
        }
        .status-pending {
            background: #E2F0FF !important;
        }
        .status-future {
            background: #C6EBF5 !important;
        }
        .status-private {
            background: #F2D46F;
        }
        #toplevel_page_edit-post_type-acf-field-group {
            border-top: 1px solid #ccc !important;
        }
        .acf-repeater > .acf-table > .ui-sortable > .acf-row:nth-child(even) > .order {
            color: #fff !important;
            background-color: #777 !important;
        }
    </style>
	<?php
}

add_action( 'admin_footer', 'c_css' );

/* Color scheme "Midnight" set as default
   ========================================================================== */
add_filter( 'get_user_option_admin_color', function ( $color_scheme ) {
	global $_wp_admin_css_colors;
	if ( 'classic' == $color_scheme || 'fresh' == $color_scheme ) {
		$color_scheme = 'midnight';
	}

	return $color_scheme;
}, 5 );
/* ==========================================================================
CUSTOM FUNCTION
- Body class
- Custom WP Title
- Custom theme url
- ACF option page
========================================================================== */
/* Body class
   ========================================================================== */
function wpa_body_classes( $classes ) {
	if ( is_page() ) {
		global $post;
		$temp = get_page_template();
		if ( $temp != null ) {
			$path      = pathinfo( $temp );
			$tmp       = $path['filename'] . "." . $path['extension'];
			$tn        = str_replace( ".php", "", $tmp );
			$classes[] = $tn;
		}
		foreach ( $classes as $k => $v ) {
			if (
				$v == 'page-template' ||
				$v == 'page-id-' . $post->ID ||
				$v == 'page-template-default' ||
				$v == 'woocommerce-page' ||
				( $temp != null ? ( $v == 'page-template-' . $tn . '-php' || $v == 'page-template-' . $tn ) : '' )
			) {
				unset( $classes[ $k ] );
			}
		}
	}
	if ( is_single() ) {
		global $post;
		$f = get_post_format( $post->ID );
		foreach ( $classes as $k => $v ) {
			if ( $v == 'postid-' . $post->ID || $v == 'single-format-' . ( ! $f ? 'standard' : $f ) ) {
				unset( $classes[ $k ] );
			}
		}
	}
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	$browser = $_SERVER['HTTP_USER_AGENT'];
	// Mac, PC ...or Linux
	if ( preg_match( "/Mac/", $browser ) ) {
		$classes[] = 'macos';
	} elseif ( preg_match( "/Windows/", $browser ) ) {
		$classes[] = 'windows';
	} elseif ( preg_match( "/Linux/", $browser ) ) {
		$classes[] = 'linux';
	} else {
		$classes[] = 'unknown-os';
	}
	// Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
	if ( preg_match( "/Edge/", $browser ) ) {
		$classes[] = 'edge';
	} elseif ( preg_match( "/Chrome/", $browser ) ) {
		$classes[] = 'chrome';
		preg_match( "/Chrome\/(\d.\d)/si", $browser, $matches );
		@$classesh_version = 'ch' . str_replace( '.', '-', $matches[1] );
		$classes[] = $classesh_version;
	} elseif ( preg_match( "/Safari/", $browser ) ) {
		$classes[] = 'safari';
		preg_match( "/Version\/(\d.\d)/si", $browser, $matches );
		@$sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
		$classes[] = $sf_version;
	} elseif ( preg_match( "/Opera/", $browser ) ) {
		$classes[] = 'opera';
		preg_match( "/Opera\/(\d.\d)/si", $browser, $matches );
		$op_version = 'op' . str_replace( '.', '-', $matches[1] );
		$classes[]  = $op_version;
	} elseif ( preg_match( "/MSIE/", $browser ) ) {
		$classes[] = 'msie';
		if ( preg_match( "/MSIE 6.0/", $browser ) ) {
			$classes[] = 'ie6';
		} elseif ( preg_match( "/MSIE 7.0/", $browser ) ) {
			$classes[] = 'ie7';
		} elseif ( preg_match( "/MSIE 8.0/", $browser ) ) {
			$classes[] = 'ie8';
		} elseif ( preg_match( "/MSIE 9.0/", $browser ) ) {
			$classes[] = 'ie9';
		}
	} elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
		$classes[] = 'firefox';
		preg_match( "/Firefox\/(\d)/si", $browser, $matches );
		$ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
		$classes[]  = $ff_version;
	} else {
		$classes[] = 'unknown-browser';
	}
	//qtranslate classes
	if ( defined( 'QTX_VERSION' ) ) {
		$classes[] = 'qtrans-' . qtranxf_getLanguage();
	}

	return $classes;
}

add_filter( 'body_class', 'wpa_body_classes' );
/* Custom WP Title
   ========================================================================== */
function wpa_title() {
	global $post;
	if ( ! defined( 'WPSEO_VERSION' ) ) {
		if ( is_404() ) {
			echo '404 Page not found - ';
		} elseif ( ( is_single() || is_page() ) && $post->post_parent ) {
			$parent_title = get_the_title( $post->post_parent );
			echo wp_title( '-', true, 'right' ) . $parent_title . ' - ';
		} elseif ( class_exists( 'Woocommerce' ) && is_shop() ) {
			echo get_the_title( SHOP_ID ) . ' - ';
		} else {
			wp_title( '-', true, 'right' );
		}
		bloginfo( 'name' );
	} else {
		wp_title();
	}
}

/* custom theme url
   ========================================================================== */
function theme() {
	return get_stylesheet_directory_uri();
}

/* Allow SVG through WordPress Media Uploader
   ========================================================================== */
function wpa_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'wpa_mime_types' );
function wpa_fix_svg_thumb() {
	echo '<style>td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {width: 100% !important;height: auto !important}</style>';
}

add_action( 'admin_head', 'wpa_fix_svg_thumb' );
/* echo  image_src( get_field('top_background') , 'medium', true );
   ========================================================================== */
function image_src( $id, $size = 'full', $background_image = false, $height = false ) {
	if ( $image = wp_get_attachment_image_src( $id, $size, true ) ) {
		return $background_image ? 'background-image: url(' . $image[0] . ');' . ( $height ? 'height:' . $image[2] . 'px' : '' ) : $image[0];
	}
}

/* [button link="#"  align="alignleft"]Align left button[/button]
   ========================================================================== */
function sButton( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'link'  => '#',
		'align' => 'none',
	), $atts ) );

	return '<a class="btn ' . $align . '" href="' . $link . '">' . do_shortcode( $content ) . '</a>';
}

add_shortcode( 'button', 'sButton' );
/* Remove WordPress logo & pages from Admin bar
   ========================================================================== */
function annointed_admin_bar_remove() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
}

add_action( 'wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0 );
remove_action( 'welcome_panel', 'wp_welcome_panel' );
/* Adding Page URL to the Pages Admin Table
   ========================================================================== */

function my_custom_column( $defaults ) {
	$defaults['url'] = 'URL';

	return $defaults;
}

function add_my_custom_column( $column_name, $post_id ) {
	if ( $column_name == 'url' ) {
		echo get_permalink( $post_id );
	}
}

add_filter( 'manage_page_posts_columns', 'my_custom_column', 10 );
add_action( 'manage_page_posts_custom_column', 'add_my_custom_column', 10, 2 );
/* Add class to empty paragraph
   ========================================================================== */
function user_content_replace( $content ) {
	return str_replace( '<p>&nbsp;</p>', '<p class="empty_paragraph">&nbsp;</p>', $content );
}

add_filter( 'the_content', 'user_content_replace', 99 );
	
