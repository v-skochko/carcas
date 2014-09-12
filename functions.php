<?php
## Recommended plugins installer
    require_once('/logic/plugins/init.php');
## Shortcodes functions
    require_once('shortcodes.php');

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
    add_action('widgets_init', 'my_remove_recent_comments_style');
    function my_remove_recent_comments_style() {
        global $wp_widget_factory;
        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    }

    ###Remove wp version param from any enqueued scripts
    function vc_remove_wp_ver_css_js( $src ) {
        if ( strpos( $src, 'ver=' ) )
            $src = remove_query_arg( 'ver', $src );
        return $src;
    }
    add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
    add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

##THEME SETINGS
    ### Uncomit for add custom post type
    // require_once('custom-cpt.php');

    ### Registered jQuery,  css and js file
    function tt_add_scripts() {
    if (!is_admin()) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', '##ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
        wp_enqueue_script( 'jquery' );
    }
    wp_enqueue_script('lib_min', theme().'/logic/lib.js', array('jquery'), '', true );
    wp_enqueue_script('js_init', theme().'/logic/init.js', array('jquery'), '', true );
    wp_register_style('tt_style', theme().'/style/style.css');
    wp_enqueue_style('tt_style');
    }
    add_action('wp_enqueue_scripts', 'tt_add_scripts');

    ### Option Update
        ### Set permalink settings
        function set_permalink(){
              global $wp_rewrite;
              $wp_rewrite->set_permalink_structure('%postname%');
        }
        add_action('after_switch_theme', 'set_permalink');

        ### Uploads organize into month- and year-based folders
        update_option('uploads_use_yearmonth_folders', 1);

        ### Image default link type
        update_option('image_default_link_type','none');

        ### For coments remove Email & Url fields
        update_option('require_name_email', 0);
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

    ### Add browser version class to BODY
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
            if (is_active_sidebar('sidebar')) {
                $classes[] = 'with_sidebar';
            }
        }
        if(is_page() && !is_front_page() || is_single()) {$classes[] = 'static-page';}
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if($is_lynx) $classes[] = 'lynx';elseif($is_gecko) $classes[] = 'gecko';elseif($is_opera) $classes[] = 'opera';elseif($is_NS4) $classes[] = 'ns4';elseif($is_safari) $classes[] = 'safari';elseif($is_chrome) $classes[] = 'chrome';elseif($is_IE) $classes[] = 'ie';else $classes[] = 'unknown';if($is_iphone) $classes[] = 'iphone';
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
        acf_add_options_page('Options');
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
        echo 'Powered by <a href="http:##www.wordpress.org" target="_blank">WordPress</a> | Theme Developer <a href="https:##www.facebook.com/skochko" target="_blank">@skochko</a>';
    }
    add_filter('admin_footer_text', 'remove_footer_admin');

    ###Change admin post/page color by status – draft, pending, future, private
    add_action('admin_footer','posts_status_color');
    function posts_status_color(){
    ?>
    <style>
    .status-draft{background: #E6E6E6 !important;}
    .status-pending{background: #E2F0FF !important;}
    .status-publish{/* no background keep wp alternating colors */}
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