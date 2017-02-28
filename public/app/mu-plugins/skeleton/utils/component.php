<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function component( $name, $args = array(), $repeat = false, $return = false ) {

	get_custom_template( 'component', 'components', $name, $args, $repeat, $return );

}


function components( $name, $args, $return ) {

	if ( ! is_array( $args) ) {
		return;
	}

	component( $name, $args, true, $return );

}