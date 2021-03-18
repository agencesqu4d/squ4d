<?php

if ( ! function_exists( 'lekker_core_add_minimal_mobile_header_options' ) ) {
	function lekker_core_add_minimal_mobile_header_options( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'lekker-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Minimal Height', 'lekker-core' ),
				'description' => esc_html__( 'Enter header height', 'lekker-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'lekker-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'lekker-core' ),
				'description' => esc_html__( 'Enter header background color', 'lekker-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'lekker-core' )
				)
			)
		);
	}
	
	add_action( 'lekker_core_action_after_mobile_header_options_map', 'lekker_core_add_minimal_mobile_header_options' );
}