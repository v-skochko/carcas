<?php
/* ==========================================================================
001 BODY CLASS
========================================================================== */
function new_body_classes($classes) {
	if (is_page()) {
		global $post;
		$temp = get_page_template();
		if ($temp != null) {
			$path = pathinfo($temp);
			$tmp = $path['filename'] . "." . $path['extension'];
			$tn = str_replace(".php", "", $tmp);
			$classes[] = $tn;
		}
		if (is_active_sidebar('sidebar')) {
			$classes[] = 'with_sidebar';
		}
		foreach ($classes as $k => $v) {
			if (
				// $v == 'page-template' ||
				// $v == 'page-id-'.$post->ID ||
				// $v == 'page-template-default' ||
				$v == 'woocommerce-page' ||
				($temp != null ? ($v == 'page-template-' . $tn . '-php' || $v == 'page-template-' . $tn) : '')) {
				unset($classes[$k]);
			}

		}
	}
	if (is_single()) {
		global $post;
		$f = get_post_format($post->ID);
		foreach ($classes as $k => $v) {
			if ($v == 'postid-' . $post->ID || $v == 'single-format-' . (!$f ? 'standard' : $f)) {
				unset($classes[$k]);
			}

		}
	}
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	$browser = $_SERVER['HTTP_USER_AGENT'];
	// Mac, PC ...or Linux
	if (preg_match("/Mac/", $browser)) {
		$classes[] = 'macos';
	} elseif (preg_match("/Windows/", $browser)) {
		$classes[] = 'windows';
	} elseif (preg_match("/Linux/", $browser)) {
		$classes[] = 'linux';
	} else {
		$classes[] = 'unknown-os';
	}
	// Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
	if (preg_match("/Chrome/", $browser)) {
		$classes[] = 'chrome';
		preg_match("/Chrome\/(\d.\d)/si", $browser, $matches);
		$classesh_version = 'ch' . str_replace('.', '-', $matches[1]);
		$classes[] = $classesh_version;
	} elseif (preg_match("/Safari/", $browser)) {
		$classes[] = 'safari';
		preg_match("/Version\/(\d.\d)/si", $browser, $matches);
		$sf_version = 'sf' . str_replace('.', '-', $matches[1]);
		$classes[] = $sf_version;
	} elseif (preg_match("/Opera/", $browser)) {
		$classes[] = 'opera';
		preg_match("/Opera\/(\d.\d)/si", $browser, $matches);
		$op_version = 'op' . str_replace('.', '-', $matches[1]);
		$classes[] = $op_version;
	} elseif (preg_match("/MSIE/", $browser)) {
		$classes[] = 'msie';
		if (preg_match("/MSIE 6.0/", $browser)) {
			$classes[] = 'ie6';
		} elseif (preg_match("/MSIE 7.0/", $browser)) {
			$classes[] = 'ie7';
		} elseif (preg_match("/MSIE 8.0/", $browser)) {
			$classes[] = 'ie8';
		} elseif (preg_match("/MSIE 9.0/", $browser)) {
			$classes[] = 'ie9';
		}
	} elseif (preg_match("/Firefox/", $browser) && preg_match("/Gecko/", $browser)) {
		$classes[] = 'firefox';
		preg_match("/Firefox\/(\d)/si", $browser, $matches);
		$ff_version = 'ff' . str_replace('.', '-', $matches[1]);
		$classes[] = $ff_version;
	} else {
		$classes[] = 'unknown-browser';
	}
	return $classes;
}
/* ==========================================================================
002 Custom WP Title
========================================================================== */
function custom_wp_title($title, $seperator) {
	global $paged, $page;
	if (is_feed()) {
		return $title;
	}
	$title .= ' ' . $seperator . ' ' . get_bloginfo('name');
	$description = get_bloginfo('description', 'display');
	if ($description && (is_front_page())) {
		$title = "$title $seperator $description";
	}
	if ($paged >= 2 || $page >= 2) {
		$title = "$title $seperator " . sprintf(__('Page %s'), max($paged, $page));
	}
	return trim($title, ' ' . $seperator . ' ');
}
add_filter('wp_title', 'custom_wp_title', 10, 2);

/* ==========================================================================
remove wp version param from any enqueued scripts
========================================================================== */
function vc_remove_wp_ver_css_js($src) {
	if (strpos($src, 'ver=')) {
		$src = remove_query_arg('ver', $src);
	}

	return $src;
}

/* ==========================================================================
ACF option page
========================================================================== */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false,
	));
	// acf_add_options_sub_page(array(
	// 	'page_title' => 'Theme Header Settings',
	// 	'menu_title' => 'Header',
	// 	'parent_slug' => 'theme-general-settings',
	// ));
	// acf_add_options_sub_page(array(
	// 	'page_title' => 'Theme Footer Settings',
	// 	'menu_title' => 'Footer',
	// 	'parent_slug' => 'theme-general-settings',
	// ));
}
/* ==========================================================================
Update wp-scss setings
========================================================================== */
if (class_exists('Wp_Scss_Settings')) {
	$wpscss = get_option('wpscss_options');
	if (empty($wpscss['css_dir']) && empty($wpscss['scss_dir'])) {
		update_option('wpscss_options', array('css_dir' => '/scss/', 'scss_dir' => '/scss/', 'compiling_options' => 'scss_formatter_compressed'));
	}

}
/* ==========================================================================
Remove the p from around imgs
========================================================================== */
function filter_ptags_on_images($content) {
	$content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}


/* ==========================================================================
Set permalink settings
========================================================================== */
function set_permalink_postname() {
	global $wp_rewrite;
	$wp_rewrite->set_permalink_structure('%postname%');}

/* ==========================================================================
Add link to all settings menu
========================================================================== */
function all_settings_link() {
	add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}

/* ==========================================================================
Menu walker
========================================================================== */
class carcas_walker extends Walker_Nav_Menu {

// add classes to ul sub-menus
	function start_lvl(&$output, $depth) {
		// depth dependent classes
		$indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent
		$display_depth = ($depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			($display_depth % 2 ? 'menu-odd' : 'menu-even'),
			($display_depth >= 2 ? 'sub-sub-menu' : ''),
			'menu-depth-' . $display_depth,
		);
		$class_names = implode(' ', $classes);

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

// add main/sub classes to li's and links
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent

		// depth dependent classes
		$depth_classes = array(
			($depth == 0 ? 'main-menu-item' : 'sub-menu-item'),
			($depth >= 2 ? 'sub-sub-menu-item' : ''),
			($depth % 2 ? 'menu-item-odd' : 'menu-item-even'),
			'menu-item-depth-' . $depth,
		);
		$depth_class_names = esc_attr(implode(' ', $depth_classes));

		// passed classes
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

		// build html
		$output .= $indent . '<li  class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
		$attributes .= ' class="menu-link ' . ($depth > 0 ? 'sub-menu-link' : 'main-menu-link') . '"';

		$item_output = sprintf('%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters('the_title', $item->title, $item->ID),
			$args->link_after,
			$args->after
		);
		// build html
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}


