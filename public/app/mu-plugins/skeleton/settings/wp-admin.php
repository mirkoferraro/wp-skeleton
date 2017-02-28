<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Disable admin bar
if ( ! get_config( 'wp_admin', 'show_bar', true ) ) {
    add_filter( 'show_admin_bar', '__return_false' );
}

add_filter( 'admin_footer_text', 'modify_footer_admin' );
function modify_footer_admin () {
    echo get_config( 'wp_admin', 'footer', '' );
}

if ( ! get_config( 'wp_admin', 'heartbeat', true ) ) {
    add_action( 'init', function() {
        global $pagenow;
        if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' ) {
            wp_deregister_script( 'heartbeat' );
        }
    } );
}