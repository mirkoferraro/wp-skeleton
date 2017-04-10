<?php
$loader = __DIR__ . '/core/wp-blog-header.php';

if ( ! file_exists( $loader ) ) {
    die( 'WordPress is not installed. Use <i>wp core download</i> command' );
}

ini_set( 'error_log', dirname( __DIR__ ) . '/logs/php.log' );
define( 'WP_USE_THEMES', true );
require( $loader );
