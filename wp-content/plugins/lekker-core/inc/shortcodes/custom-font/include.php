<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/custom-font/custom-font.php';

foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}