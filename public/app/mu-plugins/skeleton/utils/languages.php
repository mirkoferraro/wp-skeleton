<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function get_languages( $include_active = true ) {
    if ( ! function_exists( 'icl_get_languages' ) ) {
        return array();
    }

	$languages = icl_get_languages();
    
    if ( ! $include_active ) {
        $languages = array_filter( $languages, function( $lang ) {
            return ! $lang['active'];
        });
    }
    
    return $languages;
}

function get_active_language() {
    if ( ! function_exists( 'icl_get_languages' ) ) {
        return null;
    }

	$languages = icl_get_languages();
    
    foreach ( $languages as $lang ) {
        if ( $lang['active'] ) {
            return $lang;
        }
    }

    return null;
}