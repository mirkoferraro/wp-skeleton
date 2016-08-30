<?php
check_directly_access();

add_action('init', 'load_scripts');
function load_scripts() {
    $path = assets_url( 'js' );
    $main_js_version = defined( 'MAIN_JS_VERSION' ) ? '.' . MAIN_JS_VERSION : '';

    if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
    	wp_deregister_script( 'jquery' );
    	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(), null, true );
        wp_enqueue_script( 'main', $path . '/main.min' . $main_js_version . '.js', array( 'jquery' ), null, true );
    }
}



