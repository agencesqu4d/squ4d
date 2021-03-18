<?php

if ( ! function_exists( 'lekker_core_add_image_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function lekker_core_add_image_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'LekkerCoreImageWithTextShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'lekker_core_filter_register_shortcodes', 'lekker_core_add_image_with_text_shortcode' );
}

if ( class_exists( 'LekkerCoreShortcode' ) ) {
	class LekkerCoreImageWithTextShortcode extends LekkerCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'lekker_core_filter_image_with_text_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'lekker_core_filter_image_with_text_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( LEKKER_CORE_SHORTCODES_URL_PATH . '/image-with-text' );
			$this->set_base( 'lekker_core_image_with_text' );
			$this->set_name( esc_html__( 'Image With Text', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image with text element', 'lekker-core' ) );
			$this->set_category( esc_html__( 'Lekker Core', 'lekker-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'lekker-core' ),
			) );
			
			$options_map = lekker_core_get_variations_options_map( $this->get_layouts() );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'lekker-core' ),
				'options'		=> $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'lekker-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'image_size',
				'title'      => esc_html__( 'Image Size', 'lekker-core' ),
				'description'=> esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'lekker-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_action',
				'title'         => esc_html__( 'Image Action', 'lekker-core' ),
				'options'       => array(
					''            => esc_html__( 'No Action', 'lekker-core' ),
					'open-popup'  => esc_html__( 'Open Popup', 'lekker-core' ),
					'custom-link' => esc_html__( 'Custom Link', 'lekker-core' ),
					'scrolling-image' => esc_html__( 'Scrolling Image', 'lekker-core' ),
				)
			) );
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => 'scrolling_direction',
				'title'       => esc_html__( 'Scrolling Direction', 'lekker-core' ),
				'options'     => array(
					'vertical' 	 => esc_html__( 'Vertical', 'lekker-core' ),
					'horizontal' => esc_html__( 'Horizontal', 'lekker-core' ),
				),
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'scrolling-image' ,
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Custom Link', 'lekker-core' ),
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => array( 'custom-link', 'scrolling-image' ),
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'lekker-core' ),
				'options'       => lekker_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => array( 'custom-link', 'scrolling-image' ),
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'hover_image',
				'title'      => esc_html__( 'Enable Hover Image', 'lekker-core' ),
				'options'    => lekker_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				)
			) );

			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'second_image',
				'title'      => esc_html__( 'Hover Image', 'lekker-core' ),
				'dependency' => array(
					'show' => array(
						'hover_image' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'outline_image',
				'title'      => esc_html__( 'Enable Image Outline', 'lekker-core' ),
				'options'    => lekker_core_get_select_type_options_pool( 'yes_no' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'lekker-core' ),
				'group'      => esc_html__( 'Content', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'lekker-core' ),
				'options'       => lekker_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h5',
				'group'         => esc_html__( 'Content', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'lekker-core' ),
				'group'      => esc_html__( 'Content', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'lekker-core' ),
				'group'      => esc_html__( 'Content', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'lekker-core' ),
				'group'      => esc_html__( 'Content', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'lekker-core' ),
				'group'      => esc_html__( 'Content', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'lekker-core' ),
				'group'      => esc_html__( 'Content', 'lekker-core' )
			) );

			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'lekker_core_image_with_text', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['image_params']   = $this->generate_image_params( $atts );
			
			return lekker_core_get_template_part( 'shortcodes/image-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-image-with-text';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[]  = $atts['outline_image'] === 'yes' ? 'qodef-outline-image' : '';
			$holder_classes[]  = $atts['hover_image'] === 'yes' ? 'qodef-second-image' : '';
			$holder_classes[] = ! empty ( $atts['image_action'] ) ? 'qodef-image-action--' . $atts['image_action'] : '';
			$holder_classes[] = ! empty ( $atts['scrolling_direction'] ) ? 'qodef-scrolling-direction--' . $atts['scrolling_direction'] : '';

			return implode( ' ', $holder_classes );
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( $atts['title_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( $atts['text_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}
			
			return $styles;
		}
		
		private function generate_image_params( $atts ) {
			$image = array();
			
			if ( ! empty( $atts['image'] ) ) {
				$id = $atts['image'];
				
				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = $image_original[0];
				$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
				
				$image_size = trim( $atts['image_size'] );
				preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
				if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
					$image['image_size'] = $image_size;
				} elseif ( ! empty( $matches[0] ) ) {
					$image['image_size'] = array(
						$matches[0][0],
						$matches[0][1]
					);
				} else {
					$image['image_size'] = 'full';
				}
			}
			
			return $image;
		}
	}
}