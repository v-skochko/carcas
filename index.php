<?php get_header();
$s = 0;
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
if (is_home()) {
    $queryname = get_the_title(BLOG_ID);
} else {
    $queryname = 'Archive of ' . get_the_archive_title();
} ?>

    <div id="content" class="row cfx index_style">

        <?php if (is_search()) { ?>
            <h1 class="page-title"><?php printf(esc_html__('Search Results for: %s'), '<span>' . get_search_query() . '</span>'); ?></h1>
        <?php } else {

            echo '<h1 class="page-title">' . $queryname . '</h1>';
        } ?>
    <section class="content cfx">
        <article>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="blogpost cfx">
                         <?php if (has_post_thumbnail()) { ?>
                <div class="alignleft">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                </div>
                    <?php } else { ?>
                  <div class="alignleft">
                      <a href="<?php the_permalink(); ?>"><img src="<?php echo theme(); ?>/img/holder.png" alt=""></a>
                  </div>
                    <?php } ?>
                    <div class="excerpt">
                        <a href="<?php the_permalink(); ?>" class="blogtitle"><?php the_title(); ?></a>
                        <div class="blogmeta cfx">
                            <div class="author">
                                <?php echo $current_user->user_firstname; ?>
                                <?php echo $current_user->user_lastname ?>
                                <?php the_author(); ?></div>
                            <div
                                class="ccount"><?php comments_number('No comments', 'One comment', '% comments'); ?></div>
                            <time><?php echo get_the_date('j F, Y'); ?></time>
                        </div>
                        <?php echo wp_trim_words(get_the_content(), 22, '...'); ?>
                    </div>
                </div>
            <?php endwhile;
                // wp_pagenavi();
            endif; ?>
        </article>
    </section>
</div>
<?php get_footer(); ?>
