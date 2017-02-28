<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'theme_page_templates' , 'load_theme_custom_templates' );
function load_theme_custom_templates( $page_templates ) {
	
	$basename = SRC_DIR . '/views/content-template-';
	$ext      = '.php';
	$from     = strlen( $basename );
	$ext_l    = strlen( $ext );

	foreach ( glob( $basename . '*' . $ext ) as $template_path ) {
		$to = strlen( $template_path ) - $from - $ext_l;

		$template_slug = substr( $template_path, $from, $to );
		$template_name = ucfirst( str_replace( '-', ' ', $template_slug ) );

		$page_templates[ $template_slug ] = $template_name;
	}

	return $page_templates;
}

function get_custom_template( $type, $path, $name, $args = array(), $repeat = false, $return = false ) {

	if ( ! is_array( $args ) ) {
        throw new Exception( 'Invalid argument \'args\' in template function', 1 );
	}

	$name = apply_filters( "filter_{$type}_name", $name, $args );
    $args = apply_filters( "filter_{$type}_args", $args, $name );
    do_action( "get_{$type}_{$name}", $name, $args );

    $component_path = locate_template( array( "{$path}/{$name}.php" ), false );

	if ( $return ) {
		ob_start();
	}

	if ( $repeat ) {

		foreach ( $args as $sub ) {

			if ( count( $sub ) ) {
				extract( $sub );
			}

			include $component_path;

		}

	} else {

		if ( count( $args ) ) {
			extract( $args );
		}

		include $component_path;

	}

	if ( $return ) {
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

}