<?php get_header(); /* Template Name: Developer template */
// $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full_size' ); $url = $thumb['0'];
global $post; ?>
	<div id="content" class="row cfx">
		<main>
			<article>
				<h1><?php the_title(); ?></h1>
				<div class="wysiwyg">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						the_content();
					endwhile; endif; ?>
				</div>
			</article>
		</main>
	</div>
<?php get_footer(); ?>
