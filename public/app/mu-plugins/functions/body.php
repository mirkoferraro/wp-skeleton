<?php
check_directly_access();

add_filter( 'body_class', 'change_body_class' );
function change_body_class( $classes ) {
    global $post;
    if ( is_home() ) {
        $key = array_search( 'blog', $classes );
        if ($key > -1) {
            unset( $classes[$key] );
        }
    } elseif ( is_page() || is_singular() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    }

    $remove_classes = array(
        'page-template-default',
        'page-id-' . get_option( 'page_on_front' )
    );
    $classes = array_diff( $classes, $remove_classes );

    return $classes;
}
