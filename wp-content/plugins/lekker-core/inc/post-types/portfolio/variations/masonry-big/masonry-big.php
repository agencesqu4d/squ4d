<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_masonry_big' ) ) {
	function lekker_core_add_portfolio_single_variation_masonry_big( $variations ) {
		$variations['masonry-big'] = esc_html__( 'Masonry - Big', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_masonry_big' );
}

if ( ! function_exists( 'lekker_core_include_masonry_for_portfolio_single_variation_masonry_big' ) ) {
	function lekker_core_include_masonry_for_portfolio_single_variation_masonry_big( $post_type ) {
		$portfolio_template = lekker_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );
		
		if ( $portfolio_template === 'masonry-big' ) {
			$post_type = 'portfolio-item';
		}
		
		return $post_type;
	}
	
	add_filter( 'lekker_filter_allowed_post_type_to_enqueue_masonry_scripts', 'lekker_core_include_masonry_for_portfolio_single_variation_masonry_big' );
}