<?php

check_directly_access();

/*------------------------------------*\
    Function modules
\*------------------------------------*/
$includes_path = get_template_directory() . '/includes';

foreach ( glob( $includes_path . '/functions/*.php' ) as $function ) {
    include_once( $function );
}

foreach ( glob_recursive( $includes_path . '/functions/*/*.php' ) as $function ) {
    include_once( $function );
}

foreach ( glob( $includes_path . '/post-types/*.php' ) as $posttype ) {
    include_once( $posttype );
}

foreach ( glob_recursive( $includes_path . '/post-types/*/*.php' ) as $posttype ) {
    include_once( $posttype );
}

foreach ( glob( $includes_path . '/custom-fields/*.php' ) as $customfield ) {
    include_once( $customfield );
}

foreach ( glob_recursive( $includes_path . '/custom-fields/*/*.php' ) as $customfield ) {
    include_once( $customfield );
}

foreach ( glob( $includes_path . '/custom/*.php' ) as $custom ) {
    include_once( $custom );
}

foreach ( glob_recursive( $includes_path . '/custom/*/*.php' ) as $custom ) {
    include_once( $custom );
}



/*------------------------------------*\
    Content Width
\*------------------------------------*/
global $content_width;

if ( ! isset( $content_width ) ) {
    $content_width = display_sidebar() ? 660 : 1000;
}
