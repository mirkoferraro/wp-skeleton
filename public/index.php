<?php
$loader = __DIR__ . '/core/wp-blog-header.php';

if ( ! file_exists( $loader ) ) {
    die( 'WordPress is not installed. Use <i>wp core download</i> command' );
}

define( 'WP_USE_THEMES', true );
require( $loader );
