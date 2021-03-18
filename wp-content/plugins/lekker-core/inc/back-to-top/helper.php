<?php

if ( ! function_exists( 'lekker_core_is_back_to_top_enabled' ) ) {
	function lekker_core_is_back_to_top_enabled() {
		return lekker_core_get_post_value_through_levels( 'qodef_back_to_top' ) !== 'no';
	}
}

if ( ! function_exists( 'lekker_core_add_back_to_top_to_body_classes' ) ) {
	function lekker_core_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = lekker_core_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'lekker_core_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'lekker_core_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function lekker_core_load_back_to_top() {
		
		if ( lekker_core_is_back_to_top_enabled() ) {
			$parameters = array();
			
			lekker_core_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters );
		}
	}
	
	add_action( 'lekker_action_before_wrapper_close_tag', 'lekker_core_load_back_to_top' );
}