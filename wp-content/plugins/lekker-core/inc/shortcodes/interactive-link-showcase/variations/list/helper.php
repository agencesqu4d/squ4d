<?php

if ( ! function_exists( 'lekker_core_add_interactive_link_showcase_variation_list' ) ) {
	function lekker_core_add_interactive_link_showcase_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_interactive_link_showcase_layouts', 'lekker_core_add_interactive_link_showcase_variation_list' );
}
