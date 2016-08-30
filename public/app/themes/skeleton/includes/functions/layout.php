<?php
check_directly_access();

function display_sidebar() {
	return ! check_template( array(
		'front_page',
		'404'
	) );
}

if ( ! isset($content_width) ) {
    $content_width = display_sidebar() ? 600 : 900;
}