<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/button/button.php';

foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}