<?php

if ( ! function_exists( 'lekker_core_add_portfolio_list_variation_image_only' ) ) {
	function lekker_core_add_portfolio_list_variation_image_only( $variations ) {
		
		$variations['image-only'] = esc_html__( 'Image Only', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_list_layouts', 'lekker_core_add_portfolio_list_variation_image_only' );
}