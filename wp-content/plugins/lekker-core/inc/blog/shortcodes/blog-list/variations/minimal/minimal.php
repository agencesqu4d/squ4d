<?php

if ( ! function_exists( 'lekker_core_add_blog_list_variation_minimal' ) ) {
	function lekker_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_blog_list_layouts', 'lekker_core_add_blog_list_variation_minimal' );
}