<?php

if ( ! function_exists( 'lekker_core_add_rotating_cubes_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function lekker_core_add_rotating_cubes_spinner_layout_option( $layouts ) {
		$layouts['rotating-cubes'] = esc_html__( 'Rotating Cubes', 'lekker-core' );
		
		return $layouts;
	}
	
	add_filter( 'lekker_core_filter_page_spinner_layout_options', 'lekker_core_add_rotating_cubes_spinner_layout_option' );
}