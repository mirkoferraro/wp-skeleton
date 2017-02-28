<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function nav_menu( $position, $args = array() ) {

	return wp_nav_menu( array_merge( array(
		'theme_location'  => "{$position}",
		'menu'            => '',
		'container'       => '',
	), $args ) );

}
