<?php get_header(); /* Template Name: Developer template */
// $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); $url = $thumb['0'];
global $post; ?>
    <div id="content">
        <main>
            <article>
                <div class="row">
                    <h1 class="page_title"><?php the_title(); ?></h1>
                </div>
                <div class="wysiwyg">
                    <div class="row">
						<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							the_content();
						endwhile; endif;
						get_template_part( 'components/flexible', 'global' );
						?>
                    </div>
                </div>
            </article>
        </main>
    </div>
<?php get_footer(); ?>
