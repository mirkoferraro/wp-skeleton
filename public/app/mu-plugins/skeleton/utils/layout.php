<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function display_sidebar() {

	$view_types = get_config( 'sidebar', 'exclude', array() );
	return ! check_view_type( $view_types );

}