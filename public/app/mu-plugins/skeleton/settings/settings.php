<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'add_theme_support' ) ) {

    $supports = get_config( 'theme_support', array() );
    foreach( $supports as $support ) {
        add_theme_support( $support );
    }
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );

    $post_formats = get_config( 'post_formats', array() );
    if ( count( $post_formats ) ) {
        add_theme_support( 'post-formats', $post_formats );
    }

}

if ( function_exists( 'add_image_size' ) ) {

    $image_sizes = get_config( 'image_sizes', array() );
    foreach( $image_sizes as $size_name => $image_size ) {
        add_image_size( $size_name, $image_size['width'], $image_size['height'], $image_size['crop'] );
    }

}

if ( function_exists( 'load_theme_textdomain' ) ) {
    
    $text_domains = get_config( 'text_domains', array() );
    foreach( $text_domains as $domain => $path ) {
        load_theme_textdomain( $domain, $path );
    }

}
