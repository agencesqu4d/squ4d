<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
		if ( ! empty( $images ) ) {
			foreach ( $images as $image ) {
				$image['item_classes'] = $item_classes;
				$image['image_action'] = $image_action;
				$image['target']       = $target;
				
				lekker_core_template_part( 'shortcodes/image-gallery', 'templates/parts/image', '', $image );
			}
		}
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