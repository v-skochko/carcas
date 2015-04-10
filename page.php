<?php get_header();
global $post; ?>
    <section class="content row cfx">
        <article>
        <div class="wysiwyg">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                the_title( '<h1>', '</h1>' );
                the_content();
            endwhile; endif; ?>

        </div>
        </article>
    </section>
<?php get_footer(); ?>
