<?php
check_directly_access();

add_action( 'wp_enqueue_scripts', 'load_styles' );
function load_styles() {

    add_font_face_observer( 'Lato', array( 300, 400, 700 ) );
    
    $path = assets_url( 'css' );
    $main_css_version = defined( 'MAIN_CSS_VERSION' ) ? '.' . MAIN_CSS_VERSION : '';
    wp_enqueue_async_style( 'main', $path . '/main.min' . $main_css_version . '.css' );

}
