<?php
## Recommended plugins installer
    require_once('include/plugins/init.php');
## Shortcodes functions
    require_once('include/shortcodes.php');
## Corefunctions
    require_once('include/core.php');
## Uncomit for add custom post type
    // require_once('include/custom-cpt.php');
## Register custom image size
    // add_image_size( 'custom', '300', '300', true );
    update_option('thumbnail_size_w', 200);
    update_option('thumbnail_size_h', 200);
    // Thumbnails theme support
    // add_theme_support( 'post-thumbnails' );
    // update_option('medium_size_w', 400);
    // update_option('medium_size_h', 350);
    // update_option('large_size_w', 800);
    // update_option('large_size_h', 400);

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
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );


// remove wp version param from any enqueued scripts
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

##THEME SETINGS
    ### Registered jQuery,  css and js file
    function style_js() {
        wp_deregister_style( 'contact-form-7' );
        if (!is_admin()) {
            wp_deregister_script( 'jquery' );
            wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
            wp_enqueue_script( 'jquery' );
        }
        // wp_enqueue_script('googlemaps', '//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false', array(), '', FALSE);
        wp_enqueue_script('libs', get_template_directory_uri().'/js/lib.js', array('jquery'), '1.0', true);
        wp_enqueue_script('init', get_template_directory_uri().'/js/init.js', array('jquery'), '1.0', true);
        wp_enqueue_style('style', get_template_directory_uri() . '/scss/base.css');
    }
    add_action('wp_enqueue_scripts', 'style_js');
    ### Option Update
        ### Set permalink settings
        add_action('after_switch_theme', 'set_permalink_postname');




        ### For coments: remove Email & Url fields
         function require_name(){
              update_option('require_name_email', 0); }
        add_action('after_switch_theme', 'require_name');
        function rem_form_fields($fields) {
            // unset($fields['email']);
            unset($fields['url']);
            return $fields; }
        add_filter('comment_form_default_fields', 'rem_form_fields');


    ### Add class to BODY
    add_filter( 'body_class', 'new_body_classes' );

/*WP Title */
add_filter( 'wp_title', 'custom_wp_title', 10, 2 );

    ###Register menus
    register_nav_menus(array(
        'head_menu' => 'Main navigation',
        'foot_menu' => 'Footer navigation'
    ));

    ##custom theme url
    function theme(){
    return ($_SERVER['REMOTE_ADDR']=='127.0.0.1'?site_url():'') . str_replace(site_url(), '', get_stylesheet_directory_uri());
    }

    ### Deregister Contact Form 7 default styles
    add_action( 'wp_print_styles', 'voodoo_deregister_styles', 100 );
    function voodoo_deregister_styles() {
        wp_deregister_style( 'contact-form-7' );
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

    // function remove_footer_admin () {
    //     echo 'Powered by <a href="http://www.wordpress.org" target="_blank">WordPress </a>  | Theme Developer <a href="https://www.facebook.com/skochko" target="_blank">@skochko</a>';
    // }
    // add_filter('admin_footer_text', 'remove_footer_admin');


    ###Change admin post/page color by status – draft, pending, future, private
    add_action('admin_footer','posts_status_color');
    function posts_status_color(){
    ?>
    <style>
    .status-draft{background: #E6E6E6 !important;}
    .status-pending{background: #E2F0FF !important;}
    .status-future{background: #C6EBF5 !important;}
    .status-private{background:#F2D46F;
    }
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
        add_action('admin_menu', 'all_settings_link');

/* ==========================================================================
   Remove the p from around imgs
   ========================================================================== */

add_filter('the_content', 'filter_ptags_on_images');