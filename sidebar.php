<aside class="index_aside col-3 sm-12">
	<?php if ( is_active_sidebar( 'aside_widget' ) ) : ?>
        <div class="aside_box"
		<?php dynamic_sidebar( 'aside_widget' ); ?>
        </div>
	<?php endif; ?>
    <div class="aside_box">
        <h3>Popular categories</h3>
        <ul>
			<?php
			$popular_cat = array(
				'show_option_all'  => 0,
				'orderby'          => 'count',
				'order'            => 'DESC',
				'style'            => 'list',
				'show_count'       => 1,
				'hide_empty'       => 1,
				'current_category' => 1,
				'exclude'          => '',
				'exclude_tree'     => '',
				'include'          => '',
				'hierarchical'     => 1,
				'title_li'         => __( '' ),
				'show_option_none' => __( '' ),
				'number'           => 5,
				'echo'             => 1,
			);
			wp_list_categories( $popular_cat );
			?>
        </ul>
    </div>
    <div class="aside_box">
        <h3>Archive by month</h3>
        <ul>
			<?php
			$post_archive = array(
				'type'            => 'monthly',
				'limit'           => '6',
				'format'          => 'html',
				'before'          => '',
				'after'           => '',
				'show_post_count' => 'true',
				'echo'            => 1,
				'order'           => 'DESC',
				'post_type'       => 'post'
			);
			wp_get_archives( $post_archive ); ?>
        </ul>
    </div>
    <div class="aside_box">
        <h3>RECENT POSTS </h3>
        <ul id="catnav">
			<?php
			global $post;
			$category = get_the_category( $post->ID );
			$category = $category[0]->cat_ID;
			$myposts  = get_posts( array(
				'numberposts'  => 3,
				'offset'       => 0,
				'category__in' => array( $category ),
				'post_status'  => 'publish',
				'order'        => 'DESC'
			) );
			foreach ( $myposts as $post ) :
				setup_postdata( $post );
				?>
                <li>
                    <a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
                        <time>Posted <?php echo get_the_date( 'j F, Y' ); ?></time>
                    </a>
                </li>
			<?php endforeach; ?>
			<?php wp_reset_query(); ?>
        </ul>
    </div>
</aside>