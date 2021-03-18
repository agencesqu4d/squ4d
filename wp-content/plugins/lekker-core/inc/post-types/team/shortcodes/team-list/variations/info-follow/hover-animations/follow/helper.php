<?php
if ( ! function_exists( 'lekker_core_filter_team_list_info_follow' ) ) {
	function lekker_core_filter_team_list_info_follow( $variations ) {

		$variations['follow'] = esc_html__( 'Follow', 'lekker-core' );

		return $variations;
	}

	add_filter( 'lekker_core_filter_team_list_info_follow_animation_options', 'lekker_core_filter_team_list_info_follow' );
}