<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_gallery_small' ) ) {
	function lekker_core_add_portfolio_single_variation_gallery_small( $variations ) {
		$variations['gallery-small'] = esc_html__( 'Gallery - Small', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_gallery_small' );
}