<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/tabs/tab.php';
include_once LEKKER_CORE_SHORTCODES_PATH . '/tabs/tab-child.php';

foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/tabs/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}