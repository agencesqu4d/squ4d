<?php

if ( ! function_exists( 'lekker_core_add_banner_variation_link_button' ) ) {
	function lekker_core_add_banner_variation_link_button( $variations ) {
		
		$variations['link-button'] = esc_html__( 'Link Button', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_banner_layouts', 'lekker_core_add_banner_variation_link_button' );
}
