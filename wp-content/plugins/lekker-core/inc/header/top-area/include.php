<?php

include_once LEKKER_CORE_INC_PATH . '/header/top-area/top-area.php';
include_once LEKKER_CORE_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( LEKKER_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}