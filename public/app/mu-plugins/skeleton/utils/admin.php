<?php

function admin_notice( $message, $type = 'success', $dismissible = true ) {
    if ( ! is_admin() ) {
        return;
    }

    if ( ! in_array( $type, [ 'success', 'warning', 'error', 'info' ] ) ) {
        $type = 'success';
    }
    
    $class = 'notice notice-' . $type;

    if ( $dismissible ) {
        $class .= ' is-dismissible';
    }
    
    add_action( 'admin_notices', function() use( $class, $message ) {
        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
    } );
}