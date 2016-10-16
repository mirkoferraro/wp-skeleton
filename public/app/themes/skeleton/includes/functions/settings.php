<?php
check_directly_access();

if ( function_exists( 'add_theme_support' ) ) {

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    // add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat', 'mycustom' ) );

}

if ( function_exists( 'add_image_size' ) ) {

    add_image_size( 'custom-size', 600, 400, false );

}

if ( function_exists( 'load_theme_textdomain' ) ) {

    load_theme_textdomain( get_stylesheet(), get_template_directory() . '/languages' );

}
