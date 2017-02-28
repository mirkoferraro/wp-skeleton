<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'template_redirect', 'private_files_redirect' );
function private_files_redirect() {

    global $private_files;

    if ( empty( $private_files ) || ! is_array( $private_files ) ) {
        return;
    }

    foreach ( $private_files as $private_file ) {

        if ( strpos( $_SERVER['REQUEST_URI'], '/' . $private_file['base_url'] . '/' ) !== false ) {

            $file = substr( $_SERVER['REQUEST_URI'], 9 );
            $path = PRIVATE_DIR . $private_file['base_path'] . $file;

            if ( file_exists( $path ) && current_user_can( $private_file['capability'] ) ) {

                header( 'Cache-Control: public' );
                header( 'Content-Type: ' . mime_content_type( $path ) );
                header( 'Content-Description: File Transfer' );
                header( 'Content-Transfer-Encoding: binary' );
                readfile( $path );
                die;

            }

        }

    }

}

function register_private_file( $base_url, $base_path, $capability ) {

    global $private_files;

    if ( empty( $private_files) || ! is_array( $private_files ) ) {
        $private_files = array();
    }

    $private_files[] = array(
        'base_url'   => $base_url,
        'base_path'  => $base_path,
        'capability' => $capability,
    );

}
