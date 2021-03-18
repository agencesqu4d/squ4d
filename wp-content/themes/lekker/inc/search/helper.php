<?php

if ( ! function_exists( 'lekker_get_search_page_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on search page
	 *
	 * @return int
	 */
	function lekker_get_search_page_excerpt_length() {
		$length = apply_filters( 'lekker_filter_search_page_excerpt_length', 180 );
		
		return intval( $length );
	}
}
