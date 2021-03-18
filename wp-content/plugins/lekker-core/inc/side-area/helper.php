<?php

if ( ! function_exists( 'lekker_is_side_area_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function lekker_is_side_area_enabled() {
		$is_enabled = is_active_widget( false, false, 'lekker_core_side_area_opener' );
		
		return apply_filters( 'lekker_filter_enable_side_area', $is_enabled );
	}
}

if ( ! function_exists( 'lekker_core_enqueue_side_area_assets' ) ) {
	/**
	 * Function that enqueue 3rd party plugins script
	 */
	function lekker_core_enqueue_side_area_assets() {
		
		if ( lekker_is_side_area_enabled() ) {
			wp_enqueue_style( 'perfect-scrollbar', LEKKER_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array() );
			wp_enqueue_script( 'perfect-scrollbar', LEKKER_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
		}
	}
	
	add_action( 'lekker_core_action_before_main_css', 'lekker_core_enqueue_side_area_assets' );
}

if ( ! function_exists( 'lekker_core_load_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function lekker_core_load_side_area() {

		if ( lekker_is_side_area_enabled() ) {
			$parameters = array(
				'classes' => lekker_core_side_area_classes()
			);

			lekker_core_template_part( 'side-area', 'templates/side-area', '', $parameters );
		}
	}

	add_action( 'lekker_action_before_wrapper_close_tag', 'lekker_core_load_side_area', 10 );
}

if ( ! function_exists( 'lekker_core_side_area_classes' ) ) {
	function lekker_core_side_area_classes() {
		$classes = array();
		
		$alignment = lekker_core_get_option_value( 'admin', 'qodef_side_area_alignment' );
		
		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-alignment--' . $alignment;
		}
		
		return $classes;
	}
}

if ( ! function_exists( 'lekker_core_get_side_area_config' ) ) {
	/**
	 * Function that return config variables for side area
	 *
	 * @return array
	 */
	function lekker_core_get_side_area_config() {
		
		// Config variables
		$config = apply_filters( 'lekker_core_filter_side_area_config', array(
			'title_tag'   => 'h5',
			'title_class' => 'qodef-widget-title'
		) );
		
		return $config;
	}
}

if ( ! function_exists( 'lekker_core_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function lekker_core_register_side_area_sidebar() {
		
		// Sidebar config variables
		$config = lekker_core_get_side_area_config();
		
		register_sidebar(
			array(
				'id'            => 'qodef-side-area',
				'name'          => esc_html__( 'Side Area', 'lekker-core' ),
				'description'   => esc_html__( 'Widgets added here will appear in side area', 'lekker-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="side-area">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. esc_attr( $config['title_tag'] ) .' class="'. esc_attr( $config['title_class'] ) .'">',
				'after_title'   => '</'. esc_attr( $config['title_tag'] ) .'>'
			)
		);
	}

	add_action( 'widgets_init', 'lekker_core_register_side_area_sidebar' );
}

if ( ! function_exists( 'lekker_core_include_side_area_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function lekker_core_include_side_area_widget() {
		foreach ( glob( LEKKER_CORE_INC_PATH . '/side-area/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'lekker_core_include_side_area_widget' );
}

if ( ! function_exists( 'lekker_core_side_area_set_icon_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function lekker_core_side_area_set_icon_styles( $style ) {
		$icon_style             = array();
		$icon_hover_style       = array();
		$close_icon_style       = array();
		$close_icon_hover_style = array();
		
		$icon_color       = lekker_core_get_option_value( 'admin', 'qodef_side_area_icon_color' );
		$icon_hover_color = lekker_core_get_option_value( 'admin', 'qodef_side_area_icon_hover_color' );
		
		$close_icon_color       = lekker_core_get_option_value( 'admin', 'qodef_side_area_close_icon_color' );
		$close_icon_hover_color = lekker_core_get_option_value( 'admin', 'qodef_side_area_close_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			$icon_style['color'] = $icon_color;
		}
		
		if ( ! empty( $icon_hover_style ) ) {
			$icon_hover_color['color'] = $icon_hover_style;
		}
		
		if ( ! empty( $icon_style ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-side-area-opener', $icon_style );
		}
		
		if ( ! empty( $icon_hover_style ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-side-area-opener:hover', $icon_hover_style );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			$close_icon_style['color'] = $close_icon_color;
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			$close_icon_hover_style['color'] = $close_icon_hover_color;
		}
		
		if ( ! empty( $close_icon_style ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area-close', $close_icon_style );
		}
		
		if ( ! empty( $close_icon_hover_style ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area-close:hover', $close_icon_hover_style );
		}
		
		return $style;
	}
	
	add_filter( 'lekker_filter_add_inline_style', 'lekker_core_side_area_set_icon_styles' );
}

if ( ! function_exists( 'lekker_core_set_side_area_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function lekker_core_set_side_area_styles( $style ) {
		$side_area_styles       = array();
		$side_area_cover_styles = array();

		$side_area_background_color = lekker_core_get_post_value_through_levels( 'qodef_side_area_background_color' );
		$side_area_width            = lekker_core_get_post_value_through_levels( 'qodef_side_area_width' );

		$side_area_cover_background_color = lekker_core_get_post_value_through_levels( 'qodef_side_area_content_overlay_color' );

		if ( ! empty( $side_area_background_color ) ) {
			$side_area_styles['background-color'] = $side_area_background_color;
		}

		if ( ! empty( $side_area_width ) ) {
			if ( qode_framework_string_ends_with_space_units( $side_area_width ) ) {
				$side_area_styles['width'] = $side_area_width;
				$side_area_styles['right'] = '-' . $side_area_width;
			} else {
				$side_area_styles['width'] = intval( $side_area_width ) . 'px';
				$side_area_styles['right'] = '-' . intval( $side_area_width ) . 'px';
			}
		}

		if ( ! empty( $side_area_cover_background_color ) ) {
			$side_area_cover_styles['background-color'] = $side_area_cover_background_color;
		}

		if ( ! empty( $side_area_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area', $side_area_styles );
		}

		if ( ! empty( $side_area_cover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-side-area--opened .qodef-side-area-cover', $side_area_cover_styles );
		}

		return $style;
	}

	add_filter( 'lekker_filter_add_inline_style', 'lekker_core_set_side_area_styles' );
}