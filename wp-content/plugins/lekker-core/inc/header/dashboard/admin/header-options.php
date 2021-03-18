<?php

if ( ! function_exists( 'lekker_core_add_header_options' ) ) {
	/**
	 * Function that add header options for this module
	 */
	function lekker_core_add_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => LEKKER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Header', 'lekker-core' ),
				'description' => esc_html__( 'Global Header Options', 'lekker-core' )
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'lekker-core' )
				)
			);
			
			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_header_layout',
					'title'         => esc_html__( 'Header Layout', 'lekker-core' ),
					'description'   => esc_html__( 'Choose a header layout to set for your website', 'lekker-core' ),
					'args'          => array( 'images' => true ),
					'options'       => apply_filters( 'lekker_core_filter_header_layout_option', $header_layout_options = array() ),
					'default_value' => apply_filters( 'lekker_core_filter_header_layout_default_option_value', '' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'lekker-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'lekker-core' ),
					'options'     => array(
						'none'  => esc_html__( 'None', 'lekker-core' ),
						'light' => esc_html__( 'Light', 'lekker-core' ),
						'dark'  => esc_html__( 'Dark', 'lekker-core' )
					)
				)
			);

			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'lekker_core_action_default_options_init', 'lekker_core_add_header_options', lekker_core_get_admin_options_map_position( 'header' ) );
}