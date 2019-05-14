<?php
/* ==========================================================================
THEME TWEAKS
- Code to register jQuery,  css and js files
- Register multiple widgets
- Add support for post thumbnails
- Set default image sizes
- Add SVG in Media Uploader
- Redirect to homepage from login logo
- Set permalink structure to %postname% !!!!!!!!!
- Add class to empty paragraph
- Adding Page URL to the Pages in Admin Table
- Update wp-scss setings
========================================================================== */
/* Code to register jQuery,  css and js files
========================================================================== */
function carc_style_js()
{
    wp_deregister_style('contact-form-7');
    wp_deregister_style('wp-pagenavi');
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
        wp_enqueue_script('jquery');
    };
// wp_enqueue_script('googlemaps', '//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array(), '', FALSE);
    wp_enqueue_script('libs', get_template_directory_uri() . '/js/lib.js', array('jquery'), '1.0', true);
    wp_enqueue_script('init', get_template_directory_uri() . '/js/init.js', array('jquery'), '1.0', true);
    wp_enqueue_style('main', get_template_directory_uri() . '/scss/compiled/main.css');
    wp_enqueue_style('plugins', get_template_directory_uri() . '/scss//compiled/lib.css');
//wp_enqueue_style('style', get_template_directory_uri() . '/scss/main.css?uid='.md5(uniqid(rand(),1)));
}

add_action('wp_enqueue_scripts', 'carc_style_js');

/* Register multiple widgets
   ========================================================================== */
$reg_sidebars = array(
    'page_sidebar' => 'Page Sidebar',
    'blog_sidebar' => 'Blog Sidebar',
    'footer_sidebar' => 'Footer Area',
);
foreach ($reg_sidebars as $id => $name) {
    register_sidebar(
        array(
            'name' => __($name),
            'id' => $id,
            'before_widget' => '<div class="widget cfx %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<mark class="widget-title">',
            'after_title' => '</mark>',
        )
    );
}

/* Add support for post thumbnails
   ========================================================================== */

add_theme_support('post-thumbnails');

/* Set default image sizes
   ========================================================================== */
function set_default_image_sizes()
{
    update_option('thumbnail_size_w', 400);
    update_option('thumbnail_size_h', 400);
    update_option('medium_size_w', 800);
    update_option('medium_size_h', 800);
    update_option('large_size_w', 2048);
    update_option('large_size_h', 2048);
}

add_action('after_switch_theme', 'set_default_image_sizes');


/* Add SVG in Media Uploader
   ========================================================================== */
function wpa_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

add_filter('upload_mimes', 'wpa_mime_types');
function wpa_fix_svg_thumb()
{
    echo '<style>td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {width: 100% !important;height: auto !important}</style>';
}

add_action('admin_head', 'wpa_fix_svg_thumb');

/* Redirect to homepage from login logo
   ========================================================================== */
add_filter('login_headerurl', 'custom_loginlogo_url');
function custom_loginlogo_url()
{
    return site_url();
}

/* Set permalink structure to %postname%
   ========================================================================== */
function carc_permalink_structure()
{
    //Set permalink settings
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('%postname%');
}

add_action('after_switch_theme', 'carc_permalink_structure');
/* Add class to empty paragraph
   ========================================================================== */
function carc_empty_p($content)
{
    return str_replace('<p>&nbsp;</p>', '<p class="empty_paragraph">&nbsp;</p>', $content);
}

add_filter('the_content', 'carc_empty_p', 99);
/* Adding Page URL to the Pages in Admin Table
   ========================================================================== */
function carc_url_column($defaults)
{
    $defaults['url'] = 'URL';

    return $defaults;
}

function carc_add_url_column($column_name, $post_id)
{
    if ($column_name == 'url') {
        echo get_permalink($post_id);
    }
}

add_filter('manage_page_posts_columns', 'carc_url_column', 10);
add_action('manage_page_posts_custom_column', 'carc_add_url_column', 10, 2);

/* Update wp-scss setings
   ========================================================================== */
