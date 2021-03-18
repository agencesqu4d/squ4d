<?php

if ( ! function_exists( 'lekker_core_add_banner_variation_link_overlay' ) ) {
	function lekker_core_add_banner_variation_link_overlay( $variations ) {
		
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_banner_layouts', 'lekker_core_add_banner_variation_link_overlay' );
}
