<?php

if ( ! function_exists( 'lekker_core_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that adds portfolio list settings for portfolio single module
	 */
	function lekker_core_add_portfolio_item_list_meta_boxes( $page ) {
		
		if ( $page ) {
			
			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'lekker-core' ),
					'description' => esc_html__( 'Portfolio list settings', 'lekker-core' )
				)
			);
			
			$list_tab->add_field_element( array(
				'field_type'  => 'image',
				'name'        => 'qodef_portfolio_list_image',
				'title'       => esc_html__( 'Portfolio List Image', 'lekker-core' ),
				'description' => esc_html__( 'Upload image to be displayed on portfolio list instead of featured image', 'lekker-core' ),
			) );
			
			$list_tab->add_field_element( array(
				'field_type'  => 'image',
				'name'        => 'qodef_portfolio_list_image_hover',
				'title'       => esc_html__( 'Portfolio List Image On Hover', 'lekker-core' ),
				'description' => esc_html__( 'Upload image to be displayed on portfolio list hover action', 'lekker-core' ),
			) );
			
			$list_tab->add_field_element( array(
				'field_type'  => 'color',
				'name'        => 'qodef_portfolio_list_color_hover',
				'title'       => esc_html__( 'Portfolio List Background Color On Hover', 'lekker-core' ),
				'description' => esc_html__( 'Choose color to be displayed on portfolio list only on info on hover type', 'lekker-core' ),
			) );
			
			$list_tab->add_field_element( array(
				'field_type'  => 'select',
				'name'        => 'qodef_portfolio_list_simple_layout',
				'title'       => esc_html__( 'Display Item in Simple Layout', 'lekker-core' ),
				'description' => esc_html__( 'Enabling this option will display this portfolio item without featured image (only project info is displayed).', 'lekker-core' ),
				'options'     => lekker_core_get_select_type_options_pool( 'no_yes' )
			) );
			
			$list_tab->add_field_element( array(
				'field_type'  => 'select',
				'name'        => 'qodef_masonry_image_dimension_portfolio-item',
				'title'       => esc_html__( 'Image Dimension', 'lekker-core' ),
				'description' => esc_html__( 'Choose an image layout for "masonry behavior" portfolio list. If you are using fixed image proportions on the list, choose an option other than default', 'lekker-core' ),
				'options'     => lekker_core_get_select_type_options_pool( 'masonry_image_dimension' )
			) );
			
			$list_tab->add_field_element( array(
				'field_type' => 'select',
				'name'       => 'qodef_portfolio_list_light_text',
				'title'      => esc_html__( 'Portfolio List Text Light Style', 'lekker-core' ),
				'options'    => lekker_core_get_select_type_options_pool( 'no_yes' )
			) );
			
			$list_tab->add_field_element( array(
				'field_type'  => 'text',
				'name'        => 'qodef_portfolio_item_padding',
				'title'       => esc_html__( 'Portfolio Item Custom Padding', 'lekker-core' ),
				'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'lekker-core' )
			) );
			
			// Hook to include additional options after module options
			do_action( 'lekker_core_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}
	
	add_action( 'lekker_core_action_after_portfolio_meta_box_map', 'lekker_core_add_portfolio_item_list_meta_boxes' );
}