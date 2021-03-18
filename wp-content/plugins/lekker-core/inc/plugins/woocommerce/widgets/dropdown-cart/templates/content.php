<?php lekker_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/opener' ); ?>
<div class="qodef-m-dropdown">
	<div class="qodef-m-dropdown-inner">
		<?php if ( ! WC()->cart->is_empty() ) {
			lekker_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/loop' );
			
			lekker_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/order-details' );
			
			lekker_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/button' );
		} else {
		    // Include posts not found
			lekker_core_template_part( 'plugins/woocommerce/widgets/dropdown-cart', 'templates/parts/posts-not-found' );
		} ?>
	</div>
</div>