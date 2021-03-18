<?php

if ( ! function_exists( 'lekker_core_add_progress_bar_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function lekker_core_add_progress_bar_shortcode( $shortcodes ) {
		$shortcodes[] = 'LekkerCoreProgressBarShortcode';

		return $shortcodes;
	}

	add_filter( 'lekker_core_filter_register_shortcodes', 'lekker_core_add_progress_bar_shortcode' );
}

if ( class_exists( 'LekkerCoreShortcode' ) ) {
	class LekkerCoreProgressBarShortcode extends LekkerCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( LEKKER_CORE_SHORTCODES_URL_PATH . '/progress-bar' );
			$this->set_base( 'lekker_core_progress_bar' );
			$this->set_name( esc_html__( 'Progress Bar', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays progress bar with provided parameters', 'lekker-core' ) );
			$this->set_category( esc_html__( 'Lekker Core', 'lekker-core' ) );
			$this->set_scripts(
				array(
					'progress-bar-line' => array(
						'registered'	=> false,
						'url'			=> LEKKER_CORE_INC_URL_PATH . '/shortcodes/progress-bar/assets/js/plugins/jquery.lineProgressbar.js',
						'dependency'	=> array( 'jquery' )
					),
					'progress-bar-circle' => array(
						'registered'	=> false,
						'url'			=> LEKKER_CORE_INC_URL_PATH . '/shortcodes/progress-bar/assets/js/plugins/progressbar.min.js',
						'dependency'	=> array( 'jquery' )
					)
				)
			);
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'lekker-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'lekker-core' ),
				'options'       => array(
					'circle'      => esc_html__( 'Circle', 'lekker-core' ),
					'semi-circle' => esc_html__( 'Semi Circle', 'lekker-core' ),
					'line'        => esc_html__( 'Line', 'lekker-core' ),
					'custom'      => esc_html__( 'Custom', 'lekker-core' )
				),
				'default_value' => 'circle'
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'custom_shape',
				'title'      => esc_html__( 'Custom Shape (SVG code)', 'lekker-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'custom',
							'default_value' => '_self'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_shape_id',
				'title'      => esc_html__( 'Custom Shape ID', 'lekker-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'custom',
							'default_value' => 'circle'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'active_line_color',
				'title'      => esc_html__( 'Active Line Color', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'active_line_width',
				'title'       => esc_html__( 'Active Line Width', 'lekker-core' ),
				'description' => esc_html__( 'Enter width for active line without unit. Default value is 4 (1 is equal 3.59px for circle and custom type)', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'inactive_line_color',
				'title'      => esc_html__( 'Inactive Color', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'inactive_line_width',
				'title'       => esc_html__( 'Inactive Line Width', 'lekker-core' ),
				'description' => esc_html__( 'Enter width for inactive line without unit. Default value is 4 (1 is equal 3.59px for circle and custom type)', 'lekker-core' ),
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'number',
				'title'       => esc_html__( 'Percentage Number', 'lekker-core' ),
				'description' => esc_html__( 'Enter percentage number for progress bar', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'number_color',
				'title'      => esc_html__( 'Number Color', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'lekker-core' ),
				'options'       => lekker_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h5'
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'lekker-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'title_margin',
				'title'       => esc_html__( 'Title Margin', 'lekker-core' ),
				'description' => esc_html__( 'If you selected a progress bar layout other than line this option corresponds to the margin top; in the event line layout type is selected, the option corresponds to the margin bottom.', 'lekker-core' )
			) );
		}

		public function load_assets() {
			$atts = $this->get_atts();
			if( $atts['layout'] == 'line' ) {
				wp_enqueue_script('progress-bar-line');
			} else {
				wp_enqueue_script( 'progress-bar-circle');
			}
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['rand_number']    = rand( 0, 1000 );
			$atts['data_attrs']     = $this->get_data_attrs( $atts );

			return lekker_core_get_template_part( 'shortcodes/progress-bar', 'templates/progress-bar', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-progress-bar';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['layout'] ) ) {
				$data['data-layout'] = $atts['layout'];
			}

			$data['data-active-line-color'] = ! empty( $atts['active_line_color'] ) ? $atts['active_line_color'] : '#000';
			$data['data-active-line-width'] = ! empty( $atts['active_line_width'] ) ? $atts['active_line_width'] : 4;

			$data['data-inactive-line-color'] = ! empty( $atts['inactive_line_color'] ) ? $atts['inactive_line_color'] : '#e1e1e1';
			$data['data-inactive-line-width'] = ! empty( $atts['inactive_line_width'] ) ? $atts['inactive_line_width'] : 4;

			$data['data-text-color'] = ! empty( $atts['number_color'] ) ? $atts['number_color'] : '#000';

			$data['data-number']          = ! empty( $atts['number'] ) ? $atts['number'] : '';
			$data['data-rand-number']     = ! empty( $atts['rand_number'] ) ? $atts['rand_number'] : 100;
			$data['data-custom-shape-id'] = ! empty( $atts['custom_shape_id'] ) ? $atts['custom_shape_id'] : '';

			return $data;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( $atts['title_margin'] !== '' ) {
				if ( $atts['layout'] === 'line' ) {
					$styles[] = 'margin-bottom: ' . intval( $atts['title_margin'] ) . 'px';
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin'] ) . 'px';
				}
			}

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}
	}
}