<?php
if ( have_rows( 'content_layout' ) ):
	while ( have_rows( 'content_layout' ) ) : the_row();
		if ( get_row_layout() == 'simple_wysiwyg' ): ?>
			<div class="simple_wysiwyg">
				<div class="row">
					<?php the_sub_field( 'simple_wysiwyg_content' ); ?>
				</div>
			</div>
		<?php elseif ( get_row_layout() == 'download' ):
			$file = get_sub_field( 'file' ); ?>
		<?php elseif ( get_row_layout() == 'two_column_wysiwyg' ): ?>
			<div class="two_column_wysiwyg">
				<div class="row flex">
					<div class="col-6">
						<?php the_sub_field( 'left_column' ); ?>
					</div>
					<div class="col-6">
						<?php the_sub_field( 'right_column' ); ?>
					</div>
				</div>
			</div>
		<?php elseif ( get_row_layout() == 'two_column_wysiwyg_and_image' ): ?>
			<div class="two_column_wysiwyg_and_image"
				<?php if ( get_sub_field( 'backgrond_color' ) ): ?>
					style="background-color:  <?php the_sub_field( 'backgrond_color' ); ?>   "

				<?php endif; ?> >
				<div class="row flex
				<?php
				if ( get_sub_field( 'image_column' ) ): echo "image_on_left "; endif;
				if ( get_sub_field( 'centered_column' ) ): echo "ai_center "; endif;
				if ( get_sub_field( 'backgrond_color' ) ): echo "ai_center "; endif;
				?> ">
					<div class="col-6">
						<?php the_sub_field( 'wysiwyg_column' ); ?>
					</div>
					<div class="col-6 ">
						<img src="<?php echo image_src( get_sub_field( 'image_column' ), 'large', false, false ); ?>"
						     alt="">
					</div>
				</div>
			</div>
		<?php endif;
	endwhile;
else :
	// no layouts found
endif;
?>


