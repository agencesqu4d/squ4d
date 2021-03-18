<?php

if ( ! function_exists( 'lekker_core_add_top_area_options' ) ) {
	function lekker_core_add_top_area_options( $page, $general_header_tab ) {

		$top_area_section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_top_area_section',
				'title'       => esc_html__( 'Top Area', 'lekker-core' ),
				'description' => esc_html__( 'Options related to top area', 'lekker-core' ),
				'dependency'  => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values'        => lekker_core_dependency_for_top_area_options(),
							'default_value' => apply_filters( 'lekker_core_filter_header_layout_default_option_value', '' )
						)
					)
				)
			)
		);

		$top_area_section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_top_area_header',
				'title'         => esc_html__( 'Top Area', 'lekker-core' ),
				'description'   => esc_html__( 'Enable top area', 'lekker-core' )
			)
		);

		$top_area_options_section = $top_area_section->add_section_element(
			array(
				'name'        => 'qodef_top_area_options_section',
				'title'       => esc_html__( 'Top Area Options', 'lekker-core' ),
				'description' => esc_html__( 'Set desired values for top area', 'lekker-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_top_area_header' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_background_color',
				'title'       => esc_html__( 'Top Area Background Color', 'lekker-core' ),
				'description' => esc_html__( 'Choose top area background color', 'lekker-core' )
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_height',
				'title'       => esc_html__( 'Top Area Height', 'lekker-core' ),
				'description' => esc_html__( 'Enter top area height (default is 30px)', 'lekker-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'lekker-core' )
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type' => 'text',
				'name'       => 'qodef_top_area_header_side_padding',
				'title'      => esc_html__( 'Top Area Side Padding', 'lekker-core' ),
				'args'       => array(
					'suffix' => esc_html__( 'px or %', 'lekker-core' )
				)
			)
		);
	}

	add_action( 'lekker_core_action_after_header_options_map', 'lekker_core_add_top_area_options', 20, 2 );
}