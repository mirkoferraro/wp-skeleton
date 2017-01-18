<?php

function component( $name, $args = array(), $repeat = false ) {

		if ( ! is_array( $args) ) {
        throw new Exception( 'Invalid argument \'args\' in component function', 1 );
		}

    $name = apply_filters( 'filter_component_name', $name, $args );
    $args = apply_filters( 'filter_component_args', $args, $name );
    do_action( "get_component_{$name}", $name, $args );

    $component_path = locate_template( array( "components/{$name}.php" ), false );

		if ( $repeat ) {

				foreach ( $args as $sub ) {

						if ( count( $sub ) ) {
								extract( $sub );
						}

						include $component_path;

				}

		} else {

				if ( count( $args ) ) {
						extract( $args );
				}

				include $component_path;

		}

}
