<?php

if ( ! function_exists( 'lekker_core_add_product_categories_list_variation_info_on_image' ) ) {
	function lekker_core_add_product_categories_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'lekker-core' );

		return $variations;
	}

	add_filter( 'lekker_core_filter_product_categories_list_layouts', 'lekker_core_add_product_categories_list_variation_info_on_image' );
}