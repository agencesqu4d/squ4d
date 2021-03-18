<?php

if ( ! function_exists( 'lekker_core_add_interactive_link_showcase_variation_slider' ) ) {
	function lekker_core_add_interactive_link_showcase_variation_slider( $variations ) {
		$variations['slider'] = esc_html__( 'Slider', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_interactive_link_showcase_layouts', 'lekker_core_add_interactive_link_showcase_variation_slider' );
}
