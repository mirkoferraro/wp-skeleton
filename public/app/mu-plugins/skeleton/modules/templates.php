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