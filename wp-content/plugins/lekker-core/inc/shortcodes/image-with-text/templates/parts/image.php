<div class="qodef-m-image">
	<?php if ( $image_action === 'open-popup' ) { ?>
		<a class="qodef-magnific-popup qodef-popup-item" itemprop="image" href="<?php echo esc_url( $image_params['url'] ); ?>" data-type="image" title="<?php echo esc_attr( $image_params['alt'] ); ?>">
	<?php } else if ( $image_action === 'custom-link' ||  $image_action === 'scrolling-image'  && ! empty( $link ) ) { ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php } ?>
			<span class="qodef-m-original-image">
				<?php if ( is_array( $image_params['image_size'] ) && count( $image_params['image_size'] ) ) {

					echo qode_framework_generate_thumbnail( $image_params['image_id'], $image_params['image_size'][0], $image_params['image_size'][1] );
				} else {
					echo wp_get_attachment_image( $image_params['image_id'], $image_params['image_size'] );
				} ?>
			</span>
			<?php if( ! empty( $second_image )) { ?>

				<span class="qodef-m-hover-image">
				<?php echo wp_get_attachment_image( $second_image, 'full' ); ?>
				</span>

			<?php } ?>

	<?php if ( $image_action === 'open-popup' || $image_action === 'custom-link' ||  $image_action === 'scrolling-image'  ) { ?>
		</a>
	<?php } ?>
</div>
