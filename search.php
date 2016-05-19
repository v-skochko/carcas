<?php get_header(); ?>
<div id="content" class="row cfx">
    <h1 class="page-title"><?php printf(esc_html__('Search Results for: %s'), '<span>' . get_search_query() . '</span>'); ?></h1>
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
                            <time><?php echo get_the_date('j F, Y'); ?></time>
                        <?php echo wp_trim_words(get_the_content(), 22, '...'); ?>
                    </div>
                </div>
            <?php endwhile;
            endif; ?>
        </article>
    </section>
</div>
<?php get_footer(); ?>
