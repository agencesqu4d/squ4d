<?php

if ( ! function_exists( 'lekker_core_add_icon_with_text_variation_before_title' ) ) {
	function lekker_core_add_icon_with_text_variation_before_title( $variations ) {
		
		$variations['before-title'] = esc_html__( 'Before Title', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_icon_with_text_layouts', 'lekker_core_add_icon_with_text_variation_before_title' );
}
