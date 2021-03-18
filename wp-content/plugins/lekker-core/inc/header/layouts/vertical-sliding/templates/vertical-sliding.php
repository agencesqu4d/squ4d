<?php do_action( 'lekker_action_before_page_header' ); ?>

<header id="qodef-page-header">
	<div id="qodef-page-header-inner">
		<div class="qodef-vertical-sliding-area qodef--static">
			<?php

			// include opener
			lekker_core_get_opener_icon_html( array(
				'option_name'  => 'vertical_sliding_menu',
				'custom_class' => 'qodef-vertical-sliding-menu-opener'
			), true );

		    ?>
		</div>
		<div class="qodef-vertical-sliding-area qodef--dynamic">
			<?php
			// include logo
			lekker_core_get_header_logo_image( array( 'vertical_sliding_logo' => true ) );
			
			// include vertical sliding navigation
			lekker_core_template_part( 'header', 'layouts/vertical-sliding/templates/navigation' );
			
			// include widget area two
			if ( is_active_sidebar( 'qodef-header-widget-area-one' ) ) : ?>
				<div class="qodef-vertical-sliding-widget-holder">
					<?php lekker_core_get_header_widget_area(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</header>