<?php

if ( ! function_exists( 'lekker_core_add_portfolio_list_variation_info_on_side' ) ) {
	function lekker_core_add_portfolio_list_variation_info_on_side( $variations ) {
		
		$variations['info-on-side'] = esc_html__( 'Info on Side', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_list_layouts', 'lekker_core_add_portfolio_list_variation_info_on_side' );
}