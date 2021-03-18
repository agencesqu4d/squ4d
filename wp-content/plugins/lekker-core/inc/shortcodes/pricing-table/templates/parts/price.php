<?php if ( ! empty( $price ) ) { ?>
	<div class="qodef-m-price">
		<div class="qodef-m-price-wrapper qodef-h1" <?php qode_framework_inline_style( $price_styles ); ?>>

			<?php if ( ! empty( $currency ) ) { ?>
				<span class="qodef-m-price-currency" <?php qode_framework_inline_style( $currency_styles ); ?>><?php echo esc_html( $currency ); ?></span>
			<?php } ?>
			<span class="qodef-m-price-value"><?php echo esc_html( $price ); ?></span>
			<?php if ( ! empty( $period ) ) { ?>
				<span class="qodef-m-price-period" <?php qode_framework_inline_style( $period_styles ); ?>><?php echo esc_html( $period ); ?></span>
			<?php } ?>
		</div>
	</div>
<?php } ?>