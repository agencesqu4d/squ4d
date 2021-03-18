<?php

if ( ! function_exists( 'lekker_core_manage_clients_custom_columns' ) ) {
	function lekker_core_manage_clients_custom_columns( $columns ) {
		$columns['logo_image'] = esc_html__( 'Logo Image', 'lekker-core' );
		return $columns;
	}
	
	add_filter( 'manage_clients_posts_columns', 'lekker_core_manage_clients_custom_columns' );
}

if ( ! function_exists( 'lekker_core_manage_clients_custom_columns_data' ) ) {
	function lekker_core_manage_clients_custom_columns_data( $column, $post_id ) {
		switch ( $column ) {
			case 'logo_image':
				$client_image = get_post_meta( $post_id, 'qodef_logo_image', true );
				echo wp_get_attachment_image( $client_image, 'thumbnail' );
				break;
		}
	}
	
	add_action( 'manage_clients_posts_custom_column', 'lekker_core_manage_clients_custom_columns_data', 10, 2 );
}
