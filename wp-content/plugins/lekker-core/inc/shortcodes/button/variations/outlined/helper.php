<?php

if ( ! function_exists( 'lekker_core_add_button_variation_outlined' ) ) {
	function lekker_core_add_button_variation_outlined( $variations ) {
		
		$variations['outlined'] = esc_html__( 'Outlined', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_button_layouts', 'lekker_core_add_button_variation_outlined' );
}
