<?php // You can start editing here. ?>
<div class="comment_wrap">
	<?php if ( have_comments() ): ?>
        <h3 id="comments-title">
			<?php comments_number( __( '<span>No</span> Comments' ), __( '<span>One</span> Comment' ), __( '<span>%</span> Comments' ) ); ?>
        </h3>
        <section class="commentlist">
			<?php
			wp_list_comments( array(
				'style'             => 'div',
				'short_ping'        => true,
				'avatar_size'       => 40,
				'type'              => 'all',
				'page'              => '',
				'per_page'          => '',
				'reverse_top_level' => null,
				'reverse_children'  => '',
			) );
			?>
        </section>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
            <nav class="navigation comment-navigation" role="navigation">
                <div class="comment-nav-prev btn "><?php previous_comments_link( __( 'Previous Comments' ) ); ?></div>
                <div class="comment-nav-next btn "><?php next_comments_link( __( 'More Comments' ) ); ?></div>
            </nav>
		<?php endif; ?>
		<?php if ( ! comments_open() ): ?>
            <p class="no-comments">
				<?php _e( 'Comments are closed.', 'bonestheme' ); ?>
            </p>
		<?php endif; ?>
	<?php endif; ?>
	<?php
	$args = array(
		'fields'               => apply_filters(
			'comment_form_default_fields', array(
				//author
				'author' => '<div class="comment-form-author">' . '<input id="author" placeholder="Your Name" name="author" type="text" value="' .
				            esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
				            ( $req ? '<span class="required">*</span>' : '' ) .
				            '</div>'
			,
				//email
				'email'  => '<div class="comment-form-email">' . '<input id="email" placeholder="E-mail" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
				            '" size="30"' . $aria_req . ' />' .
				            ( $req ? '<span class="required">*</span>' : '' )
				            .
				            '</div>',
				//URL
				'url'    => '<p class="comment-form-url">' .
				            '<input id="url" name="url" placeholder="http://your-site-name.com" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' .
				            '<label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
				            '</p>',
			)
		),
		'comment_field'        => '<div class="comment-form-comment">' .
		                          '<textarea id="comment" name="comment" placeholder="Comment" cols="45" rows="8" aria-required="true"></textarea>' .
		                          '</div>',
		'comment_notes_after'  => '',
		'comment_notes_before' => '',
		'title_reply'          => '<div class="crunchify-text"> <h5>Please Post Your Comments & Reviews</h5></div>',
	);
	comment_form( $args, $post_id );
	?>
</div> <!-- End comment_wrap -->