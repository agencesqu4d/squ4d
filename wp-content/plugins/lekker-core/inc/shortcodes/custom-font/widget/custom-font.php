<?php

if ( ! function_exists( 'lekker_core_add_custom_font_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function lekker_core_add_custom_font_widget( $widgets ) {
		$widgets[] = 'LekkerCoreCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'lekker_core_filter_register_widgets', 'lekker_core_add_custom_font_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class LekkerCoreCustomFontWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'lekker_core_custom_font'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'lekker_core_custom_font' );
				$this->set_name( esc_html__( 'Lekker Custom Font', 'lekker-core' ) );
				$this->set_description( esc_html__( 'Add a custom font element into widget areas', 'lekker-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[lekker_core_custom_font $params]" ); // XSS OK
		}
	}
}