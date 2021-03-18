<?php

if ( ! function_exists( 'lekker_core_add_vertical_header_meta' ) ) {
	function lekker_core_add_vertical_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_vertical_header_section',
				'title'      => esc_html__( 'Vertical Header', 'lekker-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'vertical',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'lekker-core' ),
				'description' => esc_html__( 'Enter header background color', 'lekker-core' )
			)
		);

	}
	
	add_action( 'lekker_core_action_after_page_header_meta_map', 'lekker_core_add_vertical_header_meta' );
}