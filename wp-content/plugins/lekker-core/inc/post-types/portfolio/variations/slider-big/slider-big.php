<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_slider_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function lekker_core_add_portfolio_single_variation_slider_big( $variations ) {
		$variations['slider-big'] = esc_html__( 'Slider - Big', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_slider_big' );
}