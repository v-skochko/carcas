<?php get_header();
global $post; ?>
<div id="content" class="row cfx">
    <main>
        <article>
            <h1 ><?php the_title(); ?></h1>

            <div class="wysiwyg">
                <?php if (have_posts()) : while (have_posts()) : the_post();
                    the_content();
                endwhile; endif; ?>
            </div>
            <?php comments_template(); ?>
        </article>
    </main>
</div>
<?php get_footer(); ?>
