<?php get_header();
global $post; ?>
<section class="description"><h3>
		<?php $allsearch = new WP_Query("s=$s&showposts=-1");
		$key = esc_html($s, 1);
		$count = $allsearch->post_count;
		echo 'We found ' . $count . ' results for the search "' .$key .'"';
		wp_reset_query(); ?></h3></section>
<section class="content row cfx">
	<article>
		<?php if ( have_posts() ) : ?>
			<h1>Search results</h1>
			<ul>
				<?php  while ( have_posts() ) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<h1><?php _e("Sorry, posts not found"); ?></h1>
		<?php endif; ?>
	</article>
</section>
<?php get_footer(); ?>
