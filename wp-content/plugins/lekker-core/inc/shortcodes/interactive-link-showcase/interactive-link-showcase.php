<?php

if ( ! function_exists( 'lekker_core_add_interactive_link_showcase_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function lekker_core_add_interactive_link_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'LekkerCoreInteractiveLinkShowcaseShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'lekker_core_filter_register_shortcodes', 'lekker_core_add_interactive_link_showcase_shortcode' );
}

if ( class_exists( 'LekkerCoreShortcode' ) ) {
	class LekkerCoreInteractiveLinkShowcaseShortcode extends LekkerCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'lekker_core_filter_interactive_link_showcase_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'lekker_core_filter_interactive_link_showcase_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( LEKKER_CORE_SHORTCODES_URL_PATH . '/interactive-link-showcase' );
			$this->set_base( 'lekker_core_interactive_link_showcase' );
			$this->set_name( esc_html__( 'Interactive Link Showcase', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds interactive link showcase holder', 'lekker-core' ) );
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
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Link Skin', 'lekker-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'lekker-core' ),
					'light' => esc_html__( 'Light', 'lekker-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'background_color',
				'title'      => esc_html__( 'Background Color', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'lekker-core' ),
				'options'       => lekker_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Child elements', 'lekker-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'item_link',
						'title'         => esc_html__( 'Link', 'lekker-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_title',
						'title'      => esc_html__( 'Title', 'lekker-core' )
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Image', 'lekker-core' ),
						'multiple'   => 'yes'
					)
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode'] = $this;
			
			return lekker_core_get_template_part( 'shortcodes/interactive-link-showcase', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-interactive-link-showcase';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_holder_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['background_color'];
			}
			
			return $styles;
		}
		
		public function get_image_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['item_image'] ) ) {
				$styles[] = 'background-image: url(' . esc_url( wp_get_attachment_url( $atts['item_image'] ) ) . ')';
			}
			
			return $styles;
		}
	}
}