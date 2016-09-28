<?php

echo "Migration start\n";

define( 'WP_USE_THEMES', false );

require_once( __DIR__ . '/public/core/wp-load.php' );

$migrations = get_option( 'migrations' );
is_array( $migrations ) || ( $migrations = array() );

$scripts = glob( __DIR__ . '/migrations/*.php' );
$count = 0;

foreach ( $scripts as $script_path ) {
	$script_name = basename( $script_path );

	if ( ! isset( $migrations[ $script_name ] ) || $migrations[ $script_name ] == false ) {

		echo "Executing script: " . $script_name . "\n";
		include_once( $script_path );
		$migrations[ $script_name ] = date('d/m/Y H:i:s');
		$count++;
	}
}

update_option( 'migrations', $migrations );

echo "Migration end\n";
echo "Report: " . $count . " scripts executed\n";
