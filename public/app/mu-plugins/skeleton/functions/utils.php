<?php

function array_map_keys( $closure, $array ) {
	return array_reduce( $array, function ( $result, $item ) use ( $closure ) {
		$key = $closure( $item );
		$result[$key] = $item;
		return $result;
	}, array());
}