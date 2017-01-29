<?php
if ( have_rows( 'social_icons', 'options' ) ):
	while ( have_rows( 'social_icons', 'options' ) ) : the_row();
		if ( get_row_layout() == 'facebook' ): ?>
			<a href="<?php the_sub_field( 'url' ); ?>" class="i-c-bk" title="Official Facebook page"
			   target="_blank"></a>
		<?php elseif ( get_row_layout() == 'twitter' ): ?>
			<a href="<?php the_sub_field( 'url' ); ?>" class="i-c-tr" title="Official Twitter accounts"
			   target="_blank"></a>
		<?php elseif ( get_row_layout() == 'instagram' ): ?>
			<a href="" class="i-c-ism" title="Official Instagram accounts" target="_blank"></a>
		<?php elseif ( get_row_layout() == 'linkedin' ): ?>
			<a href="<?php the_sub_field( 'url' ); ?>" class="i-c-ln" title="Official Linkedin profile"
			   target="_blank"></a>
		<?php elseif ( get_row_layout() == 'google_plus' ): ?>
			<a href="<?php the_sub_field( 'url' ); ?>" class="i-c-gp" title="Official Google+ page"
			   target="_blank"></a>
		<?php elseif ( get_row_layout() == 'youtube' ): ?>
			<a href="<?php the_sub_field( 'url' ); ?>" class="i-c-yb" title="Official Youtube channel"
			   target="_blank"></a>
		<?php elseif ( get_row_layout() == 'vimeo' ): ?>
			<a href="<?php the_sub_field( 'url' ); ?>" class="i-c-yb" title="Official vimeo channel"
			   target="_blank"></a>
		<?php elseif ( get_row_layout() == 'pinterest' ): ?>
			<a href="<?php the_sub_field( 'url' ); ?>" class="i-c-pr" title="Official Pinterest accounts"
			   target="_blank"></a>
		<?php endif;
	endwhile;
else :
	// no layouts found
endif;
?>