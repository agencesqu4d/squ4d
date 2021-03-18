<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-image-inner-holder">
	<?php lekker_core_template_part( 'shortcodes/image-with-text', 'templates/parts/image', '', $params ) ?>
		<?php if ( $params['image_action'] === 'scrolling-image' ) { ?>
			<img class="qodef-m-iwt-frame" src="<?php echo LEKKER_CORE_SHORTCODES_URL_PATH ?>/image-with-text/assets/img/scrolling-image-frame.png" alt="<?php esc_html_e('Scrolling Image Frame', 'lekker-core') ?>" />
		<?php } ?>
	</div>
	<div class="qodef-m-content">
		<?php lekker_core_template_part( 'shortcodes/image-with-text', 'templates/parts/title', '', $params ) ?>
		<?php lekker_core_template_part( 'shortcodes/image-with-text', 'templates/parts/text', '', $params ) ?>
	</div>
</div>