<aside class="index_aside">
    <?php if (is_active_sidebar('aside_widget')) : ?>
        <div class="aside_box"
        <?php dynamic_sidebar('aside_widget'); ?>
        </div>
    <?php endif; ?>
    <div class="aside_box">
        <h3>Popular categories</h3>
        <ul>
            <?php
            $popular_cat = array(
                'show_option_all' => 0,
                'orderby' => 'count',
                'order' => 'DESC',
                'style' => 'list',
                'show_count' => 1,
                'hide_empty' => 1,
                'current_category' => 1,
                'exclude' => '',
                'exclude_tree' => '',
                'include' => '',
                'hierarchical' => 1,
                'title_li' => __(''),
                'show_option_none' => __(''),
                'number' => 5,
                'echo' => 1,
            );
            wp_list_categories($popular_cat);
            ?>
        </ul>
    </div>
    <div class="aside_box">
        <h3>Archive by month</h3>
        <ul>
            <?php
            $post_archive = array(
                'type' => 'monthly',
                'limit' => '6',
                'format' => 'html',
                'before' => '',
                'after' => '',
                'show_post_count' => 'true',
                'echo' => 1,
                'order' => 'DESC',
                'post_type' => 'post'
            );
            wp_get_archives($post_archive); ?>
        </ul>
    </div>
</aside>