<?php

if ( ! function_exists( 'lekker_core_add_counter_variation_simple' ) ) {
	function lekker_core_add_counter_variation_simple( $variations ) {
		
		$variations['simple'] = esc_html__( 'Simple', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_counter_layouts', 'lekker_core_add_counter_variation_simple' );
}
