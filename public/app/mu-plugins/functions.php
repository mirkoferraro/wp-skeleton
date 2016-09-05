<?php
/*
Plugin Name: Skeleton Extensions
Description:
Version: 1.0.0
Author: Mirko Ferraro
Author URI: http://www.mirkoferraro.it
*/

check_directly_access();

function check_directly_access() {
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }
}

function glob_recursive( $pattern, $flags = 0 ) {
    $files = glob( $pattern, $flags );
    foreach ( glob( dirname( $pattern ) . '/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir ) {
        $files = array_merge( $files, glob_recursive( $dir . '/' . basename( $pattern ), $flags ) );
    }
    return $files;
}

foreach ( glob_recursive( __DIR__ . '/functions/*.php' ) as $function ) {
    include_once( $function );
}
