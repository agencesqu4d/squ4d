<?php
if ( ! function_exists( 'lekker_core_register_covers_header_search_layout' ) ) {
	function lekker_core_register_covers_header_search_layout( $search_layouts ) {
		$search_layout = array(
			'covers-header' => 'CoversHeaderSearch'
		);

		$search_layouts = array_merge( $search_layouts, $search_layout );

		return $search_layouts;
	}

	add_filter( 'lekker_core_filter_register_search_layouts', 'lekker_core_register_covers_header_search_layout');
}