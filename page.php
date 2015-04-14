<?php get_header();
global $post; ?>
    <section class="content row cfx">
        <article>
        <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
            <p class="vcard">
                <?php printf( __( 'Posted', 'bonestheme').' <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> '.__( 'by',  'bonestheme').' <span class="author">%3$s</span>', get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
            </p>
        <div class="wysiwyg">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                the_content();
            endwhile; endif; ?>

        </div>
        </article>
    </section>
<?php get_footer(); ?>
