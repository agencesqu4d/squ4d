<?php

if ( ! function_exists( 'lekker_core_add_admin_user_options' ) ) {
	function lekker_core_add_admin_user_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'administrator', 'author' ),
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'lekker-core' ),
				'slug'  => 'admin-options',
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'lekker-core' ),
					'description' => esc_html__( 'Enter user Facebook profile URL', 'lekker-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'lekker-core' ),
					'description' => esc_html__( 'Enter user Instagram profile URL', 'lekker-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'lekker-core' ),
					'description' => esc_html__( 'Enter user Twitter profile URL', 'lekker-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'lekker-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile URL', 'lekker-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'lekker-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile URL', 'lekker-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_admin_user_options_map', $page );
		}
	}
	
	add_action( 'lekker_core_action_register_role_custom_fields', 'lekker_core_add_admin_user_options' );
}