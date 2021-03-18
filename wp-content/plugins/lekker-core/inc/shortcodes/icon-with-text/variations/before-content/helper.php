<?php

if ( ! function_exists( 'lekker_core_add_icon_with_text_variation_before_content' ) ) {
	function lekker_core_add_icon_with_text_variation_before_content( $variations ) {
		
		$variations['before-content'] = esc_html__( 'Before Content', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_icon_with_text_layouts', 'lekker_core_add_icon_with_text_variation_before_content' );
}