if (class_exists('Wp_Scss_Settings')) {
    $wpscss = get_option('wpscss_options');
    if (empty($wpscss['css_dir']) && empty($wpscss['scss_dir'])) {
        update_option('wpscss_options', array(
            'css_dir' => '/scss/compiled/',
            'scss_dir' => '/scss/',
//			'compiling_options' => 'Leafo\ScssPhp\Formatter\Expanded'
        ));
    }
}
/* ==========================================================================
Remove Unnecessary parts from Wordpress core
- Unnecessary Code from wp_head
- Remove wp version param from any enqueued scripts
- Dashboard wigets
- Default wigets
- WordPress logo & pages from Admin bar
- <p> and <br /> from Contact Form 7
========================================================================== */
/* Remove Unnecessary Code from wp_head
   ========================================================================== */
remove_action('wp_head', 'rsd_link'); // Really Simple Discovery
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head', 'wp_generator'); // WordPress Generator
remove_action('wp_head', 'rel_canonical'); // canonical tag meta
// Post Relational Links
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
// Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
function remove_json_api()
{
    // Remove the REST API lines from the HTML Header
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');
    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false');
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
    // Remove all embeds rewrite rules.
    // remove HTML meta tag
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    // remove HTTP header
    remove_action('template_redirect', 'wp_shortlink_header', 11);
}

add_action('after_setup_theme', 'remove_json_api');
/* Remove wp version param from any enqueued scripts
   ========================================================================== */
function vc_remove_wp_ver_css_js($src)
{
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}

add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);
/* Remove dashboard wigets
   ========================================================================== */
function remove_dash_widgets()
{
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
}

add_action('admin_init', 'remove_dash_widgets');
/* Remove default wigets
   ========================================================================== */
function remove_default_widgets()
{
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Calendar');
    // unregister_widget( 'WP_Widget_Categories' );
    unregister_widget('WP_Nav_Menu_Widget');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Tag_Cloud');
    // unregister_widget( 'WP_Widget_Text' );
}

add_action('widgets_init', 'remove_default_widgets');
/* Remove WordPress logo & pages from Admin bar
   ========================================================================== */
function annointed_admin_bar_remove()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
remove_action('welcome_panel', 'wp_welcome_panel');
/*   Remove <p> and <br /> from Contact Form 7
   ========================================================================== */
if (defined('WPCF7_VERSION')) {
    function maybe_reset_autop($form)
    {
        $form_instance = WPCF7_ContactForm::get_current();
        $manager = WPCF7_FormTagsManager::get_instance();
        $form_meta = get_post_meta($form_instance->id(), '_form', true);
        $form = $manager->replace_all($form_meta);
        $form_instance->set_properties(array(
            'form' => $form
        ));

        return $form;
    }

    add_filter('wpcf7_form_elements', 'maybe_reset_autop');
}
/* ==========================================================================
CUSTOM STYLE IN ADMIN PANEL
- Custom logo on login page
- Change admin post/page color by status
- Color scheme "Midnight" set as default
========================================================================== */
/* Custom logo on login page
   ========================================================================== */
add_action('login_head', 'namespace_login_style');
function namespace_login_style()
{
    echo '<style>.login h1 a { background-image: url( ' . get_template_directory_uri() . '/img/favicon/android-chrome-48x48.png ) !important;height: 84px!important; background-size: auto!important;background-position: center!important; }</style>';
}


/* Change admin post/page color by status – draft, pending, future, private
   ========================================================================== */
function c_css()
{ ?>
    <style>
        .status-draft{
            background:#E6E6E6 !important;
        }
        .status-pending{
            background:#E2F0FF !important;
        }
        .status-future{
            background:#C6EBF5 !important;
        }
        .status-private{
            background:#F2D46F;
        }
        #toplevel_page_edit-post_type-acf-field-group{
            border-top:1px solid #ccc !important;
        }
        .acf-repeater > .acf-table > .ui-sortable > .acf-row:nth-child(even) > .order{
            color:#fff !important;
            background-color:#777 !important;
        }
    </style>
    <?php
}

add_action('admin_footer', 'c_css');
/* Color scheme "Midnight" set as default
   ========================================================================== */
