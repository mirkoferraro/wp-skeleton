<?php

check_directly_access();

/*------------------------------------*\
    Function modules
\*------------------------------------*/
include_folders( get_template_directory() . '/includes', array(
	'functions',
	'post-types',
	'custom-fields',
	'custom',
) );


/*------------------------------------*\
    Content Width
\*------------------------------------*/
global $content_width;

if ( ! isset( $content_width ) ) {
    $content_width = display_sidebar() ? 660 : 1000;
}
