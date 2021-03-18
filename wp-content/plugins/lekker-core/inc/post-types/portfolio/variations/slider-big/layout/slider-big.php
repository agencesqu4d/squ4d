<?php
// Hook to include additional content before portfolio single item
do_action( 'lekker_core_action_before_portfolio_single_item' );
?>
<article <?php post_class( 'qodef-portfolio-single-item qodef-e' ); ?>>
    <div class="qodef-e-inner">
	    <div class="qodef-media qodef-swiper-container qodef--slider">
		    <div class="swiper-wrapper">
			    <?php lekker_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media', 'slider'); ?>
		    </div>
		    <div class="swiper-button-next"><span class="qodef-swiper-lines"></span></div>
		    <div class="swiper-button-prev"><span class="qodef-swiper-lines"></span></div>
	    </div>
        <div class="qodef-e-content qodef-grid qodef-layout--template <?php echo lekker_core_get_grid_gutter_classes(); ?>">
            <div class="qodef-grid-inner clear">
                <div class="qodef-grid-item qodef-col--9">
					<?php lekker_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
                </div>
                <div class="qodef-grid-item qodef-col--3 qodef-portfolio-info">
					<?php lekker_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
					<?php lekker_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
					<?php lekker_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
					<?php lekker_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/tags' ); ?>
					<?php lekker_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/social-share' ); ?>
                </div>
            </div>
        </div>
    </div>
</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'lekker_core_action_after_portfolio_single_item' );
?>