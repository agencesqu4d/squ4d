<?php

if ( ! function_exists( 'lekker_core_fullscreen_menu_typography_options' ) ) {
	function lekker_core_fullscreen_menu_typography_options( $page ) {

		if ( $page ) {

			$typography_section = $page->add_section_element(
				array(
					'name'  => 'qodef_fullscreen_typography_section',
					'title' => esc_html__( 'Fullscreen Menu Typography', 'lekker-core' )
				)
			);

			$first_level_typography_row = $typography_section->add_row_element(
				array(
					'name'  => 'qodef_first_level_typography_row',
					'title' => esc_html__( 'Menu First Level Typography', 'lekker-core' )
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_1st_lvl_color',
					'title'      => esc_html__( 'Color', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_1st_lvl_hover_color',
					'title'      => esc_html__( 'Hover Color', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_1st_lvl_active_color',
					'title'      => esc_html__( 'Active Color', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_fullscreen_1st_lvl_font_family',
					'title'      => esc_html__( 'Font Family', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_font_size',
					'title'      => esc_html__( 'Font Size', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_line_height',
					'title'      => esc_html__( 'Line Height', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_1st_lvl_font_weight',
					'title'      => esc_html__( 'Font Weight', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);
			
			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_1st_lvl_text_transform',
					'title'      => esc_html__( 'Text Transform', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);
			
			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_1st_lvl_font_style',
					'title'      => esc_html__( 'Font Style', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);
			
			$second_level_typography_row = $typography_section->add_row_element(
				array(
					'name'  => 'qodef_second_level_typography_row',
					'title' => esc_html__( 'Menu Second Level Typography', 'lekker-core' )
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_2nd_lvl_color',
					'title'      => esc_html__( 'Color', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_2nd_lvl_hover_color',
					'title'      => esc_html__( 'Hover Color', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_2nd_lvl_active_color',
					'title'      => esc_html__( 'Active Color', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_fullscreen_2nd_lvl_font_family',
					'title'      => esc_html__( 'Font Family', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_2nd_lvl_font_size',
					'title'      => esc_html__( 'Font Size', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_2nd_lvl_line_height',
					'title'      => esc_html__( 'Line Height', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_2nd_lvl_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'lekker-core' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_2nd_lvl_font_weight',
					'title'      => esc_html__( 'Font Weight', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);
			
			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_2nd_lvl_text_transform',
					'title'      => esc_html__( 'Text Transform', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);
			
			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_2nd_lvl_font_style',
					'title'      => esc_html__( 'Font Style', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3
					)
				)
			);
		}
	}

	add_action( 'lekker_core_action_after_fullscreen_menu_options_map', 'lekker_core_fullscreen_menu_typography_options', 15 );
}