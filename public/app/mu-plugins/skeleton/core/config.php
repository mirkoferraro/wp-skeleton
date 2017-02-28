<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function get_config() {
    global $config;

    if ( empty( $config ) ) {
        include CONFIG_DIR . '/app.php';
    }

    $args = func_get_args();
    $count = count( $args );

    if ( count( $args ) <= 1 ) {
        return $config;
    }

    $sub_config = $config;
    $default = array_pop( $args );
    foreach ( $args as $arg ) {
        if ( ! isset( $sub_config[$arg] ) ) {
            return $default;
        }

        $sub_config = $sub_config[$arg];
    }

    if ( isset( $sub_config ) ) {
        return $sub_config;
    }

    return $default;
}

get_config();
