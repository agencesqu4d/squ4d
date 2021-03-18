<?php

include_once LEKKER_CORE_CPT_PATH . '/team/shortcodes/team-list/team-list.php';

foreach ( glob( LEKKER_CORE_CPT_PATH . '/team/shortcodes/team-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}