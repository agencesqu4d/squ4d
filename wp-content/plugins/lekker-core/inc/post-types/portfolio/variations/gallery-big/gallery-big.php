<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_gallery_big' ) ) {
	function lekker_core_add_portfolio_single_variation_gallery_big( $variations ) {
		$variations['gallery-big'] = esc_html__( 'Gallery - Big', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_gallery_big' );
}