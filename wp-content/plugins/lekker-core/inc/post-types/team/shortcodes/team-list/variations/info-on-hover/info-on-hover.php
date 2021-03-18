<?php

if ( ! function_exists( 'lekker_core_add_team_list_variation_info_on_hover' ) ) {
	function lekker_core_add_team_list_variation_info_on_hover( $variations ) {
		
		$variations['info-on-hover'] = esc_html__( 'Info on Hover', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_team_list_layouts', 'lekker_core_add_team_list_variation_info_on_hover' );
}