<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'after_setup_theme', 'add_woocommerce_support' );
function add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_filter( 'woocommerce_ajax_variation_threshold', 'custom_woocommerce_ajax_variation_threshold', 10, 2 );
function custom_woocommerce_ajax_variation_threshold( $count, $product ) {
    return 9999;
}

add_action( 'init', 'remove_woocommerce_template_include' );
function remove_woocommerce_template_include() {
	remove_filter( 'template_include', 'WC_Template_Loader::template_loader' );
	remove_filter( 'comments_template', 'WC_Template_Loader::comments_template_loader' );
}

add_filter( 'woocommerce_login_redirect', 'warning_on_missing_wc_login_redirect', 10, 2 );
function warning_on_missing_wc_login_redirect( $redirect, $user ) {
    if ( ! empty( $redirect ) ) {
        return $redirect;
    }

    if ( in_array( 'administrator', $user->roles ) ) {
        echo 'Warning: missing WC Account page';
        exit;
    }

    return home_url();
}