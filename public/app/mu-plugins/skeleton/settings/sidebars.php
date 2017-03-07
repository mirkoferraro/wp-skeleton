<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'register_sidebar' ) ) {
    
	$sidebars = get_config( 'sidebar', 'items', array() );

    foreach ( $sidebars as $sidebar ) {
        register_sidebar($sidebar);
    }

}
