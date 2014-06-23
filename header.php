<?php header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
header('Content-Type: text/html; charset=utf-8');
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header('X-UA-Compatible: IE=Edge,chrome=1');
function ob_html_compress($buf){
    return preg_replace(array('/<!--(?>(?!\[).)(.*)(?>(?!\]).)-->/Uis','/[[:blank:]]+/'),array('',' '),str_replace(array("\n","\r","\t"),'',$buf));
}
ob_start('ob_html_compress');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php seo_title(); ?></title>
    <!--<link rel="stylesheet" href="<?php echo theme(); ?>/css/css.php" /> compressed-->
    <link rel="stylesheet" href="<?php echo theme(); ?>/css/css.php?dev=true" /> <!--non-compressed-->
<!--[if lte IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<!--<meta name="MobileOptimized" content="width" />
<meta name="HandheldFriendly" content="True"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" /> -->
<?php wp_head(); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
</head>
<body <?php body_class(); ?>>
<main>
    <header>
        <div class="row cfx">
            <a href="<?php echo site_url(); ?>/" class="logo"></a>
            <nav class="cfx">
                <a class="tooglemenu" href="#" onclick="$('nav ul').slideToggle('fast'); return false;"></a>
                <?php wp_nav_menu(array('container' => false, 'items_wrap' => '<ul id="%1$s">%3$s</ul>', 'theme_location'  => 'head_menu')); ?>
            </nav>
        </div>
    </header>
