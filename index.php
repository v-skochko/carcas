<?php get_header();
$catID = get_queried_object()->term_id;
$catN = get_queried_object()->name;

if(is_date()){
    $queryname = '<h3>Archive of ' . date("F") .', '. date('Y').'</h3>';
} elseif(is_category()) {
    $queryname = single_cat_title();
} ?>
<?php if($queryname) : echo $queryname; endif; ?>
<section class="content row cfx">
	<article>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="blogpost cfx">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="alignleft">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
					</div>
				<?php } ?>
				<div class="excerpt">
					<a href="<?php the_permalink(); ?>" class="blogtitle"><?php the_title(); ?></a>
					<div class="blogmeta cfx">
						<div class="author"><?php the_author(); ?></div>
						<div class="ccount"><?php comments_number( 'No comments', 'One comment', '% comments' ); ?></div>
						<time><?php the_date( 'F j'); ?><span>, <?php echo get_the_date('Y'); ?></span></time>
					</div>
					<?php the_content('Read More'); ?>
				</div>
			</div>
		<?php endwhile;
		wp_pagenavi();
		endif;?>
	</article>
	<aside class="alignright">
		<?php dynamic_sidebar('Blog Sidebar'); ?>
	</aside>
</section>
<?php get_footer(); ?>

