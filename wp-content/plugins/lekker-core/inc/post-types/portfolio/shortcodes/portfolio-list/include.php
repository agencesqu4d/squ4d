<?php

include_once LEKKER_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/portfolio-list.php';

foreach ( glob( LEKKER_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}