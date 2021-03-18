<?php

if ( ! function_exists( 'lekker_core_add_button_variation_filled' ) ) {
	function lekker_core_add_button_variation_filled( $variations ) {
		
		$variations['filled'] = esc_html__( 'Filled', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_button_layouts', 'lekker_core_add_button_variation_filled' );
}
