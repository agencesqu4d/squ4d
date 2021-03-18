<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_images_big' ) ) {
	function lekker_core_add_portfolio_single_variation_images_big( $variations ) {
		$variations['images-big'] = esc_html__( 'Images - Big', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_images_big' );
}

if ( ! function_exists( 'lekker_core_set_default_portfolio_single_variation_compact' ) ) {
	function lekker_core_set_default_portfolio_single_variation_compact() {
		return 'images-big';
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_default_value', 'lekker_core_set_default_portfolio_single_variation_compact' );
}