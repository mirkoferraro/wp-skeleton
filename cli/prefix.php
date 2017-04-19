<?php

if ( ! defined( 'SKELETON_CLI' ) ) {
    echo 'Invalid call, use:';
    echo 'php skeleton prefix';
    die;
}


if ( count( $argv ) !== 1 ) {
    echo 'Invalid data input';
    die;
}

global $wpdb;

$prefix_from = DB_PREFIX;
$prefix_to = array_shift( $argv ) . '_';

if ( ! file_exists( CONFIG_DIR . '/db.php' ) ) {
    echo 'Missing db.php file';
    die;
}



$tables = $wpdb->get_results( "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . DB_NAME . "'" );

$tables = array_map( function( $item ) {
    return $item->TABLE_NAME;
}, $tables );

$tables = array_filter( $tables, function( $table_name ) use ( $prefix_from ) {
    return strpos( $table_name, $prefix_from ) === 0; 
});

foreach ( $tables as $table_name ) {
    $new_table_name = $prefix_to . substr( $table_name, strlen( $prefix_from ) );
    $wpdb->query( "RENAME TABLE $table_name TO $new_table_name" );
}

$db_content = file_get_contents( CONFIG_DIR . '/db.php' );

if ( preg_match( "/define\((\s*)('|\")DB_PREFIX('|\")(\s*),(\s*)('|\")" . $prefix_from . "('|\")(\s*)\)/", $db_content, $matches ) ) {
    $db_content = str_replace( $matches[0], "define( 'DB_PREFIX', '$prefix_to' )", $db_content );
    file_put_contents( CONFIG_DIR . '/db.php', $db_content );
}

echo "Prefix changed from " . $prefix_from . " to " . $prefix_to;