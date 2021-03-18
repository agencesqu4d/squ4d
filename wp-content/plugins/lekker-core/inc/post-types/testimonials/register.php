<?php

if ( ! function_exists( 'lekker_core_register_testimonials_for_meta_options' ) ) {
	function lekker_core_register_testimonials_for_meta_options( $post_types ) {
		$post_types[] = 'testimonials';
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'lekker_core_register_testimonials_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'lekker_core_register_testimonials_for_meta_options' );
}

if ( ! function_exists( 'lekker_core_add_testimonials_custom_post_type' ) ) {
	/**
	 * Function that adds testimonials custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function lekker_core_add_testimonials_custom_post_type( $cpts ) {
		$cpts[] = 'LekkerCoreTestimonialsCPT';
		
		return $cpts;
	}
	
	add_filter( 'lekker_core_filter_register_custom_post_types', 'lekker_core_add_testimonials_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class LekkerCoreTestimonialsCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Testimonials', 'lekker-core' );
			$this->set_base( 'testimonials' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-screenoptions' );
			$this->set_slug( 'testimonials' );
			$this->set_name( $name );
			$this->set_path( LEKKER_CORE_CPT_PATH . '/testimonials' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Lekker Testimonials', 'lekker-core' ),
				'singular_name' => esc_html__( 'Testimonial', 'lekker-core' ),
				'add_item'      => esc_html__( 'New Testimonial', 'lekker-core' ),
				'add_new_item'  => esc_html__( 'Add New Testimonial', 'lekker-core' ),
				'edit_item'     => esc_html__( 'Edit Testimonial', 'lekker-core' )
			) );
			$this->set_public( false );
			$this->set_archive( false );
			$this->set_supports( array(
				'title',
				'thumbnail'
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'testimonials-category',
				'slug'          => 'testimonials-category',
				'singular_name' => esc_html__( 'Category', 'lekker-core' ),
				'plural_name'   => esc_html__( 'Categories', 'lekker-core' ),
			) );
		}
		
	}
}