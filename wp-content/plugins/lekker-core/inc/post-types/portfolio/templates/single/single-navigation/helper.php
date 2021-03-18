<?php

if ( ! function_exists( 'lekker_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function lekker_core_include_portfolio_single_post_navigation_template() {
		lekker_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}
	
	add_action( 'lekker_core_action_after_portfolio_single_item', 'lekker_core_include_portfolio_single_post_navigation_template' );
}