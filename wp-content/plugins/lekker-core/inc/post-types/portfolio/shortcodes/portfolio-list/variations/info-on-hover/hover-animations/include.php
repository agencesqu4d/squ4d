<?php

include_once LEKKER_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-on-hover/hover-animations/hover-animations.php';

foreach ( glob( LEKKER_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-on-hover/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}