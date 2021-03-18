<?php

if ( ! function_exists( 'lekker_core_nav_menu_meta_options' ) ) {
	function lekker_core_nav_menu_meta_options( $page ) {
		
		if ( $page ) {
			
			$section = $page->add_section_element(
				array(
					'name'  => 'qodef_nav_menu_section',
					'title' => esc_html__( 'Main Menu', 'lekker-core' )
				)
			);
			
			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_dropdown_top_position',
					'title'       => esc_html__( 'Dropdown Position', 'lekker-core' ),
					'description' => esc_html__( 'Enter value in percentage of entire header height', 'lekker-core' ),
				)
			);
			$section->add_field_element(
				array(
					'field_type'    => 'color',
					'name'          => 'qodef_dropdown_wide_background_color',
					'title'         => esc_html__( 'Wide Dropdown Background Color', 'lekker-core' ),
					'default_value' => ''
				)
			);
		}
	}
	
	add_action( 'lekker_core_action_after_page_header_meta_map', 'lekker_core_nav_menu_meta_options' );
}