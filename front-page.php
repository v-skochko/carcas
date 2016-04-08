<?php get_header();
global $post; ?>
    <div id="content" class="row cfx">
        <main>
            <article>
                <h1 class="page-title"><?php the_title(); ?></h1>
                <div class="wysiwyg">
                    <?php if (have_posts()): while (have_posts()): the_post();
                        the_content();
                    endwhile;endif; ?>
                </div>
            </article>
        </main>
    </div>
<?php get_footer(); ?>