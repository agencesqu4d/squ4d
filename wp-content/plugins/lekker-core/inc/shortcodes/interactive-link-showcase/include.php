<?php

include_once LEKKER_CORE_SHORTCODES_PATH . '/interactive-link-showcase/interactive-link-showcase.php';

foreach ( glob( LEKKER_CORE_SHORTCODES_PATH . '/interactive-link-showcase/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}