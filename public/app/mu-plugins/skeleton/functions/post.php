<?php

function get_post_slug( $post = null, $context = 'display' ) {
	return get_post_field( 'post_name', $post, $context );
}
