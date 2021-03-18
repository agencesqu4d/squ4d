<?php

if ( ! function_exists( 'lekker_core_add_sticky_sidebar_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function lekker_core_add_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'LekkerCoreStickySidebarWidget';
		
		return $widgets;
	}
	
	add_filter( 'lekker_core_filter_register_widgets', 'lekker_core_add_sticky_sidebar_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class LekkerCoreStickySidebarWidget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'lekker_core_sticky_sidebar' );
			$this->set_name( esc_html__( 'Lekker Sticky Sidebar', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar.', 'lekker-core' ) );
		}

		public function render( $atts ) {
			{
				echo '<div class="widget qodef-widget-sticky-sidebar"></div>';
			}
		}
	}
}
