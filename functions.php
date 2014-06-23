<?php

//Auto-install recommended plugins
require_once('installer/installer.php');

//shortcodes functions
require_once('shortcodes.php');

//uncomment if need CPT
//require_once('custom-cpt.php');

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
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
update_option('image_default_link_type','none');


// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

// changing the logo link from wordpress.org to your site
function tt_login_url() {  return home_url(); }
// changing the alt text on the logo to show your site name
function tt_login_title() { return get_option( 'blogname' ); }

add_filter( 'login_headerurl', 'tt_login_url' );
add_filter( 'login_headertitle', 'tt_login_title' );

//register menus
register_nav_menus(array(
    'head_menu' => 'Main navigation',
    'foot_menu' => 'Footer navigation'
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
    return ($_SERVER['REMOTE_ADDR']=='127.0.0.1'?site_url():'') . str_replace(site_url(), '', get_stylesheet_directory_uri());
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
        $classes[] = 'page-'.get_post($post)->post_name;
    }
    if(is_page() && !is_front_page() || is_single()) {$classes[] = 'static-page';}
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if($is_lynx) $classes[] = 'lynx';elseif($is_gecko) $classes[] = 'gecko';elseif($is_opera) $classes[] = 'opera';elseif($is_NS4) $classes[] = 'ns4';elseif($is_safari) $classes[] = 'safari';elseif($is_chrome) $classes[] = 'chrome';elseif($is_IE) $classes[] = 'ie';else $classes[] = 'unknown';if($is_iphone) $classes[] = 'iphone';
    return $classes;
}
add_filter( 'body_class', 'new_body_classes' );

//excerpt custom
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

//Deregister Contact Form 7 styles
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
    } elseif(@is_shop()) {
        echo get_the_title(SHOP_ID) . ' - ';
    } else {
        wp_title('-', true, 'right');
    }
    bloginfo('name');
}

//images sizes
//add_image_size( 'example_name', '960', '540', true );

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
    echo 'Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Theme Developer <a href="http://Skochko.org.ua" target="_blank">@Skochko</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

if(QTRANS_INIT):
    //qTranslate Taxonomies Description Fix
    function qtranslate_edit_taxonomies(){
       $args=array(
          'public' => true ,
          '_builtin' => false
       );
       $output = 'object';
       $operator = 'and'; // 'and' or 'or'
       $taxonomies = get_taxonomies($args,$output,$operator);
       if  ($taxonomies) {
         foreach ($taxonomies  as $taxonomy ) {
             add_action( $taxonomy->name.'_add_form', 'qtrans_modifyTermFormFor');
             add_action( $taxonomy->name.'_edit_form', 'qtrans_modifyTermFormFor');
         }
       }
    }
    add_action('admin_init', 'qtranslate_edit_taxonomies');

    remove_action('wp_head', 'qtrans_header', 10, 0);
endif;

function remove_default_description($bloginfo) {
  $default_tagline = 'Just another WordPress site';
  return ($bloginfo === $default_tagline) ? '' : $bloginfo;
}
add_filter('get_bloginfo_rss', 'remove_default_description');

//Wordpress ?s= redirect to /search/
function tt_search_redirect() {
    global $wp_rewrite;
    if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) { return; }
    $search_base = $wp_rewrite->search_base;
    if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
        wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
    exit();
    }
}
add_action('template_redirect', 'tt_search_redirect');

//Fix for empty search queries redirecting to home page
function tt_request_filter($query_vars) {
    if (isset($_GET['s']) && empty($_GET['s']) && !is_admin()) {
        $query_vars['s'] = ' ';
    }
    return $query_vars;
}
add_filter('request', 'tt_request_filter');

function tt_dashboard_widgets() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}
add_action('admin_init', 'tt_dashboard_widgets');

function transliterate($textcyr = null, $textlat = null) {
    $cyr = array(
    'ы', ' ', 'є', 'ї', 'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'і', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
    'Ы','Є', 'Ї', 'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'І', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');
    $lat = array(
    'y', '_', 'ye', 'yi', 'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'ya',
    'Y','Ye', 'Yi', 'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Ya');
    if($textcyr) return str_replace($cyr, $lat, $textcyr);
    else if($textlat) return str_replace($lat, $cyr, $textlat);
    else return null;
}

update_option('uploads_use_yearmonth_folders', 0);
