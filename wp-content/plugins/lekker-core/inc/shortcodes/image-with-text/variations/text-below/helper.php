<?php

if ( ! function_exists( 'lekker_core_add_image_with_text_variation_text_below' ) ) {
	function lekker_core_add_image_with_text_variation_text_below( $variations ) {
		
		$variations['text-below'] = esc_html__( 'Text Below', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_image_with_text_layouts', 'lekker_core_add_image_with_text_variation_text_below' );
}
