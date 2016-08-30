<?php

function is_get( $key = null ) {
    if ( $key == null ) {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    return isset( $_GET[$key] );
}

function _get( $key, $default = null ) {
    return isset( $_GET[$key] ) ? $_GET[$key] : $default;
}

function is_post( $key = null ) {
    if ( $key == null ) {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    return isset( $_POST[$key] );
}

function _post( $key, $default = null ) {
    return isset( $_POST[$key] ) ? $_POST[$key] : $default;
}