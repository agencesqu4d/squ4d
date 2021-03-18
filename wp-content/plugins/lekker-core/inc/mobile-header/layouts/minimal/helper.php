<?php

if ( ! function_exists( 'lekker_core_add_minimal_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function lekker_core_add_minimal_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['minimal'] = array(
			'image' => LEKKER_CORE_HEADER_LAYOUTS_URL_PATH . '/minimal/assets/img/minimal-header.png',
			'label' => esc_html__( 'Minimal', 'lekker-core' )
		);

		return $header_layout_options;
	}

	add_filter( 'lekker_core_filter_mobile_header_layout_option', 'lekker_core_add_minimal_mobile_header_global_option' );
}

if ( ! function_exists( 'lekker_core_register_minimal_mobile_header_layout' ) ) {
	function lekker_core_register_minimal_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layout = array(
			'minimal' => 'MinimalMobileHeader'
		);

		$mobile_header_layouts = array_merge( $mobile_header_layouts, $mobile_header_layout );

		return $mobile_header_layouts;
	}

	add_filter( 'lekker_core_filter_register_mobile_header_layouts', 'lekker_core_register_minimal_mobile_header_layout');
}

if ( ! function_exists( 'lekker_core_minimal_mobile_header_hide_menu_typography' ) ) {
	function lekker_core_minimal_mobile_header_hide_menu_typography( $options ) {
		$options[] = 'minimal';
		
		return $options;
	}
	
	add_filter( 'lekker_core_filter_mobile_menu_typography_hide_option', 'lekker_core_minimal_mobile_header_hide_menu_typography' );
}

if ( ! function_exists( 'lekker_core_get_mobile_header_logo_light_image' ) ) {
	function lekker_core_get_mobile_header_logo_light_image() {
		$logo_height         = lekker_core_get_post_value_through_levels( 'qodef_logo_height' );
		$logo_dark_image_id  = lekker_core_get_post_value_through_levels( 'qodef_logo_dark' );
		$logo_light_image_id = lekker_core_get_post_value_through_levels( 'qodef_logo_light' );
		$customizer_logo     = lekker_core_get_customizer_logo();
		
		$parameters = array(
			'logo_height'      => ! empty( $logo_height ) ? 'height:' . intval( $logo_height ) . 'px' : '',
			'logo_dark_image'  => '',
			'logo_light_image' => '',
		);
		
		if ( ! empty( $logo_dark_image_id ) ) {
			$logo_dark_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--dark',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo dark', 'lekker-core' )
			);
			
			$image      = wp_get_attachment_image( $logo_light_image_id, 'full', false, $logo_dark_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_dark_image_id, $logo_dark_image_attr );
			
			$parameters['logo_dark_image'] = $image_html;
		}
		
		if ( ! empty( $logo_light_image_id ) ) {
			$logo_light_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--light',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo light', 'lekker-core' )
			);
			
			$image      = wp_get_attachment_image( $logo_light_image_id, 'full', false, $logo_light_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_light_image_id, $logo_light_image_attr );
			
			$parameters['logo_light_image'] = $image_html;
		}
		
		if ( ! empty( $logo_dark_image_id ) || ! empty( $logo_light_image_id ) ) {
			lekker_core_template_part( 'mobile-header/layouts/minimal/templates', 'parts/mobile-logo-light-dark', '', $parameters );
		} else if ( ! empty( $customizer_logo ) ) {
			echo qode_framework_wp_kses_html( 'html', $customizer_logo );
		}
	}
	
	add_action( 'lekker_core_after_mobile_header_logo_image', 'lekker_core_get_mobile_header_logo_light_image' );
}