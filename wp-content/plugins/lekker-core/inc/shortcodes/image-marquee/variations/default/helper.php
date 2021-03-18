<?php

if ( ! function_exists( 'lekker_core_add_image_marquee_variation_default' ) ) {
	function lekker_core_add_image_marquee_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_image_marquee_layouts', 'lekker_core_add_image_marquee_variation_default' );
}
