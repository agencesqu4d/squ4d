<?php

if ( ! function_exists( 'lekker_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function lekker_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'LekkerCoreBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'lekker_core_filter_register_widgets', 'lekker_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class LekkerCoreBlogListWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'lekker-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'lekker_core_blog_list'
			) );
			
			if ( $widget_mapped ) {
				$this->set_base( 'lekker_core_blog_list' );
				$this->set_name( esc_html__( 'Lekker Blog List', 'lekker-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'lekker-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[lekker_core_blog_list $params]" ); // XSS OK
		}
	}
}
