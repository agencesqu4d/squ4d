<?php

if ( ! function_exists( 'lekker_core_add_mobile_header_options' ) ) {
	/**
	 * Function that add mobile header options for this module
	 */
	function lekker_core_add_mobile_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => LEKKER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'mobile-header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Mobile Header', 'lekker-core' ),
				'description' => esc_html__( 'Global Mobile Header Options', 'lekker-core' )
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'no',
					'name'          => 'qodef_mobile_header_scroll_appearance',
					'title'         => esc_html__( 'Sticky Mobile Header', 'lekker-core' ),
					'description'   => esc_html__( 'Set mobile header to be sticky', 'lekker-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_mobile_header_layout',
					'title'         => esc_html__( 'Mobile Header Layout', 'lekker-core' ),
					'description'   => esc_html__( 'Choose a mobile header layout to set for your website', 'lekker-core' ),
					'args'          => array( 'images' => true ),
					'default_value' => apply_filters( 'lekker_core_filter_mobile_header_layout_default_option', '' ),
					'options'       => apply_filters( 'lekker_core_filter_mobile_header_layout_option', $mobile_header_layout_options = array() )
				)
			);

			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_mobile_header_options_map', $page );
		}
	}

	add_action( 'lekker_core_action_default_options_init', 'lekker_core_add_mobile_header_options', lekker_core_get_admin_options_map_position( 'mobile-header' ) );
}