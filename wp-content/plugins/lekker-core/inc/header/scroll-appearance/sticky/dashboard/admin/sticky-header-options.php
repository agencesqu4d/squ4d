<?php

if ( ! function_exists( 'lekker_core_add_sticky_header_options' ) ) {
	function lekker_core_add_sticky_header_options( $page, $section ) {

		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_sticky_header_skin',
				'title'       => esc_html__( 'Sticky Header Skin', 'lekker-core' ),
				'description' => esc_html__( 'Choose a predefined sticky header style for header elements', 'lekker-core' ),
				'options'     => array(
					'none'  => esc_html__( 'None', 'lekker-core' ),
					'light' => esc_html__( 'Light', 'lekker-core' ),
					'dark'  => esc_html__( 'Dark', 'lekker-core' ),
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => '',
						),
					),
				),
			)
		);


		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_scroll_amount',
				'title'       => esc_html__( 'Sticky Scroll Amount', 'lekker-core' ),
				'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'lekker-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'lekker-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_side_padding',
				'title'       => esc_html__( 'Sticky Header Side Padding', 'lekker-core' ),
				'description' => esc_html__( 'Enter side padding for sticky header area', 'lekker-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'lekker-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_sticky_header_background_color',
				'title'       => esc_html__( 'Sticky Header Background Color', 'lekker-core' ),
				'description' => esc_html__( 'Enter sticky header background color', 'lekker-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
	}
	
	add_action( 'lekker_core_action_after_header_scroll_appearance_options_map', 'lekker_core_add_sticky_header_options', 10, 2 );
}

if ( ! function_exists( 'lekker_core_add_sticky_header_logo_options' ) ) {
	function lekker_core_add_sticky_header_logo_options( $page, $header_tab ) {
		
		if ( $header_tab ) {
			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_sticky',
					'title'       => esc_html__( 'Logo - Sticky', 'lekker-core' ),
					'description' => esc_html__( 'Choose sticky logo image', 'lekker-core' ),
					'multiple'    => 'no'
				)
			);
		}
	}
	
	add_action( 'lekker_core_action_after_header_logo_options_map', 'lekker_core_add_sticky_header_logo_options', 10, 2 );
}