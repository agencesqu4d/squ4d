<?php

if ( ! function_exists( 'lekker_child_theme_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style
	 */
	function lekker_child_theme_enqueue_scripts() {
		$main_style = 'lekker-main';
		
		wp_enqueue_style( 'lekker-child-style', get_stylesheet_directory_uri() . '/style.css', array( $main_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'lekker_child_theme_enqueue_scripts' );
}

@ini_set( 'upload_max_size' , '512M' );
@ini_set( 'post_max_size', '512M');
@ini_set( 'max_execution_time', '300' );
@ini_set( 'memory_limit', '512M' );

?>