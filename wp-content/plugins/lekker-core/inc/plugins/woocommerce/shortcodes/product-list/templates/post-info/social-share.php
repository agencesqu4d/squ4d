<?php if ( class_exists( 'LekkerCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-woo-product-social-share">
		<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'lekker-core' );
		
		echo LekkerCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>