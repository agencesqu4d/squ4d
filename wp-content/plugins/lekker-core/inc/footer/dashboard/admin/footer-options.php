<?php

if ( ! function_exists( 'lekker_core_add_page_footer_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function lekker_core_add_page_footer_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => LEKKER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'footer',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Footer', 'lekker-core' ),
				'description' => esc_html__( 'Global Footer Options', 'lekker-core' )
			)
		);
		
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_footer',
					'title'         => esc_html__( 'Enable Page Footer', 'lekker-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page footer', 'lekker-core' ),
					'default_value' => 'yes'
				)
			);
			
			$page_footer_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_footer_section',
					'title'      => esc_html__( 'Footer Area', 'lekker-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_footer' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			// General Footer Area Options
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_uncovering_footer',
					'title'         => esc_html__( 'Enable Uncovering Footer', 'lekker-core' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'lekker-core' ),
					'default_value' => 'no'
				)
			);
			
			// Top Footer Area Section
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_top_footer_area',
					'title'         => esc_html__( 'Enable Top Footer Area', 'lekker-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable top footer area', 'lekker-core' ),
					'default_value' => 'yes'
				)
			);
			
			$top_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_section',
					'title'      => esc_html__( 'Top Footer Area', 'lekker-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_top_footer_area' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
		
			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_top_area_in_grid',
					'title'         => esc_html__( 'Top Footer Area In Grid', 'lekker-core' ),
					'description'   => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'lekker-core' ),
					'default_value' => 'yes'
				)
			);
			
			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_top_area_columns',
					'title'         => esc_html__( 'Top Footer Area Columns', 'lekker-core' ),
					'description'   => esc_html__( 'Choose number of columns for top footer area', 'lekker-core' ),
					'options'       => lekker_core_get_select_type_options_pool( 'columns_number', true, array( '5', '6' ) ),
					'default_value' => '4'
				)
			);
			
			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_grid_gutter',
					'title'       => esc_html__( 'Top Footer Area Grid Gutter', 'lekker-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for top footer area', 'lekker-core' ),
					'options'     => lekker_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$top_footer_area_styles_section = $top_footer_area_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_styles_section',
					'title'      => esc_html__( 'Top Footer Area Styles', 'lekker-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'lekker-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_top_footer_area_background_image',
					'title'      => esc_html__( 'Background Image', 'lekker-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'lekker-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'lekker-core' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'lekker-core' )
					)
				)
			);
			
			// Bottom Footer Area Section
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_bottom_footer_area',
					'title'         => esc_html__( 'Enable Bottom Footer Area', 'lekker-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable bottom footer area', 'lekker-core' ),
					'default_value' => 'no'
				)
			);
			
			$bottom_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_section',
					'title'      => esc_html__( 'Bottom Footer Area', 'lekker-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_bottom_footer_area' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_bottom_area_in_grid',
					'title'         => esc_html__( 'Bottom Footer Area In Grid', 'lekker-core' ),
					'description'   => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'lekker-core' ),
					'default_value' => 'yes'
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_bottom_area_columns',
					'title'         => esc_html__( 'Bottom Footer Area Columns', 'lekker-core' ),
					'description'   => esc_html__( 'Choose number of columns for bottom footer area', 'lekker-core' ),
					'options'       => lekker_core_get_select_type_options_pool( 'columns_number', true, array( '3', '4', '5', '6' ) ),
					'default_value' => '2'
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter',
					'title'       => esc_html__( 'Bottom Footer Area Grid Gutter', 'lekker-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for bottom footer area', 'lekker-core' ),
					'options'     => lekker_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$bottom_footer_area_styles_section = $bottom_footer_area_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_styles_section',
					'title'      => esc_html__( 'Bottom Footer Area Styles', 'lekker-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'lekker-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'lekker-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'lekker-core' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'lekker-core' )
					)
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_page_footer_options_map', $page );
		}
	}
	
	add_action( 'lekker_core_action_default_options_init', 'lekker_core_add_page_footer_options', lekker_core_get_admin_options_map_position( 'footer' ) );
}