<?php

if ( ! function_exists( 'lekker_core_dependency_for_mobile_menu_typography_options' ) ) {
	function lekker_core_dependency_for_mobile_menu_typography_options() {
		$dependency_options = apply_filters( 'lekker_core_filter_mobile_menu_typography_hide_option', $hide_dep_options = array() );
		
		return $dependency_options;
	}
}