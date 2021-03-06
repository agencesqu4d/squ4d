<?php

if ( ! function_exists( 'lekker_core_add_video_button_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function lekker_core_add_video_button_shortcode( $shortcodes ) {
		$shortcodes[] = 'LekkerCoreVideoButton';
		
		return $shortcodes;
	}
	
	add_filter( 'lekker_core_filter_register_shortcodes', 'lekker_core_add_video_button_shortcode' );
}

if ( class_exists( 'LekkerCoreShortcode' ) ) {
	class LekkerCoreVideoButton extends LekkerCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( LEKKER_CORE_SHORTCODES_URL_PATH . '/video-button' );
			$this->set_base( 'lekker_core_video_button' );
			$this->set_name( esc_html__( 'Video Button', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds video button element', 'lekker-core' ) );
			$this->set_category( esc_html__( 'Lekker Core', 'lekker-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'lekker-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'video_link',
				'title'      => esc_html__( 'Video Link', 'lekker-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'video_image',
				'title'      => esc_html__( 'Image', 'lekker-core' ),
				'description'=> esc_html__( 'Select image from media library', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'play_button_color',
				'title'      => esc_html__( 'Play Button Color', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'play_button_size',
				'title'      => esc_html__( 'Play Button Size (px)', 'lekker-core' )
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']		= $this->get_holder_classes( $atts );
			$atts['play_button_styles'] = $this->get_play_button_styles( $atts );

			return lekker_core_get_template_part( 'shortcodes/video-button', 'templates/video-button', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-video-button';
			$holder_classes[] = ! empty( $atts['video_image'] ) ? 'qodef--has-img' : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_play_button_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['play_button_color'] ) ) {
				$styles[] = 'color: ' . $atts['play_button_color'];
			}
			
			if ( ! empty( $atts['play_button_size'] ) ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['play_button_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['play_button_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['play_button_size'] ) . 'px';
				}
			}
			
			return implode( ';', $styles );
		}
	}
}