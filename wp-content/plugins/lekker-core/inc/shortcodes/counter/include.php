<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/counter/counter.php';

foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}