<?php

if ( ! function_exists( 'lekker_core_add_social_share_variation_text' ) ) {
	function lekker_core_add_social_share_variation_text( $variations ) {
		
		$variations['text'] = esc_html__( 'Text', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_social_share_layouts', 'lekker_core_add_social_share_variation_text' );
}
