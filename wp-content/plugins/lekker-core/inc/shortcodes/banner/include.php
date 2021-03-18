<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/banner/banner.php';

foreach ( glob( LEKKER_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}