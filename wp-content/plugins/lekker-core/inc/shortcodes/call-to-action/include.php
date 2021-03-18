<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/call-to-action/call-to-action.php';

foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/call-to-action/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}