<?php

if ( ! function_exists( 'lekker_core_add_instagram_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function lekker_core_add_instagram_list_shortcode( $shortcodes ) {
		if( qode_framework_is_installed( 'instagram' ) ) {
			$shortcodes[] = 'LekkerCoreInstagramListShortcode';
		}
		
		return $shortcodes;
	}
	
	add_filter( 'lekker_core_filter_register_shortcodes', 'lekker_core_add_instagram_list_shortcode' );
}

if ( class_exists( 'LekkerCoreShortcode' ) ) {
	class LekkerCoreInstagramListShortcode extends LekkerCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( LEKKER_CORE_PLUGINS_URL_PATH . '/instagram/shortcodes/instagram-list' );
			$this->set_base( 'lekker_core_instagram_list' );
			$this->set_name( esc_html__( 'Instagram List', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays instagram list', 'lekker-core' ) );
			$this->set_category( esc_html__( 'Lekker Core', 'lekker-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'photos_number',
				'title'      => esc_html__( 'Number of Photos', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'columns_number',
				'title'         => esc_html__( 'Number of Columns', 'lekker-core' ),
				'options'       => array(
					'1'  => esc_html__( '1', 'lekker-core' ),
					'2'  => esc_html__( '2', 'lekker-core' ),
					'3'  => esc_html__( '3', 'lekker-core' ),
					'4'  => esc_html__( '4', 'lekker-core' ),
					'5'  => esc_html__( '5', 'lekker-core' ),
					'6'  => esc_html__( '6', 'lekker-core' ),
					'7'  => esc_html__( '7', 'lekker-core' ),
					'8'  => esc_html__( '8', 'lekker-core' ),
					'9'  => esc_html__( '9', 'lekker-core' ),
					'10' => esc_html__( '10', 'lekker-core' ),
				),
				'default_value' => '3'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'space',
				'title'         => esc_html__( 'Padding Around Images', 'lekker-core' ),
				'options'       => lekker_core_get_select_type_options_pool( 'items_space' ),
				'default_value' => 'small'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_resolution',
				'title'         => esc_html__( 'Image Resolution', 'lekker-core' ),
				'options'       => array(
					'auto'  => esc_html__( 'Auto-detect (recommended)', 'lekker-core' ),
					'thumb'  => esc_html__( 'Thumbnail (150x150)', 'lekker-core' ),
					'medium'  => esc_html__( 'Medium (306x306)', 'lekker-core' ),
					'full'  => esc_html__( 'Full (640x640)', 'lekker-core' )
				),
				'default_value' => 'auto'
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['instagram_params']   = $this->get_instagram_params( $atts );
			
			return lekker_core_get_template_part( 'plugins/instagram/shortcodes/instagram-list', 'templates/instagram-list', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-instagram-list';
			$holder_classes[] = ! empty( $atts['space'] ) ? 'qodef-gutter--' . $atts['space'] : '';
			$holder_classes[] = ! empty( $atts['columns_number'] ) ? 'qodef-col-num--' . $atts['columns_number'] : '';
			
			$holder_classes = array_merge( $holder_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_instagram_params( $atts ) {
			$params = array();
			
			$params['num'] = isset( $atts['photos_number'] ) && ! empty( $atts['photos_number'] ) ? $atts['photos_number'] : 6;
			$params['cols'] = isset( $atts['columns_number'] ) && ! empty( $atts['columns_number'] ) ? $atts['columns_number'] : 3;
			$params['imagepadding'] = isset( $atts['space'] ) && ! empty( $atts['space'] ) ? lekker_core_get_space_value( $atts['space'] ) : 10;
			$params['imagepaddingunit'] = 'px';
			$params['showheader'] = false;
			$params['showfollow'] = false;
			$params['showbutton'] = false;
			$params['imageres'] = isset( $atts['image_resolution'] ) && ! empty( $atts['image_resolution'] ) ? $atts['image_resolution'] : 'auto';
			
			if ( is_array( $params ) && count( $params ) ) {
				foreach ( $params as $key => $value ) {
					if ( $value !== '' ) {
						$params[] = $key . "='" . esc_attr( str_replace( ' ', '', $value ) ) . "'";
					}
				}
			}
			
			return implode( ' ', $params );
		}
	}
}