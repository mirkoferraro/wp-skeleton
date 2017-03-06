<?php
/*
Plugin Name: Skeleton Core
Description:
Version: 1.0.0
Author: Mirko Ferraro
Author URI: http://www.mirkoferraro.it
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/*------------------------------------*\
    Core
\*------------------------------------*/
$core_files = array(
    'include',
    'assets',
    'languages',
    'config',
);
foreach ( $core_files as $file ) {
    include __DIR__ . '/skeleton/core/' . $file . '.php';
}


/*------------------------------------*\
    Modules
\*------------------------------------*/
$modules = array(
	'utils',
	'modules',
	'settings',
);
include_folders( __DIR__ . '/skeleton', $modules );


/*------------------------------------*\
    Src files
\*------------------------------------*/
include( SRC_DIR . '/includes/core/load.php' );

add_action( 'init', function() {
    include( SRC_DIR . '/includes/init/load.php' );
});
