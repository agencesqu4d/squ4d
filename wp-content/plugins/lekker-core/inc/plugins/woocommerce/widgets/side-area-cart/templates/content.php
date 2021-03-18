<div class="qodef-m-content">
	<?php if ( ! WC()->cart->is_empty() ) {
		lekker_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/loop' );
		
		lekker_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/order-details' );
		
		lekker_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/button' );
	} else {
		// Include posts not found
		lekker_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/posts-not-found' );
	}
	
	lekker_core_template_part( 'plugins/woocommerce/widgets/side-area-cart', 'templates/parts/close' );
	?>
</div>