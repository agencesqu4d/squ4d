<?php

if ( ! function_exists( 'lekker_include_justified_gallery_scripts' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts
	 *
	 * @param $atts
	 */
	function lekker_include_justified_gallery_scripts( $atts ) {
		
		if ( isset( $atts['behavior'] ) && $atts['behavior'] == 'justified-gallery' ) {
			wp_enqueue_script( 'jquery-justified-gallery-min', LEKKER_INC_ROOT . '/justified-gallery/assets/js/plugins/jquery.justifiedGallery.min.js', array( 'jquery' ), true );
		}
	}
	
	add_action( 'lekker_core_action_list_shortcodes_load_assets', 'lekker_include_justified_gallery_scripts' );
}
