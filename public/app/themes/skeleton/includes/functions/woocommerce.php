<?php
check_directly_access();

add_action( 'after_setup_theme', 'add_woocommerce_support' );
function add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_filter( 'woocommerce_ajax_variation_threshold', 'custom_woocommerce_ajax_variation_threshold', 10, 2 );
function custom_woocommerce_ajax_variation_threshold($count, $product) {
    return 9999;
}

add_action( 'init', 'remove_woocommerce_template_include' );
function remove_woocommerce_template_include() {
	remove_filter( 'template_include', 'WC_Template_Loader::template_loader' );
	remove_filter( 'comments_template', 'WC_Template_Loader::comments_template_loader' );
}
