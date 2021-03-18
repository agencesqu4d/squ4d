<?php

if ( ! function_exists( 'lekker_core_get_elementor_instance' ) ) {
	function lekker_core_get_elementor_instance() {
		return \Elementor\Plugin::instance();
	}
}

if ( ! function_exists( 'lekker_core_get_elementor_widgets_manager' ) ) {
	function lekker_core_get_elementor_widgets_manager() {
		return lekker_core_get_elementor_instance()->widgets_manager;
	}
}

if ( ! function_exists( 'lekker_core_load_elementor_widgets' ) ) {
	function lekker_core_load_elementor_widgets() {
		foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/*/*-elementor.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
		
		foreach ( glob( LEKKER_CORE_INC_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
		
		foreach ( glob( LEKKER_CORE_CPT_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
		
		foreach ( glob( LEKKER_CORE_PLUGINS_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'elementor/widgets/widgets_registered', 'lekker_core_load_elementor_widgets' );
}