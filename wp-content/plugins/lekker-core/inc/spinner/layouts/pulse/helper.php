<?php

if ( ! function_exists( 'lekker_core_add_pulse_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function lekker_core_add_pulse_spinner_layout_option( $layouts ) {
		$layouts['pulse'] = esc_html__( 'Pulse', 'lekker-core' );
		
		return $layouts;
	}
	
	add_filter( 'lekker_core_filter_page_spinner_layout_options', 'lekker_core_add_pulse_spinner_layout_option' );
}

if ( ! function_exists( 'lekker_core_set_pulse_spinner_layout_as_default_option' ) ) {
	/**
	 * Function that set default value for page spinner layout options map
	 *
	 * @param $default_value string
	 *
	 * @return string
	 */
	function lekker_core_set_pulse_spinner_layout_as_default_option( $default_value ) {
		return 'pulse';
	}
	
	add_filter( 'lekker_core_filter_page_spinner_default_layout_option', 'lekker_core_set_pulse_spinner_layout_as_default_option' );
}