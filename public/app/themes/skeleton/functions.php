<?php

check_directly_access();

/*------------------------------------*\
    Function modules
\*------------------------------------*/
$includes_path = get_template_directory() . '/includes';

$folders = array(
	'functions',
	'post-types',
	'custom-fields',
	'custom',
);

foreach ( $folders as $folder ) {
	foreach ( glob( $includes_path . '/' . $folder . '/*.php' ) as $function ) {
	    include_once( $function );
	}

	foreach ( glob_recursive( $includes_path . '/' . $folder . '/*/*.php' ) as $function ) {
	    include_once( $function );
	}
}


/*------------------------------------*\
    Content Width
\*------------------------------------*/
global $content_width;

if ( ! isset( $content_width ) ) {
    $content_width = display_sidebar() ? 660 : 1000;
}
