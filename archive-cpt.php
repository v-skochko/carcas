<?php get_header();
global $post; ?>
    <div id="content" class="row cfx">
        <?php $taxonomies = get_terms('cpt_cat', array('order' => 'DESC'));
        foreach ($taxonomies as $taxonomy) { ?>
            <div class="cpt_cat_item <?php echo $taxonomy->slug ?>">
                <h1 class="title"><?php echo $taxonomy->name ?></h1>
                <?php $args = array(
                    //'post_type' => 'persons',
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy->taxonomy,
                            'field' => 'slug',
                            'terms' => array($taxonomy->slug),
                        )
                    )
                );
                query_posts($args);
                if (have_posts()) :
                    while (have_posts()) : the_post(); ?>
                        <div class="cpt_item">
                            <h3><?php the_title(); ?> </h3>
                            <div class="wysiwyg">
                                <?php the_content() ?>
                            </div>
                        </div>
                    <?php endwhile;
                endif;
                wp_reset_query(); ?>
            </div>
        <?php } ?>
    </div>
<?php get_footer();
