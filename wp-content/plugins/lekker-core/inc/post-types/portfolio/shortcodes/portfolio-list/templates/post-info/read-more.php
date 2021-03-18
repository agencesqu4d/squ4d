<?php if ( ! post_password_required() ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'button_layout' => 'textual',
			'link'          => get_the_permalink(),
			'text'          => esc_html__( 'Read More', 'lekker-core' )
		);
		
		echo LekkerCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>