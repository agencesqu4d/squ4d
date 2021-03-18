<?php

if ( ! function_exists( 'lekker_core_add_portfolio_list_variation_info_follow' ) ) {
	function lekker_core_add_portfolio_list_variation_info_follow( $variations ) {
		
		$variations['info-follow'] = esc_html__( 'Info Follow', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_list_layouts', 'lekker_core_add_portfolio_list_variation_info_follow' );
}