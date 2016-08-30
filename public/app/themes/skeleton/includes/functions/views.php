<?php

function view( $hook, $fields = null, $include_globals = true ) {
    list( $type, $sub_type ) = get_view_type();
    $view_path               = get_view_path( $hook, $type, $sub_type );

    if ( $fields == null ) {
        $fields = get_view_fields( $view_path );
    }

    if ( ! is_array( $fields) ) {
        $fields = array();
    }

    if ( $include_globals ) {
        $fields = array_merge( get_view_global_fields(), $fields );
    }

    extract( $fields );
    include $view_path;
}

function get_view_fields( $view_path ) {
    if ( preg_match( '/views\/(.*)/', $view_path, $match ) ) {
        $path = "fields/" . $match[1];
        $path = locate_template( array( $path ), false );

        if ( $path != '' ) {
            return include $path;
        }
    }

    return array();
}

function get_view_global_fields() {
    global $view_global_fields;

    if ( $view_global_fields ) {
        return $view_global_fields;
    }

    $view_global_fields = array();
    $globals_path = locate_template( array( 'fields/globals.php' ), false );

    if ( $globals_path != '' ) {
        $view_global_fields = include $globals_path;
    }

    return $view_global_fields;
}

function get_view_path() {
    $args = func_get_args();

    if ( ! count( $args ) ) {
        throw new Exception('Invalid arguments count in get_view_path function', 1);
    }

    $slug = count( $args ) ? array_shift( $args ) : null;

    do_action( "get_template_part_{$slug}", $slug, null );

    $views = array();
    $views[] = "{$slug}";

    foreach ( $args as $arg ) {
        if ( $arg != null ) {
            $views[] = $views[ count( $views ) - 1 ] . "-{$arg}";
        }
    }

    $views = array_map( function( $tmp ) {
        return "views/" . $tmp . ".php";
    }, $views );
    
    $views = array_reverse( $views );
    
    $view = locate_template( $views, false );

    if ( $view != '' )
        return $view;

    return get_template_directory() . "/{$slug}.php";
}

function get_view_type() {
    if ( is_page_template() ) {
        return array( 'template', get_page_template_slug() );
    } elseif ( is_front_page() ) {
        return array( 'front-page', null );
    } elseif ( is_home() ) {
        return array( 'home', null );
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
        return array( 'search', null );
    } elseif ( is_author() ) {
        return array( 'author', null );
    } elseif ( is_404() ) {
        return array( '404', null );
    }

    return array();
}

function check_template( $is ) {
    $is = array_map( function( $tmp ) {
        if ( strpos( "template-", $tmp ) === 0 ) {
            return is_page_template( $tmp );
        }

        $tmp = "is_" . $tmp;
        return function_exists( $tmp ) ? $tmp() : false;
    }, $is);

    return in_array( true, $is );
}



// function get_template_path() {
//     $args = func_get_args();

//     if ( ! count($args) ) {
//         throw new Exception("Invalid arguments count in get_template_path function", 1);
//     }

//     $slug = count( $args ) ? array_shift( $args ) : null;

//     do_action( "get_template_part_{$slug}", $slug, null );

//     $templates = array();
//     $templates[] = "{$slug}";

//     foreach ( $args as $arg ) {
//         $templates[] = $templates[ count($templates) - 1 ] . "-{$arg}";
//     }

//     $templates = array_map( function( $tmp ) {
//         return "templates/" . $tmp . ".php";
//     }, $templates );
    
//     $templates = array_reverse( $templates );
    
//     $template = locate_template($templates, false);

//     if ($template != '')
//         return $template;

//     return get_template_directory() . "/{$slug}.php";
// }

// function template( $hook ) {
//     if ( is_page_template() ) {
//         return get_template_path( $hook, 'template', get_page_template_slug() );
//     } elseif ( is_front_page() ) {
//         return get_template_path( $hook, 'front-page' );
//     } elseif ( is_home() ) {
//         return get_template_path( $hook, 'home' );
//     } elseif ( is_single() ) {
//         if ( is_attachment() ) {
//             return get_template_path( $hook, 'attachment', get_post_type() );
//         } else {
//             return get_template_path( $hook, 'single', get_post_type() );
//         }
//     } elseif ( is_page() ) {
//         return get_template_path( $hook, 'page', get_post_field( 'post_name', get_post() ) );
//     } elseif ( is_archive() ) {
//         if ( is_author() ) {
//             return get_template_path( $hook, 'archive', 'author' );
//         } elseif ( is_category() ) {
//             return get_template_path( $hook, 'archive', 'category' );
//         } elseif ( is_tag() ) {
//             return get_template_path( $hook, 'archive', 'tag' );
//         } elseif ( is_tax() ) {
//             return get_template_path( $hook, 'archive', 'tax' );
//         } else {
//             return get_template_path( $hook, 'archive', get_post_type() );
//         }
//     } elseif ( is_search() ) {
//         return get_template_path( $hook, 'search' );
//     } elseif ( is_author() ) {
//         return get_template_path( $hook, 'author' );
//     } elseif ( is_404() ) {
//         return get_template_path( $hook, '404' );
//     }

//     return get_template_path( $hook );
// }