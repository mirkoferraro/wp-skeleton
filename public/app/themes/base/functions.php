<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! isset( $content_width ) ) {

    $content_width = display_sidebar() ? 900 : 1200;

}


/*------------------------------------*\
    Src files
\*------------------------------------*/
include( SRC_DIR . '/includes/theme/load.php' );