<?php

if ( ! function_exists( 'lekker_core_header_radio_to_select_options' ) ) {
	function lekker_core_header_radio_to_select_options( $radio_array ) {
		$select_array = array( '' => esc_html__( 'Default', 'lekker-core' ) );

		foreach ( $radio_array as $key => $value ) {
			$select_array[ $key ] = $value['label'];
		}
		
		return $select_array;
	}
}