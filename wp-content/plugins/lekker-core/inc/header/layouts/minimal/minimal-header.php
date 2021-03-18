<?php

class MinimalHeader extends LekkerCoreHeader {
	private static $instance;

	public function __construct() {
		$this->set_slug( 'minimal' );
		$this->search_layout         = 'fullscreen';
		$this->default_header_height = 110;

		add_action( 'lekker_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template' ) );

		parent::__construct();
	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function fullscreen_menu_template() {
		$parameters = array(
			'fullscreen_menu_in_grid' => lekker_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ) === 'yes'
		);

		lekker_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
	}
}