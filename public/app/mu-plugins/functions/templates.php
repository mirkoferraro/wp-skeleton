<?php
check_directly_access();

add_filter( 'theme_page_templates' , 'custom_templates' );
function custom_templates( $page_templates ) {

	foreach ( glob( get_template_directory() . '/views/content-template-*.php' ) as $template_path ) {
		$from          = strlen( get_template_directory() ) + 28;
		$to            = strlen( $template_path ) - $from - 4;

		$template_slug = substr( $template_path, $from, $to );
		$template_name = ucfirst( str_replace( '-', ' ', $template_slug ) );

		$page_templates[ $template_slug ] = $template_name;
	}

	return $page_templates;
}