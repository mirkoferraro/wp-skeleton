<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function excerpt_base_length( $length ) {
    return get_config( 'excerpt', 'length', 30 );
}

function print_excerpt( $length_callback = '', $more_callback = '' ) {

    global $post;

    if ( function_exists( $length_callback ) ) {
        add_filter( 'excerpt_length', $length_callback );
    }

    if ( function_exists( $more_callback ) ) {
        add_filter( 'excerpt_more', $more_callback );
    }

    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    echo $output;

}


add_filter('excerpt_length', 'excerpt_view_article_link');
add_filter('excerpt_more', 'excerpt_view_article_link');
function excerpt_view_article_link( $more ) {

    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . _t('View Article') . '</a>';

}
