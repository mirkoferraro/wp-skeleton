<?php

function force_404() {
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    nocache_headers();
}