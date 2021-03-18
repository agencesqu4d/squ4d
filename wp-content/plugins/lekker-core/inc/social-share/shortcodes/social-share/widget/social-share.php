<?php

if ( ! function_exists( 'lekker_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function lekker_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'LekkerCoreSocialShareWidget';
		
		return $widgets;
	}
	
	add_filter( 'lekker_core_filter_register_widgets', 'lekker_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class LekkerCoreSocialShareWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'lekker_core_social_share'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'lekker_core_social_share' );
				$this->set_name( esc_html__( 'Lekker Social Share', 'lekker-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'lekker-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[lekker_core_social_share $params]" ); // XSS OK
		}
	}
}