<?php

if ( ! function_exists( 'lekker_core_add_portfolio_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function lekker_core_add_portfolio_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'LekkerCorePortfolioListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'lekker_core_filter_register_shortcodes', 'lekker_core_add_portfolio_list_shortcode' );
}

if ( class_exists( 'LekkerCoreListShortcode' ) ) {
	class LekkerCorePortfolioListShortcode extends LekkerCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			$this->set_layouts( apply_filters( 'lekker_core_filter_portfolio_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'lekker_core_filter_portfolio_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'lekker_core_filter_portfolio_list_hover_animation_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( LEKKER_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list' );
			$this->set_base( 'lekker_core_portfolio_list' );
			$this->set_name( esc_html__( 'Portfolio List', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of portfolios', 'lekker-core' ) );
			$this->set_category( esc_html__( 'Lekker Core', 'lekker-core' ) );
			$this->set_scripts(
				apply_filters( 'lekker_core_filter_portfolio_list_register_assets', array() )
			);
			
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'lekker-core' )
			) );
			
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => 'custom_sliders',
				'title'       => esc_html__( 'Predefined Sliders', 'lekker-core' ),
				'options'     => array(
					''                => esc_html__( 'Default', 'lekker-core' ),
					'vertical-split'  => esc_html__( 'Vertical Split', 'lekker-core' ),
					'horizontal-full' => esc_html__( 'Horizontal Full', 'lekker-core' ),
				),
				'description' => esc_html__('This will ignore some of the default settings below (Number of columns, etc.', 'lekker-core' ),
				'dependency'  => array(
					'show' => array(
						'behavior' => array(
							'values'        => 'slider',
							'default_value' => 'no'
						)
					)
				),
			) );
			
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'predefined_filter',
				'title'      => esc_html__( 'Predefined Filter', 'lekker-core' ),
				'options'    => lekker_core_get_select_type_options_pool( 'no_yes', false ),
			) );
			
			$this->map_list_options();
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array(
				'layouts'          => $this->get_layouts(),
				'hover_animations' => $this->get_hover_animation_options()
			) );
			
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => 'content_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'lekker-core' ),
				'options'     => array(
					'yes'        => esc_html__( 'Yes', 'lekker-core' ),
					'no' 		 => esc_html__( 'No', 'lekker-core' ),
				),
				'dependency'  => array(
					'show' => array(
						'custom_sliders' => array(
							'values'        => 'vertical-split',
							'default_value' => ''
						)
					)
				),
				'group'         => esc_html__( 'Layout', 'lekker-core' ),
			) );
			if ( empty( $exclude_option ) || ( ! empty( $exclude_option ) && ! in_array( 'custom_padding', $exclude_option ) ) ) {
				$this->set_option( array(
					'field_type'    => 'select',
					'name'          => 'custom_padding',
					'title'         => esc_html__( 'Use Item Custom Padding', 'lekker-core' ),
					'group'         => esc_html__( 'Layout', 'lekker-core' ),
					'default_value' => 'no',
					'options'       => lekker_core_get_select_type_options_pool( 'no_yes', false ),
					'dependency'    => array(
						'hide' => array(
							'layout' => array(
								'values' => 'info-on-side'
							)
						)
					)
				) );
			}
			$this->map_additional_options();
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'lekker_core_portfolio_list', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function set_custom_assets() {
			$atts = $this->get_atts();
			
			if ( $atts['custom_sliders'] === 'horizontal-centered' ) {
				$this->set_single_att( 'layout', 'info-below' );
				$this->set_single_att( 'title_tag', 'h5' );
				$this->set_single_att( 'space', 'no' );
				$this->set_single_att( 'slider_pagination', 'no' );
			}
		}
		
		public function load_assets() {
			$this->set_custom_assets();
			
			parent::load_assets();
			
			do_action( 'lekker_core_action_portfolio_list_load_assets', $this->get_atts() );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();
			
			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['query_result']   = new \WP_Query( lekker_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['data_attr']      = lekker_core_get_pagination_data( LEKKER_CORE_REL_PATH, 'post-types/portfolio/shortcodes', 'portfolio-list', 'portfolio', $atts );
			
			$atts['this_shortcode'] = $this;
			
			return lekker_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-portfolio-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['custom_sliders'] ) ? 'qodef-predefined-sliders--' . $atts['custom_sliders'] : '';
			$holder_classes[] = ! empty( $atts['predefined_filter'] ) ? 'qodef-predefined-filter--' . $atts['predefined_filter'] : '';
			
			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			$additional_classes = array();
			$item_light_class     = get_post_meta( get_the_ID(), 'qodef_portfolio_list_light_text', true );
			$additional_classes[] = ! ( empty( $item_light_class ) ) ? 'qodef-item-light--' . $item_light_class : '';
			$additional_classes[] = ( $atts['content_in_grid'] == 'yes') ? 'qodef-content-grid' : '';
			
			$item_classes = array_merge( $item_classes, $additional_classes );
			
			return implode( ' ', $item_classes );
		}
		
		public function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}
			
			return $styles;
		}
		
		public function get_list_item_style( $atts ) {
			$styles = array();
			
			if ( isset( $atts['custom_padding'] ) && $atts['custom_padding'] == 'yes' ) {
				$styles[] = 'padding: ' . get_post_meta( get_the_ID(), "qodef_portfolio_item_padding", true );
			}
			
			return $styles;
		}
	}
}