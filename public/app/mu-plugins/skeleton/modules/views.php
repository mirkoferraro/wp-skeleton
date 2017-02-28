<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function get_view_hierarchy() {
	$hierarchy = array();

    if ( is_page_template() ) {

    	$template_slug = get_page_template_slug();
    	$hierarchy[] = "template-{$template_slug}";

    } elseif ( is_embed() ) {

		$object = get_queried_object();

		if ( ! empty( $object->post_type ) ) {
			$post_format = get_post_format( $object );
			if ( $post_format ) {
				$hierarchy[] = "embed-{$object->post_type}-{$post_format}.php";
			}
			$hierarchy[] = "embed-{$object->post_type}.php";
		}

		$hierarchy[] = "embed.php";

    } elseif ( is_404() ) {

		$hierarchy[] = '404.php';

    } elseif ( is_search() ) {

		$hierarchy[] = 'search.php';

    } elseif ( is_front_page() ) {

		$hierarchy[] = 'front-page.php';

    } elseif ( is_home() ) {

		$hierarchy[] = 'archive-post.php';
		$hierarchy[] = 'home.php';

    } elseif ( is_attachment() ) {

		$attachment = get_queried_object();

		if ( $attachment ) {
			if ( false !== strpos( $attachment->post_mime_type, '/' ) ) {
				list( $type, $subtype ) = explode( '/', $attachment->post_mime_type );
			} else {
				list( $type, $subtype ) = array( $attachment->post_mime_type, '' );
			}

			if ( ! empty( $subtype ) ) {
				$hierarchy[] = "{$type}-{$subtype}.php";
				$hierarchy[] = "{$subtype}.php";
			}
			$hierarchy[] = "{$type}.php";
		}
		$hierarchy[] = 'attachment.php';

    } elseif ( is_single() ) {

		$object = get_queried_object();

		if ( ! empty( $object->post_type ) ) {
			$hierarchy[] = "single-{$object->post_type}-{$object->post_name}.php";
			$hierarchy[] = "single-{$object->post_type}.php";
		}

		$hierarchy[] = "single.php";

    } elseif ( is_page() ) {

		$id = get_queried_object_id();
		$template_slug = get_page_template_slug();
		$pagename = get_query_var('pagename');

		if ( ! $pagename && $id ) {
			$post = get_queried_object();
			if ( $post )
				$pagename = $post->post_name;
		}

		if ( $template_slug && 0 === validate_file( $template_slug ) ) {
			$hierarchy[] = $template_slug;
    		$hierarchy[] = "template-{$template_slug}";
		}
		if ( $pagename ) {
			$hierarchy[] = "page-$pagename.php";
		}
		if ( $id ) {
			$hierarchy[] = "page-$id.php";
		}
		$hierarchy[] = 'page.php';

    } elseif ( is_author() ) {

		if ( $author instanceof WP_User ) {
			$hierarchy[] = "author-{$author->user_nicename}.php";
			$hierarchy[] = "author-{$author->ID}.php";
		}

		$hierarchy[] = 'author.php';

    } elseif ( is_category() ) {

		$category = get_queried_object();

		if ( ! empty( $category->slug ) ) {
			$hierarchy[] = "category-{$category->slug}.php";
			$hierarchy[] = "category-{$category->term_id}.php";
		}

		$hierarchy[] = 'category.php';

    } elseif ( is_tag() ) {

		$tag = get_queried_object();

		if ( ! empty( $tag->slug ) ) {
			$hierarchy[] = "tag-{$tag->slug}.php";
			$hierarchy[] = "tag-{$tag->term_id}.php";
		}

		$hierarchy[] = 'tag.php';

    } elseif ( is_tax() ) {

		$term = get_queried_object();

		if ( ! empty( $term->slug ) ) {
			$taxonomy = $term->taxonomy;
			$hierarchy[] = "tax-$taxonomy-{$term->slug}.php";
			$hierarchy[] = "tax-$taxonomy.php";
		}

		$hierarchy[] = 'tax.php';

    } elseif ( is_date() ) {

		$hierarchy[] = 'date.php';

    } elseif ( is_archive() ) {

		$post_types = array_filter( (array) get_query_var( 'post_type' ) );

		if ( count( $post_types ) == 1 ) {
			$post_type = reset( $post_types );
			$obj = get_post_type_object( $post_type );
			if ( $obj->has_archive ) {
				$hierarchy[] = "archive-{$post_type}.php";
			}
		}
		$hierarchy[] = 'archive.php';

    }

    return $hierarchy;
}

function view() {

    $args = func_get_args();

    if ( ! count( $args ) ) {
        throw new Exception( 'Invalid arguments count in view function', 1 );
    }

    $slug = count( $args ) ? array_shift( $args ) : null;

    do_action( "get_template_part_{$slug}", $slug, null );

    $hierarchy = array();

    if ( count( $args ) === 1 && is_array( $first = reset( $args ) ) ) {

				$hierarchy = array_map( function( $tmp ) use ( $slug ) {
						return "{$slug}-{$tmp}";
				}, $first );

				$hierarchy[] = "{$slug}";

    } elseif ( count( $args ) ) {

				$hierarchy[] = "{$slug}";

				foreach ( $args as $arg ) {
						if ( $arg != null && $arg && is_string( $arg ) ) {
							$hierarchy[] = $hierarchy[ count( $hierarchy ) - 1 ] . "-{$arg}";
						}
				}

				$hierarchy = array_reverse( $hierarchy );

    } else {

				$hierarchy = get_view_hierarchy();

				$hierarchy = array_map( function( $tmp ) use ( $slug ) {
						return "{$slug}-{$tmp}";
				}, $hierarchy );

				$hierarchy[] = "{$slug}";
    }

		$located = false;
		foreach ( $hierarchy as $template_name ) {
				if ( file_exists( SRC_DIR . '/views/' . $template_name . '.php' ) ) {
					$located = SRC_DIR . '/views/' . $template_name . '.php';
					break;
				}
		}

		if ( $located ) {
				include $located;
		}
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
