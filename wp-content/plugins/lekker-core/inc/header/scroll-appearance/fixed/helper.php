<?php

if ( ! function_exists( 'lekker_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function lekker_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'lekker-core' );

		return $options;
	}

	add_filter( 'lekker_core_filter_header_scroll_appearance_option', 'lekker_core_add_fixed_header_option' );
}