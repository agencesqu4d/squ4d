<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_variation_slider' ) ) {
	function lekker_core_add_portfolio_single_variation_slider( $variations ) {
		$variations['slider'] = esc_html__( 'Slider', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_single_layout_options', 'lekker_core_add_portfolio_single_variation_slider' );
}

if ( ! function_exists( 'lekker_core_add_portfolio_single_slider' ) ) {
	function lekker_core_add_portfolio_single_slider() {
		if ( lekker_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' ) == 'slider' ) {
			lekker_core_template_part( 'post-types/portfolio', 'variations/slider/layout/parts/slider' );
		}
	}
	
	add_action( 'lekker_action_before_page_inner', 'lekker_core_add_portfolio_single_slider' );
}