<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'login_head', 'login_styles' );
function login_styles() {
    $filename = 'login' . (WP_DEBUG ? '' : '.min') . (defined('LOGIN_CSS_VERSION') ? '.' . LOGIN_CSS_VERSION : '' ) . 'css';
    ?>
    <link rel="stylesheet" id="login-css" href="<?= assets_url('css'); ?>/<?=$filename?>" media="all">
    <?php
}

add_filter( 'style_loader_tag', 'remove_useless_style_tag' );
function remove_useless_style_tag( $tag ) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

function wp_enqueue_async_style( $handle, $src = false, $deps = array(), $ver = false, $media = 'all' ) {
    global $async_styles;

    if (!is_array($async_styles)) {
        $async_styles = array();
    }

    if ($src === false) {
        return;
    }

    if ($ver !== false) {
        $src .= "?ver={$ver}";
    }

    $async_styles[] = $src;
}

add_action( 'wp_enqueue_scripts', 'load_styles', 1000 );
function load_styles() {
    
    $fonts = get_config( 'stylesheets', array() );
    foreach( $fonts as $name => $weights ) {
        add_font_face_observer( $name, $weights );
    }
    
    $stylesheets = get_config( 'stylesheets', array() );
    foreach( $stylesheets as $name => $stylesheet ) {
        if ( false ===  $stylesheet ) {
            wp_dequeue_style( $name );
        } elseif ( isset( $stylesheet['async'] ) && $stylesheet['async'] ) {
            wp_enqueue_async_style( $name, $stylesheet['path'] );
        }else {
            wp_enqueue_style( $name, $stylesheet['path'] );
        }
    }

}
