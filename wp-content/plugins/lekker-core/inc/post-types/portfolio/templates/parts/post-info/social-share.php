<div class="qodef-e qodef-info--social-share">
	<?php if ( class_exists( 'LekkerCoreSocialShareShortcode' ) ) {
		$params = array(
			'title'     => esc_html__( 'Share:', 'lekker-core' ),
			'layout'    => 'list',
			'icon_font' => 'elegant-icons'
		);
		
		echo LekkerCoreSocialShareShortcode::call_shortcode( $params );
	} ?>
</div>