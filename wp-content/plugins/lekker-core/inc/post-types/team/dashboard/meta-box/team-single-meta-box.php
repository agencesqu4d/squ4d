<?php

if ( ! function_exists( 'lekker_core_add_team_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function lekker_core_add_team_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		$has_single     = lekker_core_team_has_single();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'team' ),
				'type'  => 'meta',
				'slug'  => 'team',
				'title' => esc_html__( 'Team Single', 'lekker-core' )
			)
		);
		
		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'        => 'qodef_team_general_section',
					'title'       => esc_html__( 'General Settings', 'lekker-core' ),
					'description' => esc_html__( 'General information about team member.', 'lekker-core' )
				)
			);
			
			if ( $has_single ) {
				$section->add_field_element( array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_single_layout',
					'title'       => esc_html__( 'Single Layout', 'lekker-core' ),
					'description' => esc_html__( 'Choose default layout for team single', 'lekker-core' ),
					'options'     => array(
						'' => esc_html__( 'Default', 'lekker-core' )
					)
				) );
			}
			
			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_role',
					'title'       => esc_html__( 'Role', 'lekker-core' ),
					'description' => esc_html__( 'Enter team member role', 'lekker-core' ),
				)
			);
			
			$social_icons_repeater = $section->add_repeater_element(
				array(
					'name'        => 'qodef_team_member_social_icons',
					'title'       => esc_html__( 'Social Networks', 'lekker-core' ),
					'description' => esc_html__( 'Populate team member social networks info', 'lekker-core' ),
					'button_text' => esc_html__( 'Add New Network', 'lekker-core' )
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'iconpack',
					'name'       => 'qodef_team_member_icon',
					'title'      => esc_html__( 'Icon', 'lekker-core' )
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_icon_link',
					'title'      => esc_html__( 'Icon Link', 'lekker-core' )
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_team_member_icon_target',
					'title'      => esc_html__( 'Icon Target', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'link_target' )
				)
			);
			
			if ( $has_single ) {
				$section->add_field_element( array(
					'field_type'  => 'date',
					'name'        => 'qodef_team_member_birth_date',
					'title'       => esc_html__( 'Birth Date', 'lekker-core' ),
					'description' => esc_html__( 'Enter team member birth date', 'lekker-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_email',
					'title'       => esc_html__( 'E-mail', 'lekker-core' ),
					'description' => esc_html__( 'Enter team member e-mail address', 'lekker-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_address',
					'title'       => esc_html__( 'Address', 'lekker-core' ),
					'description' => esc_html__( 'Enter team member address', 'lekker-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_education',
					'title'       => esc_html__( 'Education', 'lekker-core' ),
					'description' => esc_html__( 'Enter team member education', 'lekker-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'file',
					'name'        => 'qodef_team_member_resume',
					'title'       => esc_html__( 'Resume', 'lekker-core' ),
					'description' => esc_html__( 'Upload team member resume', 'lekker-core' ),
					'args'        => array(
						'allowed_type' => '[application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]'
					)
				) );
			}
			
			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_team_meta_box_map', $page, $has_single );
		}
	}
	
	add_action( 'lekker_core_action_default_meta_boxes_init', 'lekker_core_add_team_single_meta_box' );
}