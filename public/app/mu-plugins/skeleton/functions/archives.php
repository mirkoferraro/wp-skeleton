<?php

function register_archive_page( $page_id, $post_type ) {
	global $archive_pages;

	if ( ! empty( $archive_pages ) ) {
		$archive_pages = array();
	}

	$archive_pages[$page_id] = $post_type;
}

add_action('pre_get_posts', 'pre_get_posts_archives', 100, 1 );
function pre_get_posts_archives( &$q ) {
	if ( ! $q->is_main_query() ||
		! $GLOBALS['wp_rewrite']->use_verbose_page_rules ||
		! isset( $q->queried_object->ID ) ) {
		return;
	}

	global $archive_pages;

	$post_type = $archive_pages[$q->queried_object->ID];

	if ( $post_type != null ) {
		$q->set( 'post_type', $post_type );
		$q->set( 'page', '' );
		$q->set( 'pagename', '' );

		$q->is_archive           = true;
		$q->is_post_type_archive = true;
		$q->is_singular          = false;
		$q->is_page              = false;
	}

}
