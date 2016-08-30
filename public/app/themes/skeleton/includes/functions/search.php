<?php

add_action('template_redirect', 'search_redirect');
function search_redirect() {
  global $wp_rewrite;

  if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() ) {
    return;
  }

  $search_base = $wp_rewrite->search_base;
  if ( is_search() && ! is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
    wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var('s') ) ) );
    exit();
  }
}


// Fix for empty search queries redirecting to home page
add_filter('request', 'search_request_filter');
function search_request_filter( $query_vars ) {
  if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
    $query_vars['s'] = ' ';
  }

  return $query_vars;
}

// Redirect to templates/searchform
add_filter('get_search_form', 'get_new_search_form');
function get_new_search_form( $form ) {
  $form = '';
  locate_template('/views/searchform.php', true, false);
  return $form;
}