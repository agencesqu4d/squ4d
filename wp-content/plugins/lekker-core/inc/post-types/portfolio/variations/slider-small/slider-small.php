<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_slider_small' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function lekker_core_add_portfolio_single_variation_slider_small( $variations ) {
		$variations['slider-small'] = esc_html__( 'Slider - Small', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_slider_small' );
}