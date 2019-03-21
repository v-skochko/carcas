<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wpa_title(); ?></title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui, minimum-scale=1.0, maximum-scale=1.0"/>
    <?php /* favicon */ ?>
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo theme(); ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo theme(); ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo theme(); ?>/img/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#000">
    <?php /* end favicon */ ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="page_id_<?php the_ID() ?>">
<div id="wrap">
    <header class="header">
        <div class="row flex v_center ">
            <a href="<?php echo site_url(); ?>/" id="logo">
                <?php if (get_field('logo', 'options')): ?>
                    <img src="<?php the_field('logo', 'options'); ?>" alt="logo">
                <?php endif; ?>
            </a>
            <nav class="header__main-nav  mobile_hide">
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
