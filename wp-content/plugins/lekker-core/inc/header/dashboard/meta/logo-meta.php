<?php

if ( ! function_exists( 'lekker_core_add_page_logo_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function lekker_core_add_page_logo_meta_box( $page ) {

		if ( $page ) {

			$logo_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-logo',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Logo Settings', 'lekker-core' ),
					'description' => esc_html__( 'Logo settings', 'lekker-core' )
				)
			);

			$header_logo_section = $logo_tab->add_section_element(
				array(
					'name'  => 'qodef_header_logo_section',
					'title' => esc_html__( 'Header Logo Options', 'lekker-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'lekker-core' ),
					'description' => esc_html__( 'Enter logo height', 'lekker-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'lekker-core' )
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_main',
					'title'       => esc_html__( 'Logo - Main', 'lekker-core' ),
					'description' => esc_html__( 'Choose main logo image', 'lekker-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'lekker-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'lekker-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'lekker-core' ),
					'description' => esc_html__( 'Choose light logo image', 'lekker-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_page_logo_meta_map', $logo_tab, $header_logo_section );
		}
	}

	add_action( 'lekker_core_action_after_general_meta_box_map', 'lekker_core_add_page_logo_meta_box' );
	add_action( 'lekker_core_action_after_portfolio_meta_box_map', 'lekker_core_add_page_logo_meta_box' );
}