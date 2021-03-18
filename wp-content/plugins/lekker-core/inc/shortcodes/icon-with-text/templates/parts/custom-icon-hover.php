<?php if ( ! empty ( $custom_icon_hover ) ) { ?>
	<?php if ( ! empty( $link ) ) : ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php endif; ?>
		<?php echo wp_get_attachment_image( $custom_icon_hover, 'full' ); ?>
	<?php if ( ! empty( $link ) ) : ?>
		</a>
	<?php endif; ?>
<?php }