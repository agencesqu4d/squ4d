<?php
if ( ! function_exists( 'lekker_core_filter_clients_list_image_only_fade_in' ) ) {
	function lekker_core_filter_clients_list_image_only_fade_in( $variations ) {
		
		$variations['fade-in'] = esc_html__( 'Fade In', 'lekker-core' );
		
		return $variations;
	}
	
	add_filter( 'lekker_core_filter_clients_list_image_only_animation_options', 'lekker_core_filter_clients_list_image_only_fade_in' );
}