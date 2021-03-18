<?php

if ( ! function_exists( 'lekker_core_add_progress_bar_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function lekker_core_add_progress_bar_spinner_layout_option( $layouts ) {
		$layouts['progress-bar'] = esc_html__( 'Progress Bar', 'lekker-core' );
		
		return $layouts;
	}
	
	add_filter( 'lekker_core_filter_page_spinner_layout_options', 'lekker_core_add_progress_bar_spinner_layout_option' );
}

if ( ! function_exists( 'lekker_core_add_progress_bar_spinner_layout_classes' ) ) {
	/**
	 * Function that return classes for page spinner area
	 *
	 * @param $classes array
	 *
	 * @return array
	 */
	function lekker_core_add_progress_bar_spinner_layout_classes( $classes ) {
		$type = lekker_core_get_post_value_through_levels( 'qodef_page_spinner_type' );
		
		if ( $type === 'progress-bar' ) {
			$classes[] = 'qodef--custom-spinner';
		}
		
		return $classes;
	}
	
	add_filter( 'lekker_filter_page_spinner_classes', 'lekker_core_add_progress_bar_spinner_layout_classes' );
}