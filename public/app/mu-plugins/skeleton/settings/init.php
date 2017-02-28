<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', function() {

    // Nav Menus
    register_nav_menus( get_config( 'nav_menus', array() ) );

    // Scripts
    $path = assets_url( 'js' );
    $main_js_version = defined( 'MAIN_JS_VERSION' ) ? '.' . MAIN_JS_VERSION : '';

    if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
    	wp_deregister_script( 'jquery' );
    	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), null, true );
        wp_enqueue_script( 'main', $path . '/main.min' . $main_js_version . '.js', array( 'jquery' ), null, true );
    }

    // Private files
    $privates = get_config( 'private_files', array() );

    foreach ( $privates as $private ) {
        register_private_file( $private['url'], $private['path'], $private['cap'] );
    }
    
} );

