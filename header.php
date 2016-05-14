<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php /*
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon/android-chrome-192x192.png"sizes="192x192">
    <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo theme(); ?>/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#000000">
    <!-- end favicon -->
    */?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div id="wrap">
    <header>
        <div class="row  flex ai_center">
            <a href="<?php echo site_url(); ?>/" id="logo">LOGO</a>
            <nav class="main_nav cfx">
                <?php
                $main_nav = array(
                    'theme_location' => 'main_menu',
                    'menu' => '',
                    'container' => false,
                    'menu_class' => 'level_a'
                );
                wp_nav_menu($main_nav);
                ?>
            </nav>
        </div>
    </header>
