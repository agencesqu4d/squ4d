<?php

if ( ! function_exists( 'lekker_core_add_side_area_opener_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function lekker_core_add_side_area_opener_widget( $widgets ) {
		$widgets[] = 'LekkerCoreSideAreaOpenerWidget';
		
		return $widgets;
	}
	
	add_filter( 'lekker_core_filter_register_widgets', 'lekker_core_add_side_area_opener_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class LekkerCoreSideAreaOpenerWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'lekker_core_side_area_opener' );
			$this->set_name( esc_html__( 'Lekker Side Area Opener', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Display a "hamburger" icon that opens the side area', 'lekker-core' ) );
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'sidea_area_opener_margin',
					'title'       => esc_html__( 'Opener Margin', 'lekker-core' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'lekker-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'side_area_opener_color',
					'title'      => esc_html__( 'Opener Color', 'lekker-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'side_area_opener_hover_color',
					'title'      => esc_html__( 'Opener Hover Color', 'lekker-core' )
				)
			);
		}
		
		public function render( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['side_area_opener_color'] ) ) {
				$styles[] = 'color: ' . $atts['side_area_opener_color'] . ';';
			}
			
			if ( ! empty( $atts['sidea_area_opener_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['sidea_area_opener_margin'];
			}
			
			lekker_core_get_opener_icon_html( array(
				'option_name'  => 'side_area',
				'custom_class' => 'qodef-side-area-opener',
				'inline_style' => $styles,
				'inline_attr'  => qode_framework_get_inline_attr( $atts['side_area_opener_hover_color'], 'data-hover-color' )
			) );
		}
	}
}