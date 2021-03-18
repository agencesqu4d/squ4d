<?php

if ( ! function_exists( 'lekker_core_add_portfolio_list_variation_image_background' ) ) {
	function lekker_core_add_portfolio_list_variation_image_background( $variations ) {
		
		$variations['image-background'] = esc_html__( 'Image Background', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_list_layouts', 'lekker_core_add_portfolio_list_variation_image_background' );
}