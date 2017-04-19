<?php

function get_capabilities_by_role( $role ) {

    if ( ! $role instanceof WP_Role ) {
        $role = get_role( $role );
    }

    if ( ! $role ) {
        return null;
    }

    $capabilities = array_map( function( $cap, $active ) {
        return $active ? $cap : false;
    }, array_keys( $role->capabilities ), $role->capabilities );

    $capabilities = array_filter( $capabilities, function( $cap ) {
        return $cap;
    } );

    return $capabilities;
}

function get_origin_capabilities_by_role( $role ) {

    if ( $role instanceof WP_Role ) {
        $role = $role->name;
    }
    
    switch ( $role ) {
        case 'administrator':
            return [ 'switch_themes', 'edit_themes', 'activate_plugins', 'edit_plugins', 'edit_users', 'edit_files', 'manage_options', 'moderate_comments', 'manage_categories', 'manage_links', 'upload_files', 'import', 'unfiltered_html', 'edit_posts', 'edit_others_posts', 'edit_published_posts', 'publish_posts', 'edit_pages', 'read', 'level_10', 'level_9', 'level_8', 'level_7', 'level_6', 'level_5', 'level_4', 'level_3', 'level_2', 'level_1', 'level_0' ];
        case 'editor':
            return [ 'moderate_comments', 'manage_categories', 'manage_links', 'upload_files', 'unfiltered_html', 'edit_posts', 'edit_others_posts', 'edit_published_posts', 'publish_posts', 'edit_pages', 'read', 'level_7', 'level_6', 'level_5', 'level_4', 'level_3', 'level_2', 'level_1', 'level_0' ];
        case 'author':
            return [ 'upload_files', 'edit_posts', 'edit_published_posts', 'publish_posts', 'read', 'level_2', 'level_1', 'level_0' ];
        case 'contributor':
            return [ 'edit_posts', 'read', 'level_1', 'level_0' ];
        case 'subscriber':
            return [ 'read', 'level_0' ];
    }

    return null;
}

function copy_capabilities( $from_role, $to_role, $only_origin = false ) {
    
    if ( ! $from_role instanceof WP_Role ) {
        $from_role = get_role( $from_role );
    }
    
    if ( ! $to_role instanceof WP_Role ) {
        $to_role = get_role( $to_role );
    }

    if ( ! $from_role || ! $to_role ) {
        return false;
    }

    $capabilities = null;

    if ( $only_origin ) {
        $capabilities = get_origin_capabilities_by_role( $from_role );
    } else {
        $capabilities = get_capabilities_by_role( $from_role );
    }

    if ( ! $capabilities || ! is_array( $capabilities ) ) {
        return false;
    }

    foreach ( $capabilities as $cap ) {
        $to_role->add_cap( $cap );
    }

    return true;

}