<?php

if ( ! function_exists( 'lekker_core_add_clients_meta_box' ) ) {
	/**
	 * Function that adds fields for clients
	 */
	function lekker_core_add_clients_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'clients' ),
				'type'  => 'meta',
				'slug'  => 'clients',
				'title' => esc_html__( 'Clients Parameters', 'lekker-core' )
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_logo_image',
					'title'      => esc_html__( 'Client Logo Image', 'lekker-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_logo_hover_image',
					'title'      => esc_html__( 'Client Logo Hover Image', 'lekker-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_client_link',
					'title'      => esc_html__( 'Client Link', 'lekker-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_client_link_target',
					'title'      => esc_html__( 'Client Link Target', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'link_target' )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_clients_meta_box_map', $page );
		}
	}
	
	add_action( 'lekker_core_action_default_meta_boxes_init', 'lekker_core_add_clients_meta_box' );
}