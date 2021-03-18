<?php

if ( ! function_exists( 'lekker_core_add_team_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function lekker_core_add_team_options() {
		$qode_framework = qode_framework_get_framework_root();
		$has_single     = lekker_core_team_has_single();

		if ( $has_single ) {

			$page = $qode_framework->add_options_page( array(
				'scope'       => LEKKER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'team',
				'layout'      => 'tabbed',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Team', 'lekker-core' ),
				'description' => esc_html__( 'Global Team Options', 'lekker-core' )
			) );

			if ( $page ) {
				$archive_tab = $page->add_tab_element( array(
					'name'        => 'tab-archive',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Archive Settings', 'lekker-core' ),
					'description' => esc_html__( 'Settings related to team archive pages', 'lekker-core' )
				) );

				do_action( 'lekker_core_action_after_team_options_archive', $archive_tab );

				$single_tab = $page->add_tab_element( array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Single Settings', 'lekker-core' ),
					'description' => esc_html__( 'Settings related to team single pages', 'lekker-core' )
				) );

				$single_tab->add_field_element( array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_single_layout',
					'title'       => esc_html__( 'Single Layout', 'lekker-core' ),
					'description' => esc_html__( 'Choose default layout for team single', 'lekker-core' ),
					'options'     => array(
						'' => esc_html__( 'Default', 'lekker-core' )
					)
				) );

				do_action( 'lekker_core_action_after_team_options_single', $single_tab );

				// Hook to include additional options after module options
				do_action( 'lekker_core_action_after_team_options_map', $page );
			}
		}
	}

	add_action( 'lekker_core_action_default_options_init', 'lekker_core_add_team_options', lekker_core_get_admin_options_map_position( 'team' ) );
}