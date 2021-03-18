<?php

if ( ! function_exists( 'lekker_core_add_accordion_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function lekker_core_add_accordion_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'LekkerCoreAccordionChildShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'lekker_core_filter_register_shortcodes', 'lekker_core_add_accordion_child_shortcode' );
}

if ( class_exists( 'LekkerCoreShortcode' ) ) {
	class LekkerCoreAccordionChildShortcode extends LekkerCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( LEKKER_CORE_SHORTCODES_URL_PATH . '/accordion' );
			$this->set_base( 'lekker_core_accordion_child' );
			$this->set_name( esc_html__( 'Accordion Child', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds accordion child to accordion holder', 'lekker-core' ) );
			$this->set_category( esc_html__( 'Lekker Core', 'lekker-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements( array(
				'lekker_core_accordion'
			) );
			$this->set_is_parent_shortcode( true );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'lekker-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'lekker-core' ),
				'options'       => lekker_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h3'
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'lekker-core' ),
				'default_value' => '',
				'visibility'    => array('map_for_page_builder' => false)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			$atts['content'] = $content;

			return lekker_core_get_template_part( 'shortcodes/accordion', 'variations/'.$atts['layout'].'/templates/child', '', $atts );
		}
	}
}