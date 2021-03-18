<?php

if ( ! function_exists( 'lekker_core_add_call_to_action_variation_standard' ) ) {
	function lekker_core_add_call_to_action_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_call_to_action_layouts', 'lekker_core_add_call_to_action_variation_standard' );
}
