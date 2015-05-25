<?php header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
header('Content-Type: text/html; charset=utf-8');
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header('X-UA-Compatible: IE=Edge,chrome=1');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php wp_title();?></title>
        <meta name="MobileOptimized" content="width" />
        <meta name="HandheldFriendly" content="True"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php get_stylesheet_directory_uri();?>/img/favicon/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="<?php get_stylesheet_directory_uri();?>/img/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php get_stylesheet_directory_uri();?>/img/favicon/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="<?php get_stylesheet_directory_uri();?>/img/favicon/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php get_stylesheet_directory_uri();?>/img/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php get_stylesheet_directory_uri();?>/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-TileImage" content="/mstile-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- end favicon -->
        <?php wp_head();?>


    </head>
    <body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
        <div id="wrap">
            <header>
                <div class="row cfx">
                    <a href="<?php echo site_url();?>/" id="logo">cArcAs</a>
                    <nav class="main_nav_container cfx"  role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                        <a class="toogle_nav" href="#" onclick="$('nav ul').slideToggle('fast'); return false;">MENU</a>
                        <?php
                        $main_nav = array(
                        'theme_location' => 'head_menu',
                        'menu' => '',
                        'container' => false,
                        'menu_class' => 'main-nav',
                        'link_after' => '<i></i>',
                        'walker' => new carcas_walker,
                        );
                        wp_nav_menu($main_nav);
                        ?>
                    </nav>
                </div>
            </header>