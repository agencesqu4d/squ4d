<?php if ( ! empty( $title ) ) { ?>
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
		<?php if ( ! empty( $link ) ) : ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php endif; ?>
			<span class="qodef-m-title-inner">
				<span class="qodef-m-icon-wrapper">
					<?php lekker_core_template_part( 'shortcodes/icon-with-text/variations/before-title', 'templates/parts/' . $icon_type, '', $params ) ?>
					<div class="qodef-m-icon-hover-wrapper">
						<?php if ($icon_type == 'custom-icon' && ! empty ( $custom_icon_hover ) )
							lekker_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/custom-icon-hover', '', $params)
						?>
					</div>
				</span>
				<span class="qodef-m-title-text">
					<?php echo esc_html( $title ); ?>
				</span>
			</span>
		<?php if ( ! empty( $link ) ) : ?>
			</a>
		<?php endif; ?>
	</<?php echo esc_attr( $title_tag ); ?>>
<?php } ?>