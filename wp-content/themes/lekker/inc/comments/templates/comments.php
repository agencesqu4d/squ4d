<div id="qodef-page-comments">
	<?php if ( have_comments() ) {
		$comments_number = get_comments_number();
		?>
		<div id="qodef-page-comments-list" class="qodef-m">
			<h4 class="qodef-m-title"><?php echo sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'lekker' ), $comments_number ); ?></h4>
			<ul class="qodef-m-comments">
				<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'lekker_get_comments_list_template' ), apply_filters( 'lekker_filter_comments_list_template_callback', array() ) ) ) ); ?>
			</ul>
			
			<?php if ( get_comment_pages_count() > 1 ) { ?>
				<div class="qodef-m-pagination qodef--wp">
					<?php the_comments_pagination( array(
						'prev_text'          => lekker_get_icon( 'arrow_carrot-left', 'elegant-icons', esc_html__( '< Prev', 'lekker' ) ),
						'next_text'          => lekker_get_icon( 'arrow_carrot-right', 'elegant-icons', esc_html__( 'Next >', 'lekker' ) ),
						'before_page_number' => '0'
					) ); ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="qodef-page-comments-not-found"><?php esc_html_e( 'Comments are closed.', 'lekker' ); ?></p>
	<?php } ?>
	
	<div id="qodef-page-comments-form">
		<?php
		$qodef_commenter = wp_get_current_commenter();
		$qodef_req       = get_option( 'require_name_email' );
		$qodef_html_req  = ( $qodef_req ? " required='required'" : '' );
		
		$args = array(
			'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h4>',
			'comment_field'      => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Post comment *', 'lekker' ) . '" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>',
			'fields'             => array(
				'author' => '<div class="qodef-grid qodef-layout--columns qodef-col-num--2"><div class="qodef-grid-inner"><div class="qodef-grid-item"><p class="comment-form-author">
							<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Full Name *', 'lekker' ) . '" value="' . esc_attr( $qodef_commenter['comment_author'] ) . '" size="30" maxlength="245" ' . $qodef_html_req . ' />
							</p></div>',
				'email'  => '<div class="qodef-grid-item"><p class="comment-form-email">
							 <input id="email" name="email" type="email" placeholder="' . esc_attr__( 'E-mail address *', 'lekker' ) . '" value="' . esc_attr( $qodef_commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes" ' . $qodef_html_req . ' />
							 </p></div></div></div>',
			)
		);
		
		comment_form( apply_filters( 'lekker_filter_comment_form_args', $args ) ); ?>
	</div>
</div>