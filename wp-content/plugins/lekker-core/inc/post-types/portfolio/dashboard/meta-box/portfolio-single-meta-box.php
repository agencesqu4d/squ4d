<?php

if ( ! function_exists( 'lekker_core_add_portfolio_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function lekker_core_add_portfolio_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'  => array( 'portfolio-item' ),
				'type'   => 'meta',
				'slug'   => 'portfolio-item',
				'title'  => esc_html__( 'Portfolio Settings', 'lekker-core' ),
				'layout' => 'tabbed'
			)
		);
		
		if ( $page ) {
			
			$general_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-general',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'General Settings', 'lekker-core' ),
					'description' => esc_html__( 'General portfolio settings', 'lekker-core' )
				)
			);
			
			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_layout',
					'title'       => esc_html__( 'Single Layout', 'lekker-core' ),
					'description' => esc_html__( 'Choose default layout for portfolio single', 'lekker-core' ),
					'options'     => apply_filters( 'lekker_core_filter_portfolio_single_layout_options', array( '' => esc_html__( 'Default', 'lekker-core' ) ) )
				)
			);

			$section_columns = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_columns_section',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_single_layout' => array(
								'values'        => array('masonry-big', 'masonry-small', 'gallery-big', 'gallery-small'),
								'default_value' => ''
							)
						)
					)
				)
			);

				$section_columns->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_portfolio_columns_number',
						'title'       => esc_html__( 'Number of Columns', 'lekker-core' ),
						'options'     => lekker_core_get_select_type_options_pool('columns_number')
					)
				);

				$section_columns->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_portfolio_space_between_items',
						'title'       => esc_html__( 'Space Between Items', 'lekker-core' ),
						'options'     => lekker_core_get_select_type_options_pool('items_space')
					)
				);

			$section_media = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_media_section',
					'title'       => esc_html__( 'Media Settings', 'lekker-core' ),
					'description' => esc_html__( 'Media that will be displayed on portfolio page', 'lekker-core' )
				)
			);
			
			$media_repeater = $section_media->add_repeater_element(
				array(
					'name'        => 'qodef_portfolio_media',
					'title'       => esc_html__( 'Media Items', 'lekker-core' ),
					'description' => esc_html__( 'Enter media items for this portfolio', 'lekker-core' ),
					'button_text' => esc_html__( 'Add Media', 'lekker-core' )
				)
			);
			
			$media_repeater->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_media_type',
					'title'         => esc_html__( 'Media Item Type', 'lekker-core' ),
					'options'       => array(
						'gallery' => esc_html__( 'Gallery', 'lekker-core' ),
						'image'   => esc_html__( 'Image', 'lekker-core' ),
						'video'   => esc_html__( 'Video', 'lekker-core' ),
						'audio'   => esc_html__( 'Audio', 'lekker-core' ),
					),
					'default_value' => 'gallery'
				)
			);
			
			$media_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_gallery',
					'title'      => esc_html__( 'Upload Portfolio Images', 'lekker-core' ),
					'multiple'   => 'yes',
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'gallery',
								'default_value' => 'gallery'
							)
						)
					)
				)
			);
			
			$media_repeater->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_image',
					'title'      => esc_html__( 'Upload Portfolio Image', 'lekker-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'image',
								'default_value' => 'gallery'
							)
						)
					)
				)
			);
			
			$media_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_video',
					'title'       => esc_html__( 'Video URL', 'lekker-core' ),
					'description' => esc_html__( 'Enter your video URL', 'lekker-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'video',
								'default_value' => 'gallery'
							)
						)
					)
				)
			);
			
			$media_repeater->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_audio',
					'title'       => esc_html__( 'Audio URL', 'lekker-core' ),
					'description' => esc_html__( 'Enter your audio URL', 'lekker-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_portfolio_media_type' => array(
								'values'        => 'audio',
								'default_value' => 'gallery'
							)
						)
					)
				)
			);
			
			$section_info = $general_tab->add_section_element(
				array(
					'name'        => 'qodef_portfolio_info_section',
					'title'       => esc_html__( 'Info Settings', 'lekker-core' ),
					'description' => esc_html__( 'Info that will be displayed on portfolio page', 'lekker-core' )
				)
			);
			
			$info_items_repeater = $section_info->add_repeater_element(
				array(
					'name'        => 'qodef_portfolio_info_items',
					'title'       => esc_html__( 'Info Items', 'lekker-core' ),
					'description' => esc_html__( 'Enter additional info for portoflio item', 'lekker-core' ),
					'button_text' => esc_html__( 'Add Item', 'lekker-core' )
				)
			);
			
			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_label',
					'title'      => esc_html__( 'Item Label', 'lekker-core' )
				)
			);
			
			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_value',
					'title'      => esc_html__( 'Item Text', 'lekker-core' )
				)
			);
			
			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_info_item_link',
					'title'      => esc_html__( 'Item Link', 'lekker-core' )
				)
			);
			
			$info_items_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_info_item_target',
					'title'      => esc_html__( 'Item Target', 'lekker-core' ),
					'options'    => lekker_core_get_select_type_options_pool( 'link_target' )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_portfolio_meta_box_map', $page, $general_tab );
		}
	}
	
	add_action( 'lekker_core_action_default_meta_boxes_init', 'lekker_core_add_portfolio_single_meta_box' );
}