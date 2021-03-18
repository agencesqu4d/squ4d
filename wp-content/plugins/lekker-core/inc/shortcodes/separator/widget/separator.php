<?php

if ( ! function_exists( 'lekker_core_add_separator_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function lekker_core_add_separator_widget( $widgets ) {
		$widgets[] = 'LekkerCoreSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'lekker_core_filter_register_widgets', 'lekker_core_add_separator_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class LekkerCoreSeparatorWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'lekker_core_separator'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'lekker_core_separator' );
				$this->set_name( esc_html__( 'Lekker Separator', 'lekker-core' ) );
				$this->set_description( esc_html__( 'Add a separator element into widget areas', 'lekker-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[lekker_core_separator $params]" ); // XSS OK
		}
	}
}