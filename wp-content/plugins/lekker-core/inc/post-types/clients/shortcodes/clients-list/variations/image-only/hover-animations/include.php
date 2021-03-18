<?php

include_once LEKKER_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/image-only/hover-animations/hover-animations.php';

foreach ( glob( LEKKER_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/image-only/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}