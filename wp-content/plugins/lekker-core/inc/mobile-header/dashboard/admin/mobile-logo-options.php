<?php

if ( ! function_exists( 'lekker_core_add_mobile_logo_options' ) ) {
	/**
	 * Function that add mobile header options for this module
	 */
	function lekker_core_add_mobile_logo_options( $page, $header_tab ) {

		if ( $page ) {
			
			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Logo Options', 'lekker-core' ),
					'description' => esc_html__( 'Set options for mobile headers', 'lekker-core' )
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_height',
					'title'       => esc_html__( 'Mobile Logo Height', 'lekker-core' ),
					'description' => esc_html__( 'Enter mobile logo height', 'lekker-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'lekker-core' )
					)
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_mobile_logo_main',
					'title'       => esc_html__( 'Mobile Logo - Main', 'lekker-core' ),
					'description' => esc_html__( 'Choose main mobile logo image', 'lekker-core' ),
					'default_value' => defined( 'LEKKER_ASSETS_ROOT' ) ? LEKKER_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'    => 'no'
				)
			);
			
			do_action( 'lekker_core_action_after_mobile_logo_options_map', $page );
		}
	}
	
	add_action( 'lekker_core_action_after_header_logo_options_map', 'lekker_core_add_mobile_logo_options', 10, 2 );
}