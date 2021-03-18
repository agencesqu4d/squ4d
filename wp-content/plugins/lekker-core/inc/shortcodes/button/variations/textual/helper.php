<?php

if ( ! function_exists( 'lekker_core_add_button_variation_textual' ) ) {
	function lekker_core_add_button_variation_textual( $variations ) {
		
		$variations['textual'] = esc_html__( 'Textual', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_button_layouts', 'lekker_core_add_button_variation_textual' );
}
