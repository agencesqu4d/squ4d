<?php

if ( ! function_exists( 'lekker_core_add_pricing_table_variation_standard' ) ) {
	function lekker_core_add_pricing_table_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_pricing_table_layouts', 'lekker_core_add_pricing_table_variation_standard' );
}
