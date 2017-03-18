<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', function() {

    // Nav Menus
    register_nav_menus( get_config( 'nav_menus', array() ) );

    // Scripts
    if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
    	wp_deregister_script( 'jquery' );
    	wp_register_script( 'jquery', '', array(), null, true );

        $scripts = get_config( 'scripts', array() );
        foreach( $scripts as $name => $script ) {
            wp_enqueue_script( $name, $script['path'], $script['dep'], null, true );
        }
    }

    // Private files
    $privates = get_config( 'private_files', array() );

    foreach ( $privates as $private ) {
        register_private_file( $private['url'], $private['path'], $private['cap'] );
    }
    
} );

