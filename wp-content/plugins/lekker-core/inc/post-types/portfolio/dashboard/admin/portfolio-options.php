<?php

if ( ! function_exists( 'lekker_core_add_portfolio_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function lekker_core_add_portfolio_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => LEKKER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'portfolio-item',
				'layout'      => 'tabbed',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Portfolio', 'lekker-core' ),
				'description' => esc_html__( 'Global settings related to portfolio', 'lekker-core' )
			)
		);

		if ( $page ) {
			$archive_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-archive',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Portfolio List', 'lekker-core' ),
					'description' => esc_html__( 'Settings related to portfolio archive pages', 'lekker-core' )
				)
			);

			// Hook to include additional options after archive module options
			do_action( 'lekker_core_action_after_portfolio_options_archive', $archive_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Portfolio Single', 'lekker-core' ),
					'description' => esc_html__( 'Settings related to portfolio single pages', 'lekker-core' )
				)
			);
			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_layout',
					'title'         => esc_html__( 'Single Layout', 'lekker-core' ),
					'description'   => esc_html__( 'Choose default layout for portfolio single', 'lekker-core' ),
					'default_value' => apply_filters( 'lekker_core_filter_portfolio_single_layout_default_value', '' ),
					'options'       => apply_filters( 'lekker_core_filter_portfolio_single_layout_options', array() )
				)
			);

			// Hook to include additional options after single module options
			do_action( 'lekker_core_action_after_portfolio_options_single', $single_tab );

			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_portfolio_options_map', $page );
		}
	}

	add_action( 'lekker_core_action_default_options_init', 'lekker_core_add_portfolio_options', lekker_core_get_admin_options_map_position( 'portfolio' ) );
}