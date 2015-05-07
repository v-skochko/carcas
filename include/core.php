<?php
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
                // $v == 'page-template' ||
                // $v == 'page-id-'.$post->ID ||
                // $v == 'page-template-default' ||
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

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

/* TG WP Title */
function tg_wp_title( $title, $seperator ) {
    global $paged, $page;
    if ( is_feed() ) {
        return $title;
    }
    $title .= ' ' .$seperator. ' ' .get_bloginfo( 'name' );
    $description = get_bloginfo( 'description', 'display' );
    if ( $description && ( is_front_page() ) )  {
        $title = "$title $seperator $description";
    }
    if ( $paged >= 2 || $page >= 2 ) {
        $title = "$title $seperator " . sprintf( __( 'Page %s' ), max( $paged, $page ) );
    }
    return trim( $title, ' ' .$seperator. ' ' );
}
add_filter( 'wp_title', 'tg_wp_title', 10, 2 );

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