<?php
## Recommended plugins installer
    require_once('logic/plugins/init.php');
## Shortcodes functions
    require_once('shortcodes.php');
## Uncomit for add custom post type
    // require_once('custom-cpt.php');
## Register custom image size
    add_image_size( 'blog', '204', '204', true );

## SPEED & SECURITY BOOST
    ### Clean up wp_head()
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head' );
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head' );
    remove_action('wp_head', 'wp_generator'); //Remove WP Generator Meta Tag
    remove_action('wp_head', 'rel_canonical');
    ###Remove wp version param from any enqueued scripts
    function vc_remove_wp_ver_css_js( $src ) {
        if ( strpos( $src, 'ver=' ) )
            $src = remove_query_arg( 'ver', $src );
        return $src;
    }
    add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
    add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
##THEME SETINGS

    ### Registered jQuery,  css and js file
    function style_js() {
        wp_deregister_style( 'contact-form-7' );
        if (!is_admin()) {
            wp_deregister_script( 'jquery' );
            wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
            wp_enqueue_script( 'jquery' );
        }
        // wp_enqueue_script('googlemaps', '//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array(), '', FALSE);
        wp_enqueue_script('libs', get_template_directory_uri().'/logic/lib.js', array('jquery'), '1.0', true);
        wp_enqueue_script('init', get_template_directory_uri().'/logic/init.js', array('jquery'), '1.0', true);
        wp_enqueue_style('reset', get_template_directory_uri() . '/style/lib/_reset.scss');
        wp_enqueue_style('lib', get_template_directory_uri() . '/style/lib/_lib.scss');
        wp_enqueue_style('style', get_template_directory_uri() . '/style/style.scss');
    }
    add_action('wp_enqueue_scripts', 'style_js');
    ### Option Update
        ### Set permalink settings
        function set_permalink(){
              global $wp_rewrite;
              $wp_rewrite->set_permalink_structure('%postname%'); }
        add_action('after_switch_theme', 'set_permalink');
        ### Uploads organize into month- and year-based folders
        function uploads_folder_update(){
              update_option('uploads_use_yearmonth_folders', 1); }
        add_action('after_switch_theme', 'uploads_folder_update');
        ### Image default link type
        function image_link_t(){
               update_option('image_default_link_type','none'); }
        add_action('after_switch_theme', 'image_link_t');
        ### For coments: remove Email & Url fields
         function require_name(){
              update_option('require_name_email', 0); }
        add_action('after_switch_theme', 'require_name');
        function rem_form_fields($fields) {
            unset($fields['email']);
            unset($fields['url']);
            return $fields; }
        add_filter('comment_form_default_fields', 'rem_form_fields');
    ### Add wiget area
    $bar = array(
        'name'          => 'Sidebar',
        'id'            => 'sbar',
        'description'   => 'Sidebar section',
        'before_widget' => '<div class="widget cfx %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widgettitle">',
        'after_title'   => '</div>'
    );
    register_sidebar($bar);
    ### Remove ID in menu list
    add_filter('nav_menu_item_id', 'clear_nav_menu_item_id', 10, 3);
    function clear_nav_menu_item_id($id, $item, $args) {
        return "";
    }
    ### Classes for First & Last menu items
    function wpb_first_and_last_menu_class($items) {
    $items[1]->classes[] = 'first';
    $items[count($items)]->classes[] = 'last';
    return $items;
    }
    add_filter('wp_nav_menu_objects', 'wpb_first_and_last_menu_class');
    ### Add ie conditional html5 shim to header (only for old IE)
    function wp_IEhtml5_js () {
        global $is_IE;
        if ($is_IE)
            echo '<!--[if lt IE 9]><script src="##html5shim.googlecode.com/svn/trunk/html5.js"></script><script src="##css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->';
    }
    add_action('wp_head', 'wp_IEhtml5_js');
    ### Add class to BODY
    function new_body_classes( $classes ){
    if( is_page() ){
        global $post;
        $temp = get_page_template();
        if ( $temp != null ) {
            $path = pathinfo($temp);
            $tmp = $path['filename'] . "." . $path['extension'];
            $tn= str_replace(".php", "", $tmp);
            $classes[] = $tn;
        }
        if (is_active_sidebar('sidebar')) {
            $classes[] = 'with_sidebar';
        }
        foreach($classes as $k => $v) {
            if(
                $v == 'page-template' ||
                $v == 'page-id-'.$post->ID ||
                $v == 'page-template-default' ||
                $v == 'woocommerce-page' ||
                ($temp != null?($v == 'page-template-'.$tn.'-php' || $v == 'page-template-'.$tn):'')) unset($classes[$k]);
        }
    }
    if( is_single() ){
        global $post;
        $f = get_post_format( $post->ID );
        foreach($classes as $k => $v) {
            if($v == 'postid-'.$post->ID || $v == 'single-format-'.(!$f?'standard':$f)) unset($classes[$k]);
        }
    }
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
    // Mac, PC ...or Linux
    if ( preg_match( "/Mac/", $browser ) ){
        $classes[] = 'macos';
    } elseif ( preg_match( "/Windows/", $browser ) ){
        $classes[] = 'windows';
    } elseif ( preg_match( "/Linux/", $browser ) ) {
        $classes[] = 'linux';
    } else {
        $classes[] = 'unknown-os';
    }
    // Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
    if ( preg_match( "/Chrome/", $browser ) ) {
        $classes[] = 'chrome';
        preg_match( "/Chrome\/(\d.\d)/si", $browser, $matches);
        $classesh_version = 'ch' . str_replace( '.', '-', $matches[1] );
        $classes[] = $classesh_version;
    } elseif ( preg_match( "/Safari/", $browser ) ) {
        $classes[] = 'safari';
        preg_match( "/Version\/(\d.\d)/si", $browser, $matches);
        $sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
        $classes[] = $sf_version;
    } elseif ( preg_match( "/Opera/", $browser ) ) {
        $classes[] = 'opera';
        preg_match( "/Opera\/(\d.\d)/si", $browser, $matches);
        $op_version = 'op' . str_replace( '.', '-', $matches[1] );
        $classes[] = $op_version;
    } elseif ( preg_match( "/MSIE/", $browser ) ) {
        $classes[] = 'msie';
        if( preg_match( "/MSIE 6.0/", $browser ) ) {
            $classes[] = 'ie6';
        } elseif ( preg_match( "/MSIE 7.0/", $browser ) ){
            $classes[] = 'ie7';
        } elseif ( preg_match( "/MSIE 8.0/", $browser ) ){
            $classes[] = 'ie8';
        } elseif ( preg_match( "/MSIE 9.0/", $browser ) ){
            $classes[] = 'ie9';
        }
    } elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
        $classes[] = 'firefox';
        preg_match( "/Firefox\/(\d)/si", $browser, $matches);
        $ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
        $classes[] = $ff_version;
    } else {
        $classes[] = 'unknown-browser';
    }
    return $classes;
}
add_filter( 'body_class', 'new_body_classes' );
    ###Custom SEO title
    function seo_title(){
         global $post;
         if($post->post_parent) {
             $parent_title = get_the_title($post->post_parent);
             echo wp_title('-', true, 'right') . $parent_title.' - ';
         } elseif(class_exists('Woocommerce') && is_shop()) {
             echo get_the_title(SHOP_ID) . ' - ';
         } else {
             wp_title('-', true, 'right');
         }
         bloginfo('name');}
    ###Register menus
    register_nav_menus(array(
        'head_menu' => 'Main navigation',
        'foot_menu' => 'Footer navigation'
    ));
    ###Thumbnails theme support
    add_theme_support( 'post-thumbnails' );
    ##custom theme url
    function theme(){
    return ($_SERVER['REMOTE_ADDR']=='127.0.0.1'?site_url():'') . str_replace(site_url(), '', get_stylesheet_directory_uri());
    }
    ###Disables Kses
    foreach (array('term_description', 'link_description', 'link_notes', 'user_description') as $filter) {
        remove_filter($filter, 'wp_kses_data');
    }
      foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
        remove_filter($filter, 'wp_filter_kses');
    }
    ### Deregister Contact Form 7 default styles
    add_action( 'wp_print_styles', 'voodoo_deregister_styles', 100 );
    function voodoo_deregister_styles() {
        wp_deregister_style( 'contact-form-7' );
    }
    ### Activate ACF option page
   if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
}
## WORDPRESS ADMIN PANEL SETINGS
    ### Remove dashboard wigets
    function rem_dash_widgets() {
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
        remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
        remove_meta_box('dashboard_primary', 'dashboard', 'normal');
        remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); }
    add_action('admin_init', 'rem_dash_widgets');
    ### Add custom logo to login page
    add_action( 'login_head', 'namespace_login_style' );
    function namespace_login_style() {
    echo '<style>.login h1 a { background-image: url( ' . get_template_directory_uri() . '/img/login-logo.png ) !important;height: 135px!important; }</style>'; }
    ### Changing the logo link from wordpress.org to your site
    function tt_login_url() {  return home_url(); }
    ### Changing the alt text on the logo to show your site name
    function tt_login_title() { return get_option( 'blogname' ); }
    add_filter( 'login_headerurl', 'tt_login_url' );
    add_filter( 'login_headertitle', 'tt_login_title' );
    ### Add custom info to admin footer area
    function remove_footer_admin () {
        echo 'Powered by <a href="http://www.wordpress.org" target="_blank">WordPress </a>  | Theme Developer <a href="https://www.facebook.com/skochko" target="_blank">@skochko</a>';
    }
    add_filter('admin_footer_text', 'remove_footer_admin');
    ###Change admin post/page color by status – draft, pending, future, private
    add_action('admin_footer','posts_status_color');
    function posts_status_color(){
    ?>
    <style>
    .status-draft{background: #E6E6E6 !important;}
    .status-pending{background: #E2F0FF !important;}
    .status-future{background: #C6EBF5 !important;}
    .status-private{background:#F2D46F;}
    </style>
    <?php
    }
    ### FOR ADMIN ONLY:
        #### Color scheme "Midnight" set as default
        add_filter( 'get_user_option_admin_color', function( $color_scheme ) {
             global $_wp_admin_css_colors;
             if ( 'classic' == $color_scheme || 'fresh' == $color_scheme ) {
                $color_scheme = 'midnight';
            }
             return $color_scheme;
        }, 5 );
        #### Hide the Admin Bar
        add_filter('show_admin_bar', '__return_false');
        #### Add link to all settings menu
        function all_settings_link() {
         add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
        }
        add_action('admin_menu', 'all_settings_link');
    ### FOR USERS EXCEPT SYSADMIN:
        #### Remove the wordpress update notification for all users except sysadmin
        global $user_login;
        get_currentuserinfo();
        if (!current_user_can('update_plugins')) { ## checks to see if current user can update plugins
         add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
         add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) ); }
    function adm_separator() {
        echo '<style type="text/css">#adminmenu li.wp-menu-separator {margin: 0; height: 2px; background: #26292C;}</style>';
    }
    add_action( 'admin_head', 'adm_separator' );
