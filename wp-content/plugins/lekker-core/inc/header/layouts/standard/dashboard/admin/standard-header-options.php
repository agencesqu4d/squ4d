<?php

if ( ! function_exists( 'lekker_core_add_standard_header_options' ) ) {
	function lekker_core_add_standard_header_options( $page, $general_header_tab ) {
		
		$section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_standard_header_section',
				'title'       => esc_html__( 'Standard Header', 'lekker-core' ),
				'description' => esc_html__( 'Standard header settings', 'lekker-core' ),
				'dependency'  => array(
					'show'    => array(
						'qodef_header_layout' => array(
							'values' => 'standard',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'yesno',
				'name'        => 'qodef_standard_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'lekker-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'lekker-core' ),
				'default_value' => 'no',
				'args'        => array(
					'suffix' => esc_html__( 'px', 'lekker-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'lekker-core' ),
				'description' => esc_html__( 'Enter header height', 'lekker-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'lekker-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'lekker-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'lekker-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'lekker-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'lekker-core' ),
				'description' => esc_html__( 'Enter header background color', 'lekker-core' )
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'lekker-core' ),
				'default_value' => 'right',
				'options'       => array(
					'left'   => esc_html__( 'Left', 'lekker-core' ),
					'center' => esc_html__( 'Center', 'lekker-core' ),
					'right'  => esc_html__( 'Right', 'lekker-core' ),
				)
			)
		);
	}
	
	add_action( 'lekker_core_action_after_header_options_map', 'lekker_core_add_standard_header_options', 10, 2 );
}