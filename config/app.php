<?php

$img              = assets_url( 'img' );
$js               = assets_url( 'js' );
$css              = assets_url( 'css' );
$main_css_version = defined( 'MAIN_CSS_VERSION' ) ? '.' . MAIN_CSS_VERSION: '';
$main_js_version  = defined( 'MAIN_JS_VERSION' ) ? '.' . MAIN_JS_VERSION : '';

$config = array(
    'avatar' => array(
        $img . '/gravatar.jpg' => 'Custom Gravatar'
    ),
    'sidebar' => array(
        'exclude' => array(
            'front_page',
            '404'
        )
    ),
    'nav_menus' => array(
        'header'   => _t( 'Header Menu' ),
        'sidebar'  => _t( 'Sidebar Menu' ),
        'footer'   => _t( 'Footer Menu' ),
    ),
    'scripts' => array(
        'main' => array(
            'path' => $js . '/main.min' . $main_js_version . '.js',
            'dep'  => array( 'jquery' )
        )
    ),
    'theme_support' => array(
        'post-thumbnails',
        'automatic-feed-links'
    ),
    'image_sizes' => array(
        'custom-size' => array(
            'width' => 600,
            'height' => 400,
            'crop' => false
        )
    ),
    'text_domains' => array(
        get_stylesheet() => get_template_directory() . '/languages'
    ),
    'sidebars' => array(
        array(
            'name'          => _t('Widget Area 1'),
            'description'   => _t('Description for this widget-area...'),
            'id'            => 'widget-area-1',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        )
    ),
    'stylesheets' => array(
        'main' => array(
            'path' => $css . '/main.min' . $main_css_version . '.css'
        )
    ),
    'fonts_face_observer' => array(
        'Lato' => array( 300, 400, 700 )
    ),
    'private_files' => array(
        array(
            'url'  => '',
            'path' => '',
            'cap'  => ''
        )
    ),
    'wp_admin' => array(
        'show_bar' => false,
        'heartbeat' => false,
        'footer' => '<a href="https://github.com/mirkoferraro/wp-skeleton" target="_blank">WpSkeleton</a> created by <a href="http://www.mirkoferraro.it" target="_blank">Mirko Ferraro</a> and powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>'
    ),
    'excerpt' => array(
        'length' => 20
    )
);