<?php

if ( ! function_exists( 'lekker_core_add_back_to_top_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function lekker_core_add_back_to_top_options( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_back_to_top',
					'title'         => esc_html__( 'Enable Back to Top', 'lekker-core' ),
					'default_value' => 'yes'
				)
			);
		}
	}
	
	add_action( 'lekker_core_action_after_general_options_map', 'lekker_core_add_back_to_top_options' );
}