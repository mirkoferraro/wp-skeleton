<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('pre_get_posts', 'ignore_post_limit', 100, 1 );
function ignore_post_limit( &$query ) {
    if ( ! isset( $query->query_vars['posts_per_page'] ) ) {
        $query->query_vars['posts_per_page'] = -1;
    }
}


function db_transaction( $type ) {
    global $wpdb;

    $wpdb->hide_errors();

    switch ( $type ) {
        case 'start':
            $wpdb->query( 'START TRANSACTION' );
            break;
        case 'commit':
            $wpdb->query( 'COMMIT' );
            break;
        case 'rollback':
            $wpdb->query( 'ROLLBACK' );
            break;
    }
}

function db_transaction_start() {
    db_transaction( 'start' );
}

function db_transaction_commit() {
    db_transaction( 'commit' );
}

function db_transaction_rollback() {
    db_transaction( 'rollback' );
}