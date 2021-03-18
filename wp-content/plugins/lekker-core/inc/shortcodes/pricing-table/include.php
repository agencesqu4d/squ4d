<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/pricing-table/pricing-table.php';

foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}