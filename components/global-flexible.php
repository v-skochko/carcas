<div class="flex wysiwyg">
	<?php
	if ( is_post_type_archive() ) {
		$isPostType = is_post_type_archive( get_queried_object()->rewrite['slug'] ) ? 'cpt_' . get_queried_object()->rewrite['slug'] : false;
	}
	if ( have_rows( 'content_layout' ) ):
		while ( have_rows( 'content_layout', $isPostType ) ) :
			the_row();
			/* simple wysiwyg */
			if ( get_row_layout() == 'simple_wysiwyg' ): ?>
                <div class="<?php the_sub_field( 'width' ); ?> sm-12 simple_wysiwyg  ">
					<?php the_sub_field( 'simple_wysiwyg_content' ); ?>
                </div>
			<?php /* other_group */
            elseif ( get_row_layout() == 'other_group' ): ?>
				<?php the_sub_field( 'other_group_content' ); ?>
			<?php endif;
		endwhile;
	endif;
	?>
</div>
