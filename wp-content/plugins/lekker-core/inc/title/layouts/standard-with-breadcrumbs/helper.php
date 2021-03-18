<?php

if ( ! function_exists( 'lekker_core_register_standard_with_breadcrumbs_title_layout' ) ) {
	function lekker_core_register_standard_with_breadcrumbs_title_layout( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = 'LekkerCoreStandardWithBreadcrumbsTitle';

		return $layouts;
	}

	add_filter( 'lekker_core_filter_register_title_layouts', 'lekker_core_register_standard_with_breadcrumbs_title_layout' );
}

if ( ! function_exists( 'lekker_core_add_standard_with_breadcrumbs_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function lekker_core_add_standard_with_breadcrumbs_title_layout_option( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = esc_html__( 'Standard with breadcrumbs', 'lekker-core' );

		return $layouts;
	}

	add_filter( 'lekker_core_filter_title_layout_options', 'lekker_core_add_standard_with_breadcrumbs_title_layout_option' );
}

