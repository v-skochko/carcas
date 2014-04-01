<?php

//require_once('shortcodes.php');

remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head' );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
//remove_action('wp_head', 'qtrans_header', 10, 0);
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
update_option('image_default_link_type','none');
add_filter( 'show_admin_bar', '__return_false' );

//register menus
register_nav_menus(array(
    'top_menu' => 'Top navigation',
    'footer_menu' => 'Footer navigation'
));

/* BEGIN: Theme config section*/
    define ('HOME_PAGE_ID', get_option('page_on_front'));
    define ('BLOG_ID', get_option('page_for_posts'));
    define ('POSTS_PER_PAGE', get_option('posts_per_page'));
/* END: Theme config section*/

//Thumbnails theme support
add_theme_support( 'post-thumbnails' );

//custom theme url
function theme(){
    echo str_replace('http://'.$_SERVER['SERVER_NAME'], '', get_stylesheet_directory_uri());
    }

//Body class
function new_body_classes( $classes ){
    if( is_page() ){
        $temp = get_page_template();
        if ( $temp != null ) {
            $path = pathinfo($temp);
            $tmp = $path['filename'] . "." . $path['extension'];
            $tn= str_replace(".php", "", $tmp);
            $classes[] = $tn;
        }
        global $post;
        $classes[] = 'page-'.get_post($post)->post_name;;
    }
    if(is_page() && !is_front_page()) {$classes[] = 'static-page';}
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if($is_lynx) $classes[] = 'lynx';
    elseif($is_gecko) $classes[] = 'gecko';
    elseif($is_opera) $classes[] = 'opera';
    elseif($is_NS4) $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE) $classes[] = 'ie';
    else $classes[] = 'unknown';
    if($is_iphone) $classes[] = 'iphone';
    return $classes;
}
add_filter( 'body_class', 'new_body_classes' );

//Custom excerpt
function gebid($post_id, $num){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = $num; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);
        if(count($words) > $excerpt_length) :
            array_pop($words);
            array_push($words, '…');
            $the_excerpt = implode(' ', $words);
        endif;
    $the_excerpt = '<p>' . $the_excerpt . '</p>';
return $the_excerpt;
}

//remove ID in menu list
add_filter('nav_menu_item_id', 'clear_nav_menu_item_id', 10, 3);
function clear_nav_menu_item_id($id, $item, $args) {
    return "";
}

//Added classes for First & Last menu item
function add_position_classes_wpse_100781($classes, $item, $args) {
  static $fl;
  if (0 == $item->menu_item_parent) {
    $fl = (empty($fl)) ? 'first' : 'middle';
    $classes[] = $fl.'-menu-item';
  }
  return $classes;
}
add_filter('nav_menu_css_class','add_position_classes_wpse_100781',1,3);

function replace_class_on_last_occurance_wpse_100781($output) {
    $output = substr_replace(
      $output,
      'last-menu-item ',
      strripos($output, 'middle-menu-item'),
      strlen('middle-menu-item')
    );
    return $output;
}
add_filter('wp_nav_menu', 'replace_class_on_last_occurance_wpse_100781');

//DEREGISTER CONTACT FORM 7 STYLES
add_action( 'wp_print_styles', 'voodoo_deregister_styles', 100 );
function voodoo_deregister_styles() {
    wp_deregister_style( 'contact-form-7' );
}

//custom SEO title
function seo_title(){
global $post;
    if($post->post_parent) {
        $parent_title = get_the_title($post->post_parent);
        echo wp_title('-', true, 'right') . $parent_title.' - ';
    } else {
        wp_title('-', true, 'right');
    } bloginfo('name');
}

//images sizes
//add_image_size( 'image_name', 'x', 'y', true );

// Disables Kses only for textarea saves
foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
    remove_filter($filter, 'wp_filter_kses');
}

// Disables Kses only for textarea admin displays
foreach (array('term_description', 'link_description', 'link_notes', 'user_description') as $filter) {
    remove_filter($filter, 'wp_kses_data');
}

//Google CDN jQuery
function add_scripts() {
    if (!is_admin()) {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
    }
}
add_action('wp_enqueue_scripts', 'add_scripts');

$bar = array(
    'name'          => 'Blog Sidebar',
    'id'            => 'blogbar',
    'description'   => 'Sidebar for news section',
    'before_widget' => '<div class="widget cfx %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<div class="widgettitle">',
    'after_title'   => '</div>'
    );
register_sidebar($bar);

function wp_http_compression() {
    if (stripos($uri, '/js/tinymce') !== false)
        return false;
    if (ini_get('output_handler') == 'ob_gzhandler')
        return false;
    if (extension_loaded('zlib'))
if(!ob_start("ob_gzhandler")) ob_start();
}
add_action('init', 'wp_http_compression');

function remove_footer_admin () {
    echo 'Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Theme by <a href="http://crystalstudio.me/" target="_blank">Crystal Web Studio</a> | Developer <a href="http://twitter.com/TuskoTrush" target="_blank">Tusko Trush</a></p>';
}

add_filter('admin_footer_text', 'remove_footer_admin');
