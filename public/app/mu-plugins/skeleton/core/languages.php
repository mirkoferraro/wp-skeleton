<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function _t() {
	$args = func_get_args();

	if ( ! count( $args ) ) {
		return "";
	}

	$text = array_shift( $args );
	$text = translate( $text, get_stylesheet() );

	if ( count( $args ) ) {
		return vsprintf( $text, $args );
	}

	return $text;
}