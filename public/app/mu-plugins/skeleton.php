<?php
/*
Plugin Name: Skeleton Extensions
Description:
Version: 1.0.0
Author: Mirko Ferraro
Author URI: http://www.mirkoferraro.it
*/

check_directly_access();

/*------------------------------------*\
    Core functions
\*------------------------------------*/
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

function include_folders( $base_path, $folders = array() ) {

    if ( is_array( $folders) && count( $folders) ) {

        foreach ( $folders as $folder ) {

            include_glob( $base_path . '/' . $folder );

        }

    } else {

        include_glob( $base_path );

    }

}

function include_glob( $path ) {

    foreach ( glob( $path . '/*.php' ) as $file ) {
        include_once( $file );
    }

    foreach ( glob_recursive( $path . '/*/*.php' ) as $file ) {
        include_once( $file );
    }

}

/*------------------------------------*\
    Function modules
\*------------------------------------*/
include_folders( __DIR__ . '/skeleton', array(
	'functions',
	'crons',
	'custom',
) );