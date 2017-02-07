<?php

function array_map_keys( $closure, $array ) {
	return array_reduce( $array, function ( $result, $item ) use ( $closure ) {
		$key = $closure( $item );
		$result[$key] = $item;
		return $result;
	}, array());
}

function array_map_full( $closure, $array, $map_type = ARRAY_A ) {
	return array_reduce( $array, function ( $result, $item ) use ( $closure ) {
		$map = $closure( $item );

        if ( ARRAY_A == $map_type ) {
            $result[ $map['key'] ] = $map['item'];
        } elseif ( ARRAY_N == $map_type ) {
            $result[ $map[0] ] = $map[1];
        }

		return $result;
	}, array());
}