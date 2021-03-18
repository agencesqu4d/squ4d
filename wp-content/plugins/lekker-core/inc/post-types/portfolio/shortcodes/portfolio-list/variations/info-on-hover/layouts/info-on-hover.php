<?php
$portfolio_list_color_hover = get_post_meta( get_the_ID(), 'qodef_portfolio_list_color_hover', true );
?>
<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner" <?php qode_framework_inline_style( $this_shortcode->get_list_item_style( $params ) ) ?>>
		<div class="qodef-e-image">
			<?php lekker_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<div class="qodef-e-content-inner"
				<?php if ( ! empty( $portfolio_list_color_hover ) ) { ?>
					style="background-color:<?php echo $portfolio_list_color_hover ?>"
				<?php } ?>
			>
				<a itemprop="url" href="<?php the_permalink(); ?>"></a>
				<?php lekker_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/category', '', $params ); ?>
				<?php lekker_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params ); ?>
			</div>
		</div>
	</div>
</article>