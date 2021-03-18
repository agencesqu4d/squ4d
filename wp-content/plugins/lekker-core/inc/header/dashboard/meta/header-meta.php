<?php

if ( ! function_exists( 'lekker_core_add_page_header_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function lekker_core_add_page_header_meta_box( $page ) {

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Settings', 'lekker-core' ),
					'description' => esc_html__( 'Header layout settings', 'lekker-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_layout',
					'title'       => esc_html__( 'Header Layout', 'lekker-core' ),
					'description' => esc_html__( 'Choose a header layout to set for your website', 'lekker-core' ),
					'args'        => array( 'images' => true ),
					'options'     => lekker_core_header_radio_to_select_options( apply_filters( 'lekker_core_filter_header_layout_option', $header_layout_options = array() ) )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'lekker-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'lekker-core' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'lekker-core' ),
						'none'  => esc_html__( 'None', 'lekker-core' ),
						'light' => esc_html__( 'Light', 'lekker-core' ),
						'dark'  => esc_html__( 'Dark', 'lekker-core' )
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_header_widget_areas',
					'title'         => esc_html__( 'Show Header Widget Areas', 'lekker-core' ),
					'description'   => esc_html__( 'Choose if you want to show or hide header widget areas', 'lekker-core' ),
					'default_value' => 'yes'
				)
			);

			$custom_sidebars = lekker_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {

				$section = $header_tab->add_section_element(
					array(
						'name'       => 'qodef_header_custom_widget_area_section',
						'dependency' => array(
							'show' => array(
								'qodef_show_header_widget_areas' => array(
									'values'        => 'yes',
									'default_value' => 'yes'
								)
							)
						)
					)
				);
				
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_one',
						'title'       => esc_html__( 'Choose Custom Header Widget Area One', 'lekker-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'lekker-core' ),
						'options'     => $custom_sidebars
					)
				);
				
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_two',
						'title'       => esc_html__( 'Choose Custom Header Widget Area Two', 'lekker-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'lekker-core' ),
						'options'     => $custom_sidebars
					)
				);
				
				// Hook to include additional options after module options
				do_action( 'lekker_core_action_after_custom_widget_area_header_meta_map', $section, $custom_sidebars );
			}

			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_page_header_meta_map', $header_tab, $custom_sidebars );
		}
	}

	add_action( 'lekker_core_action_after_general_meta_box_map', 'lekker_core_add_page_header_meta_box' );
	add_action( 'lekker_core_action_after_portfolio_meta_box_map', 'lekker_core_add_page_header_meta_box' );
}