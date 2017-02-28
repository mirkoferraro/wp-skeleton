<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function assets_url( $type = null ) {
	$url = home_url() . '/assets';

	if ( $type != null && in_array( $type, array( 'css', 'favicons', 'fonts', 'img', 'js' ) ) ) {
		$url .= '/' . $type;
	}

	return $url;
}

function assets_path( $type = null ) {
	$url = PUBLIC_DIR . '/assets';

	if ($type != null && in_array($type, array('css', 'favicons', 'fonts', 'img', 'js'))) {
		$url .= '/' . $type;
	}

	return $url;
}