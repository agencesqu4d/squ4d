<?php

include_once LEKKER_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/product-list.php';

foreach ( glob( LEKKER_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}