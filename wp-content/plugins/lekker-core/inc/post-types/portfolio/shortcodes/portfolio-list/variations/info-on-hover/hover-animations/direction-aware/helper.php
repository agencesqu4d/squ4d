<?php

if ( ! function_exists( 'lekker_core_filter_portfolio_list_info_on_hover_direction_aware' ) ) {
	function lekker_core_filter_portfolio_list_info_on_hover_direction_aware( $variations ) {
		$variations['direction-aware'] = esc_html__( 'Direction Aware', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_portfolio_list_info_on_hover_animation_options', 'lekker_core_filter_portfolio_list_info_on_hover_direction_aware' );
}

if ( ! function_exists( 'lekker_core_include_hoverdir_scripts' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts
	 *
	 * @param $atts
	 */
	function lekker_core_include_hoverdir_scripts( $atts ) {
		
		if ( $atts['layout'] == 'info-on-hover' && $atts['hover_animation_info-on-hover'] == 'direction-aware' ) {
			wp_enqueue_script( 'hoverdir' );
		}
	}
	
	add_action( 'lekker_core_action_portfolio_list_load_assets', 'lekker_core_include_hoverdir_scripts' );
}

if ( ! function_exists( 'lekker_core_register_hoverdir_scripts' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param $scripts
	 * @return $atts
	 */
	function lekker_core_register_hoverdir_scripts( $scripts ) {

		$scripts['hoverdir'] = array(
			'registered'	=> false,
			'url'			=> LEKKER_CORE_INC_URL_PATH . '/post-types/portfolio/shortcodes/portfolio-list/variations/info-on-hover/hover-animations/direction-aware/assets/js/plugins/jquery.hoverdir.min.js',
			'dependency'	=> array( 'jquery' )
		);

		return $scripts;
	}

	add_filter( 'lekker_core_filter_portfolio_list_register_assets', 'lekker_core_register_hoverdir_scripts' );
}