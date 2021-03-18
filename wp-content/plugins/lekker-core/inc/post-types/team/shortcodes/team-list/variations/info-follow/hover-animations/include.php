<?php

include_once LEKKER_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-follow/hover-animations/hover-animations.php';

foreach ( glob( LEKKER_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-follow/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}