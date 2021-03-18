<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_images_small' ) ) {
	function lekker_core_add_portfolio_single_variation_images_small( $variations ) {
		
		$variations['images-small'] = esc_html__( 'Images - Small', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_images_small' );
}