<?php

if ( ! function_exists( 'lekker_core_add_portfolio_list_variation_switch_images' ) ) {
	function lekker_core_add_portfolio_list_variation_switch_images( $variations ) {
		
		$variations['switch-images'] = esc_html__( 'Switch Images', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_list_layouts', 'lekker_core_add_portfolio_list_variation_switch_images' );
}