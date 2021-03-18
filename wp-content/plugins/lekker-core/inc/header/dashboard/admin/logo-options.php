<?php

if ( ! function_exists( 'lekker_core_add_logo_options' ) ) {
	function lekker_core_add_logo_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => LEKKER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'lekker-core' ),
				'description' => esc_html__( 'Global Logo Options', 'lekker-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Logo Options', 'lekker-core' ),
					'description' => esc_html__( 'Set options for initial headers', 'lekker-core' )
				)
			);

			$header_tab->add_field_element(
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

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_main',
					'title'         => esc_html__( 'Logo - Main', 'lekker-core' ),
					'description'   => esc_html__( 'Choose main logo image', 'lekker-core' ),
					'default_value' => defined( 'LEKKER_ASSETS_ROOT' ) ? LEKKER_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'      => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'lekker-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'lekker-core' ),
					'multiple'    => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'lekker-core' ),
					'description' => esc_html__( 'Choose light logo image', 'lekker-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_header_logo_options_map', $page, $header_tab );
		}
	}

	add_action( 'lekker_core_action_default_options_init', 'lekker_core_add_logo_options', lekker_core_get_admin_options_map_position( 'logo' ) );
}