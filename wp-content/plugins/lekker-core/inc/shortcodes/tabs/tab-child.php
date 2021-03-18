<?php

if ( ! function_exists( 'lekker_core_add_tabs_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function lekker_core_add_tabs_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'LekkerCoreTabsChildShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'lekker_core_filter_register_shortcodes', 'lekker_core_add_tabs_child_shortcode' );
}

if ( class_exists( 'LekkerCoreShortcode' ) ) {
	class LekkerCoreTabsChildShortcode extends LekkerCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( LEKKER_CORE_SHORTCODES_URL_PATH . '/tabs' );
			$this->set_base( 'lekker_core_tabs_child' );
			$this->set_name( esc_html__( 'Tabs Child', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds tab child to tabs holder', 'lekker-core' ) );
			$this->set_category( esc_html__( 'Lekker Core', 'lekker-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements( array(
				'lekker_core_tabs'
			) );
			$this->set_is_parent_shortcode( true );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'tab_title',
				'title'      => esc_html__( 'Title', 'lekker-core' ),
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
			
			$rand_number       = rand( 0, 1000 );
			$atts['tab_title'] = $atts['tab_title'] . '-' . $rand_number;
			$atts['content']   = $content;

			return lekker_core_get_template_part( 'shortcodes/tabs', 'variations/'.$atts['layout'].'/templates/child', '', $atts );
		}
	}
}