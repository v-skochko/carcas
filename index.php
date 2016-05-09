<?php get_header(); ?>
<div id="content" class="row cfx">
    <?php
    $catID = get_queried_object()->term_id;
    $catN = get_queried_object()->name;
    $curauth = $wp_query->get_queried_object();
    if (is_date()) {
        $queryname = 'Archive of ' . date("F") . ', ' . date('Y');
    } elseif (is_category()) {
        $queryname = single_cat_title('', false);
    } elseif (is_author()) {
        $queryname = 'Posts by ' . $curauth->nickname;
    } else {
        $queryname = get_the_title(BLOG_ID);
    } ?>
    <?php if ($queryname) : echo '<h1>' . $queryname . '</h1>'; endif; ?>
    <?php
    if (is_search()) { ?>
        <h1 class="page-title"><?php printf(esc_html__('Search Results for: %s'), '<span>' . get_search_query() . '</span>'); ?></h1>
    <?php } else { ?>
        <h1 class="page-title">BLOG</h1>
    <?php }
    ?>
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
                            <div class="author"><?php the_author(); ?></div>
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
