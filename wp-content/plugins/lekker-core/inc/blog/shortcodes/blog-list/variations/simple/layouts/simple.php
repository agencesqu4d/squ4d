<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php lekker_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', '', $params ); ?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post author info
				lekker_core_theme_template_part( 'blog', 'templates/parts/post-info/author' );
				
				// Include post date info
				lekker_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
				
				// Include post category info
				lekker_core_theme_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			<?php lekker_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params ); ?>
			<?php lekker_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' ); ?>
		</div>
	</div>
</article>