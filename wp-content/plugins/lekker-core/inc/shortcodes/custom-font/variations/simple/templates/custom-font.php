<?php if ( ! empty( $link ) ) : ?>
	<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
<?php endif; ?>
	<<?php echo esc_attr( $title_tag ); ?> <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
<?php if ( ! empty( $link ) ) : ?>
	</a>
<?php endif; ?>