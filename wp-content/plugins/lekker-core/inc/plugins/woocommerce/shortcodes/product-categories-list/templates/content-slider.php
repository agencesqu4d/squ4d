<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
    <div class="swiper-wrapper">
		<?php
		// Include items
		lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-categories-list', 'templates/loop', '', $params );
		?>
    </div>
	<?php if ( $slider_navigation !== 'no' ) { ?>
        <div class="swiper-button-next"><span class="qodef-swiper-lines"></span><span class="qodef-swiper-label"><?php echo esc_html__( 'Next', 'lekker-core' ) ?></span></div>
        <div class="swiper-button-prev"><span class="qodef-swiper-lines"></span><span class="qodef-swiper-label"><?php echo esc_html__( 'Prev', 'lekker-core' ) ?></span></div>
	<?php } ?>
	<?php if ( $slider_pagination !== 'no' ) { ?>
        <div class="swiper-pagination"></div>
	<?php } ?>
</div>