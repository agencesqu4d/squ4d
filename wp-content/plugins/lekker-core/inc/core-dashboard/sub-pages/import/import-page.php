<?php

if ( ! function_exists( 'lekker_core_add_import_sub_page_to_list' ) ) {
	/**
	 * Function that add additional sub page item into welcome page list
	 *
	 * @param array $sub_pages
	 *
	 * @return array
	 */
	function lekker_core_add_import_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'LekkerCoreImportPage';
		
		return $sub_pages;
	}
	
	add_filter( 'lekker_core_filter_add_welcome_sub_page', 'lekker_core_add_import_sub_page_to_list', 11 );
}

if ( class_exists( 'LekkerCoreSubPage' ) ) {
	class LekkerCoreImportPage extends LekkerCoreSubPage {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_title( esc_html__( 'Import', 'lekker-core' ) );
			$this->set_atts( $this->set_atributtes() );
		}
		
		public function set_atributtes() {
			$params = array();
			
			$iparams = LekkerCoreDashboard::get_instance()->get_import_params();
			if ( is_array( $iparams ) && isset( $iparams['submit'] ) ) {
				$params['submit'] = $iparams['submit'];
			}
			
			return $params;
		}
	}
}