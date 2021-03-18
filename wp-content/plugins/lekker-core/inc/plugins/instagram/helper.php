<?php

if ( ! function_exists( 'lekker_core_include_instagram_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function lekker_core_include_instagram_shortcodes() {
		foreach ( glob( LEKKER_CORE_PLUGINS_PATH . '/instagram/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}
	
	add_action( 'qode_framework_action_before_shortcodes_register', 'lekker_core_include_instagram_shortcodes' );
}

if ( ! function_exists( 'lekker_core_include_instagram_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function lekker_core_include_instagram_widgets() {
		foreach ( glob( LEKKER_CORE_PLUGINS_PATH . '/instagram/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'lekker_core_include_instagram_widgets' );
}

if ( ! function_exists( 'lekker_core_include_instagram_plugin_is_installed' ) ) {
	function lekker_core_include_instagram_plugin_is_installed( $installed, $plugin ) {
		if( $plugin === 'instagram' ) {
			return defined( 'SBIVER' );
		}
		
		return $installed;
	}
	
	add_filter( 'qode_framework_filter_is_plugin_installed', 'lekker_core_include_instagram_plugin_is_installed', 10, 2 );
}