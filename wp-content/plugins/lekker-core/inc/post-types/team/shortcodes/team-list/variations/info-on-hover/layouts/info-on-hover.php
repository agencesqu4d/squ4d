<div <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner qodef-hover-animation--follow">
		<div class="qodef-e-image">
			<?php lekker_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<?php lekker_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/role', '', $params ); ?>
			<?php lekker_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/title', '', $params ); ?>
			<?php lekker_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/excerpt', '', $params ); ?>
			<?php lekker_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/social-icons', '', $params ); ?>
		</div>
	</div>
</div>