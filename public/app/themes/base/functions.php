<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! isset( $content_width ) ) {

    $content_width = display_sidebar() ? 900 : 1200;

}

include SRC_DIR . '/includes/load.php';