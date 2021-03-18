<?php
$product_list_color_hover = get_post_meta( get_the_ID(), 'qodef_product_list_color_hover', true );
?>
<div <?php wc_product_class( $item_classes ); ?>>
    <div class="qodef-woo-product-inner">
		<?php if ( has_post_thumbnail() ) { ?>
            <div class="qodef-woo-product-image">
				<?php lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/on-sale' ); ?>
				<?php lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
                <div class="qodef-woo-product-image-inner"
					<?php if ( ! empty( $product_list_color_hover ) ) { ?>
						style="background-color:<?php echo $product_list_color_hover ?>"
					<?php } ?>
				>
					<?php lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/category', '', $params ); ?>
					<?php lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
					<?php lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/rating', '', $params ); ?>
					<?php lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
					<?php lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' ); ?>
                </div>
            </div>
		<?php } ?>
		<?php lekker_core_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
    </div>
</div>