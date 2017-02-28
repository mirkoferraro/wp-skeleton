<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Remove unnecessary actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_oembed_add_discovery_links'); // Remove oembed scripts
remove_action('wp_head', 'wp_oembed_add_host_js'); // Remove oembed scripts
remove_action('rest_api_init', 'wp_oembed_register_route'); // Remove oembed scripts

// Add filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('the_generator', '__return_false'); // Remove the WordPress version from RSS feeds

// Remove unnecessary filters
remove_filter('the_content', 'wpautop'); // Remove automatics <p> tags from content
remove_filter('comment_text', 'wpautop'); // Remove automatics <p> tags from comments
remove_filter('the_excerpt', 'wpautop'); // Remove automatics <p> tags from excerpt
remove_filter('the_excerpt_embed', 'wpautop'); // Remove automatics <p> tags from excerpt
remove_filter('term_description', 'wpautop'); // Remove automatics <p> tags from term description
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10); // Remove oembed scripts

// Remove unnecessary self-closing tags
add_filter('get_avatar',          'remove_self_closing_tags'); // <img />
add_filter('comment_id_fields',   'remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'remove_self_closing_tags'); // <img />
function remove_self_closing_tags( $tag ) {
	return str_replace(' />', '>', $tag);
}

// Remove invalid rel attribute
add_filter('the_category', 'remove_category_rel');
function remove_category_rel( $the_category ) {
   return str_replace('rel="category tag"', 'rel="tag"', $the_category);
}

// Clean uploads paths
add_filter( 'upload_dir', 'clean_upload_dir' );
function clean_upload_dir( $data ) {
    return array_map( function ( $s ) {
        if ( is_string( $s ) ) {
            $s = explode( '/..', $s );
            for ( $i = 0; $i < count( $s ) - 1; $i++ ) {
                $s[$i] = substr( $s[$i], 0, strrpos( $s[$i], '/') );
            }
            $s = str_replace( WP_DOMAIN, '', implode( '', $s ) );
        }
        return $s;
    }, $data );
}

// Disable emojis
add_action( 'init', 'disable_emojis' );
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}

function disable_emojis_tinymce( $plugins ) {
    return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}

// Disallow Indexing
if (WP_ENV !== 'production' && !is_admin()) {
    add_action('pre_option_blog_public', '__return_zero');
}
