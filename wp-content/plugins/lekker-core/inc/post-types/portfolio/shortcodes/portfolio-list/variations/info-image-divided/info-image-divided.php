<?php

if ( ! function_exists( 'lekker_core_add_portfolio_list_variation_info_image_divided' ) ) {
	function lekker_core_add_portfolio_list_variation_info_image_divided( $variations ) {
		
		$variations['info-image-divided'] = esc_html__( 'Info Image Divided', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_list_layouts', 'lekker_core_add_portfolio_list_variation_info_image_divided' );
}