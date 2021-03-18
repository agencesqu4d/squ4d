<?php

if ( ! function_exists( 'lekker_core_add_portfolio_title_options' ) ) {
	/**
	 * Function that add title options for portfolio module
	 */
	function lekker_core_add_portfolio_title_options( $tab ) {
		
		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_enable_portfolio_title',
					'title'         => esc_html__( 'Enable Title on Portfolio Single', 'lekker-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable portfolio single title', 'lekker-core' ),
					'options'       => lekker_core_get_select_type_options_pool( 'yes_no' )
				)
			);
			
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_portfolio_title_area_in_grid',
					'title'         => esc_html__( 'Portfolio Title in Grid', 'lekker-core' ),
					'description'   => esc_html__( 'Enabling this option will set portfolio title area to be in grid', 'lekker-core' ),
					'options'       => lekker_core_get_select_type_options_pool( 'yes_no' )
				)
			);
		}
	}
	
	add_action( 'lekker_core_action_after_portfolio_options_single', 'lekker_core_add_portfolio_title_options' );
}