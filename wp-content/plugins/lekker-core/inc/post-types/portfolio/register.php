<?php

if ( ! function_exists( 'lekker_core_register_portfolio_for_meta_options' ) ) {
	function lekker_core_register_portfolio_for_meta_options( $post_types ) {
		$post_types[] = 'portfolio-item';
		
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'lekker_core_register_portfolio_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'lekker_core_register_portfolio_for_meta_options' );
}

if ( ! function_exists( 'lekker_core_add_portfolio_custom_post_type' ) ) {
	/**
	 * Function that adds portfolio custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function lekker_core_add_portfolio_custom_post_type( $cpts ) {
		$cpts[] = 'LekkerCorePortfolioCPT';
		
		return $cpts;
	}
	
	add_filter( 'lekker_core_filter_register_custom_post_types', 'lekker_core_add_portfolio_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class LekkerCorePortfolioCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Portfolio', 'lekker-core' );
			$this->set_base( 'portfolio-item' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-screenoptions' );
			$this->set_slug( 'portfolio-item' );
			$this->set_name( $name );
			$this->set_path( LEKKER_CORE_CPT_PATH . '/portfolio' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Lekker Portfolio', 'lekker-core' ),
				'singular_name' => esc_html__( 'Portfolio Item', 'lekker-core' ),
				'add_item'      => esc_html__( 'New Portfolio Item', 'lekker-core' ),
				'add_new_item'  => esc_html__( 'Add New Portfolio Item', 'lekker-core' ),
				'edit_item'     => esc_html__( 'Edit Portfolio Item', 'lekker-core' )
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'portfolio-category',
				'slug'          => 'portfolio-category',
				'singular_name' => esc_html__( 'Category', 'lekker-core' ),
				'plural_name'   => esc_html__( 'Categories', 'lekker-core' ),
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'portfolio-tag',
				'slug'          => 'portfolio-tag',
				'singular_name' => esc_html__( 'Tag', 'lekker-core' ),
				'plural_name'   => esc_html__( 'Tags', 'lekker-core' ),
			) );
		}
	}
}