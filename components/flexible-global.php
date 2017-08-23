<?php
if ( have_rows( 'content_layout' ) ):
while ( have_rows( 'content_layout' ) ) :
the_row();
if ( get_row_layout() == 'simple_wysiwyg' ): ?>
    <div class="simple_wysiwyg">


		<?php if ( $columns = get_sub_field( "columns_list" ) ): ?>
            <div class="columns flex">
				<?php foreach ( $columns as $columns_item ) { ?>
                    <div class="item <?php echo $columns_item['width'] ?> sm-12">
						<?php echo $columns_item['column'] ?>
                    </div>
				<?php } ?>
            </div>
		<?php endif; ?>
    </div>
<?php elseif ( get_row_layout() == 'download' ):
	$file = get_sub_field( 'file' ); ?>
<?php /* Open Full width div */
elseif ( get_row_layout() == 'open_full_width_block' ): ?>
<?php echo "</div>"; /*Close previously row */ ?>
<div class="full_width_block bg_center col-12"
     style="background-color:<?php the_sub_field( 'background_color' ); ?>;
     <?php echo image_src( get_sub_field( 'background_image' ), 'large', true, false ); ?>
             ">
	<?php /* Close Full width div */
    elseif ( get_row_layout() == 'close_full_width_block' ): ?>
</div>
<div class="row">
	<?php endif;
	endwhile;
	else :
		echo "Enpty.....";
	endif;
	?>

