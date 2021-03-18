<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-icon-wrapper">
		<?php lekker_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/' . $icon_type, '', $params ) ?>
		<div class="qodef-m-icon-hover-wrapper">
			<?php if ($icon_type == 'custom-icon' && ! empty ( $custom_icon_hover ) )
				lekker_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/custom-icon-hover', '', $params)
			?>
		</div>
	</div>
	<div class="qodef-m-content">
		<?php lekker_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/title', '', $params ) ?>
		<?php lekker_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/text', '', $params ) ?>
	</div>
</div>