function midnight_theme($color_scheme)
{
    global $_wp_admin_css_colors;
    if ('classic' == $color_scheme || 'fresh' == $color_scheme) {
        $color_scheme = 'midnight';
    }

    return $color_scheme;
}

add_filter('get_user_option_admin_color', 'midnight_theme', 5);
/* ==========================================================================
CUSTOM FUNCTIONS
- Body class
- WP Title
- Short theme url
- Get Image Size by ID
- Button Shortcode
========================================================================== */
/* Body class
   ========================================================================== */
function wpa_body_classes($classes)
{
    if (is_page()) {
        global $post;
        $temp = get_page_template();
        if ($temp != null) {
            $path = pathinfo($temp);
            $tmp = $path['filename'] . "." . $path['extension'];
            $tn = str_replace(".php", "", $tmp);
            $classes[] = $tn;
        }
        foreach ($classes as $k => $v) {
            if (
                $v == 'page-template' ||
                $v == 'page-id-' . $post->ID ||
                $v == 'page-template-default' ||
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
    if (is_multi_author()) {
        $classes[] = 'group-blog';
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
    if (preg_match("/Edge/", $browser)) {
        $classes[] = 'edge';
    } elseif (preg_match("/Chrome/", $browser)) {
        $classes[] = 'chrome';
        preg_match("/Chrome\/(\d.\d)/si", $browser, $matches);
        @$classesh_version = 'ch' . str_replace('.', '-', $matches[1]);
        $classes[] = $classesh_version;
    } elseif (preg_match("/Safari/", $browser)) {
        $classes[] = 'safari';
        @preg_match("/Version\/(\d.\d)/si", $browser, $matches);
        @$sf_version = 'sf' . str_replace('.', '-', $matches[1]);
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
    //qtranslate classes
    if (defined('QTX_VERSION')) {
        $classes[] = 'qtrans-' . qtranxf_getLanguage();
    }

    return $classes;
}

add_filter('body_class', 'wpa_body_classes');
/*  WP Title
   ========================================================================== */
function wpa_title()
{
    global $post;
    if (!defined('WPSEO_VERSION')) {
        if (is_404()) {
            echo '404 Page not found - ';
        } elseif ((is_single() || is_page()) && $post->post_parent) {
            $parent_title = get_the_title($post->post_parent);
            echo wp_title('-', true, 'right') . $parent_title . ' - ';
        } elseif (class_exists('Woocommerce') && is_shop()) {
            echo get_the_title(SHOP_ID) . ' - ';
        } else {
            wp_title('-', true, 'right');
        }
        bloginfo('name');
    } else {
        wp_title();
    }
}

/* Short theme url
   ========================================================================== */
function theme()
{
    return get_stylesheet_directory_uri();
}

/* Get Image Size by ID -  echo  image_src( get_field('top_background') , 'medium', true );
   ========================================================================== */
function image_src($id, $size = 'full', $background_image = false, $height = false)
{
    if ($image = wp_get_attachment_image_src($id, $size, true)) {
        return $background_image ? 'background-image: url(\'' . $image[0] . '\');' . ($height ? 'height:' . $image[2] . 'px' : '') : $image[0];
    }
}

/* Button Shortcode  [button link="#"  class="alignleft"]Align left button[/button]
   ========================================================================== */
function sButton($atts, $content = null)
{
    extract(shortcode_atts(array(
        'link' => '#',
        'class' => 'none',
    ), $atts));

    return '<a class="btn ' . $class . '" href="' . $link . '">' . do_shortcode($content) . '</a>';
}

add_shortcode('button', 'sButton');

/* post thumbnail
   ========================================================================== */
function post_img($size)
{
    if (has_post_thumbnail()) {
        the_post_thumbnail_url($size);
    } else {
        echo get_stylesheet_directory_uri() . '/img/holder.png';
    }
}
/*ajax_url
   ========================================================================== */
add_action('wp_head', 'ajax_url');
function ajax_url() {
    echo '<script type="text/javascript">var ajax_url="' . admin_url('admin-ajax.php') . '";</script>';
}
