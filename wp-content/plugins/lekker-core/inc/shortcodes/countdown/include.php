<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/countdown/countdown.php';

foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}