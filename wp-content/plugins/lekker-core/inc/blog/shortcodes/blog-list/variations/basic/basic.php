<?php

if ( ! function_exists( 'lekker_core_add_blog_list_variation_basic' ) ) {
	function lekker_core_add_blog_list_variation_basic( $variations ) {
		$variations['basic'] = esc_html__( 'Basic', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_blog_list_layouts', 'lekker_core_add_blog_list_variation_basic' );
}