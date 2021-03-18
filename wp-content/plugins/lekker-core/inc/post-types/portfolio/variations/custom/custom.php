<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_custom' ) ) {
	function lekker_core_add_portfolio_single_variation_custom( $variations ) {
		$variations['custom'] = esc_html__( 'Custom', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_custom' );
}