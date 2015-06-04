<?php header( 'Expires: ' . gmdate( 'D, d M Y H:i:s \G\M\T', time() + 3600 ) );
header( 'Content-Type: text/html; charset=utf-8' );
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
header( 'X-UA-Compatible: IE=Edge,chrome=1' );
//rem comments
function remove_html_comments($content = '') {
    return preg_replace('/<!--(.|\s)*?-->/', '', $content);
}
ob_start('remove_html_comments');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php wp_title(); ?></title>
        <meta name="MobileOptimized" content="width" />
        <meta name="HandheldFriendly" content="True"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo theme(); ?>/img/favicon//apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo theme(); ?>/img/favicon//apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo theme(); ?>/img/favicon//apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo theme(); ?>/img/favicon//apple-touch-icon-76x76.png">
        <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon//favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon//favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon//favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo theme(); ?>/img/favicon//manifest.json">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <!-- end favicon -->
        <?php wp_head(); ?>


    </head>
    <body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
        <div id="wrap">
            <header>
                <div class="row cfx">
                    <a href="<?php echo site_url(); ?>/" id="logo">LOGO</a>
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
                                wp_nav_menu( $main_nav );
                                ?>
                    </nav>
                </div>
            </header>