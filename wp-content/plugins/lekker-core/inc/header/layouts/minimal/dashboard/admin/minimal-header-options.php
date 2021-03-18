<?php

if ( ! function_exists( 'lekker_core_add_minimal_header_options' ) ) {
	function lekker_core_add_minimal_header_options( $page, $general_header_tab ) {
		
		$section = $general_header_tab->add_section_element(
			array(
				'name'       => 'qodef_minimal_header_section',
				'title'      => esc_html__( 'Minimal Header', 'lekker-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_minimal_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'lekker-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'lekker-core' ),
				'default_value' => 'no',
				'args'          => array(
					'suffix' => esc_html__( 'px', 'lekker-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_height',
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
				'name'        => 'qodef_minimal_header_side_padding',
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
				'name'        => 'qodef_minimal_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'lekker-core' ),
				'description' => esc_html__( 'Enter header background color', 'lekker-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'lekker-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'    => 'image',
				'name'          => 'qodef_minimal_header_background_image',
				'title'         => esc_html__( 'Header Background Image', 'lekker-core' ),
				'description'   => esc_html__( 'Choose header background image', 'lekker-core' ),
				'multiple'      => 'no'
			)
		);
		
	}
	
	add_action( 'lekker_core_action_after_header_options_map', 'lekker_core_add_minimal_header_options', 10, 2 );
}