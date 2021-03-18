<?php

if ( ! function_exists( 'lekker_core_register_team_for_meta_options' ) ) {
	function lekker_core_register_team_for_meta_options( $post_types ) {
		$post_types[] = 'team';
		
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'lekker_core_register_team_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'lekker_core_register_team_for_meta_options' );
}

if ( ! function_exists( 'lekker_core_add_team_custom_post_type' ) ) {
	/**
	 * Function that adds team custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function lekker_core_add_team_custom_post_type( $cpts ) {
		$cpts[] = 'LekkerCoreTeamCPT';
		
		return $cpts;
	}
	
	add_filter( 'lekker_core_filter_register_custom_post_types', 'lekker_core_add_team_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class LekkerCoreTeamCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Team', 'lekker-core' );
			$this->set_base( 'team' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-screenoptions' );
			$this->set_slug( 'team' );
			$this->set_name( $name );
			$this->set_path( LEKKER_CORE_CPT_PATH . '/team' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Lekker Team', 'lekker-core' ),
				'singular_name' => esc_html__( 'Team Member', 'lekker-core' ),
				'add_item'      => esc_html__( 'New Team Member', 'lekker-core' ),
				'add_new_item'  => esc_html__( 'Add New Team Member', 'lekker-core' ),
				'edit_item'     => esc_html__( 'Edit Team Member', 'lekker-core' )
			) );
			if ( ! lekker_core_team_has_single() ) {
				$this->set_public( false );
				$this->set_archive( false );
				$this->set_supports( array(
					'title',
					'thumbnail'
				) );
			}
			$this->add_post_taxonomy( array(
				'base'          => 'team-category',
				'slug'          => 'team-category',
				'singular_name' => esc_html__( 'Category', 'lekker-core' ),
				'plural_name'   => esc_html__( 'Categories', 'lekker-core' ),
			) );
		}
	}
}