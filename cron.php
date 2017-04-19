<?php

define( 'WP_USE_THEMES', false );
require( __DIR__ . '/../public/core/wp-load.php' );

CronManager::run();
