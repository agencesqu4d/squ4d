<?php

if ( ! function_exists( 'lekker_core_add_portfolio_list_variation_info_left' ) ) {
	function lekker_core_add_portfolio_list_variation_info_left( $variations ) {
		
		$variations['info-left'] = esc_html__( 'Info Left', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_list_layouts', 'lekker_core_add_portfolio_list_variation_info_left' );
}