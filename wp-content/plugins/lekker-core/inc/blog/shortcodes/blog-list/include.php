<?php

include_once LEKKER_CORE_INC_PATH . '/blog/shortcodes/blog-list/blog-list.php';

foreach ( glob( LEKKER_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}