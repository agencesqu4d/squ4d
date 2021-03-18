<?php

include_once LEKKER_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( LEKKER_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}