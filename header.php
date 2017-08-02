<!doctype html>
<html <?php language_attributes(); ?> <?php if ( is_user_logged_in() ) {
	echo 'style="margin-top: 0!important; margin-bottom: 32px!important;"';
} ?>
>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wpa_title(); ?></title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui, minimum-scale=1.0, maximum-scale=1.0"/>
	<?php /* favicon */ ?>
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo theme(); ?>/img/favicon/manifest.json">
    <link rel="mask-icon" href="<?php echo theme(); ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#181818">
	<?php /* end favicon */ ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div id="wrap">
    <header>
        <div class="row  flex  align_center">
            <a href="<?php echo site_url(); ?>/" id="logo">
				<?php if ( get_field( 'logo', 'options' ) ): ?>
                    <img src="<?php the_field( 'logo', 'options' ); ?>" alt="">
				<?php endif; ?>
            </a>
            <nav class="main_nav cfx mobile_hide">
				<?php
				$main_nav = array(
					'theme_location' => 'main_menu',
					'menu'           => '',
					'container'      => false,
					'menu_class'     => 'level_a'
				);
				wp_nav_menu( $main_nav );
				?>
            </nav>
        </div>
    </header>
