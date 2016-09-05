<?php

function view() {
    $args = func_get_args();

    if ( ! count( $args ) ) {
        throw new Exception( 'Invalid arguments count in view function', 1 );
    }

    $slug = count( $args ) ? array_shift( $args ) : null;

    do_action( "get_template_part_{$slug}", $slug, null );

    $views = array();
    $views[] = "{$slug}";

    if ( ! count( $args ) ) {
        $args = get_view_type();
    }

    foreach ( $args as $arg ) {
        if ( $arg != null && $arg ) {
            $views[] = $views[ count( $views ) - 1 ] . "-{$arg}";
        }
    }

    $views = array_map( function( $tmp ) {
        return "views/" . $tmp . ".php";
    }, $views );
    
    $views = array_reverse( $views );
    
    $view_path = locate_template( $views, false );

    extract( get_global_fields() );
    include $view_path;
}

function get_global_fields() {
    global $global_fields;
    
    if ( $global_fields ) {
        return $global_fields;
    }
    
    $global_fields = array();
    $globals_path = locate_template( array( 'globals.php' ), false );
    
    if ( $globals_path != '' ) {
        $global_fields = include $globals_path;
    }
    
    return $global_fields;
}

function get_view_type() {
    if ( is_page_template() ) {
        return array( 'template', get_page_template_slug() );
    } elseif ( is_front_page() ) {
        return array( 'front-page' );
    } elseif ( is_home() ) {
        return array( 'home' );
    } elseif ( is_single() ) {
        if ( is_attachment() ) {
            return array( 'attachment', get_post_type() );
        } else {
            return array( 'single', get_post_type() );
        }
    } elseif ( is_page() ) {
        return array( 'page', get_post_slug() );
    } elseif ( is_archive() ) {
        if ( is_author() ) {
            return array( 'archive', 'author' );
        } elseif ( is_category() ) {
            return array( 'archive', 'category' );
        } elseif ( is_tag() ) {
            return array( 'archive', 'tag' );
        } elseif ( is_tax() ) {
            return array( 'archive', 'tax' );
        } else {
            return array( 'archive', get_post_type() );
        }
    } elseif ( is_search() ) {
        return array( 'search' );
    } elseif ( is_author() ) {
        return array( 'author' );
    } elseif ( is_404() ) {
        return array( '404' );
    }

    return array();
}

function check_view_type( $is ) {
    $is = array_map( function( $tmp ) {
        if ( strpos( "template-", $tmp ) === 0 ) {
            return is_page_template( $tmp );
        }

        $tmp = "is_" . $tmp;
        return function_exists( $tmp ) ? $tmp() : false;
    }, $is);

    return in_array( true, $is );
}