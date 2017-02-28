<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('pre_get_posts', 'ignore_post_limit', 100, 1 );
function ignore_post_limit( &$query ) {
  if ( ! isset( $query->query_vars['posts_per_page'] ) ) {
    $query->query_vars['posts_per_page'] = -1;
  }
}
