<?php
check_directly_access();

function get_multi_options( $options, $default = false ) {
    global $wpdb;

    if ( ! is_array($options) || empty( $options ) ) {
        return false;
    }

    if ( defined( 'WP_SETUP_CONFIG' ) ) {
        return false;
    }

    $values     = array();
    $installing = defined( 'WP_INSTALLING' );
    $alloptions = wp_load_alloptions();
    $notoptions = wp_cache_get( 'notoptions', 'options' );

    foreach ($options as $option_name) {
        if ( isset( $notoptions[ $option_name ] ) ) {
            $values[ $option_name ] = apply_filters( 'default_option_' . $option_name, false );
            unset($options[ $option_name ]);
        } elseif ( isset( $alloptions[ $option_name ] ) ) {
            $values[ $option_name ] = $alloptions[$option_name];
            unset($options[ $option_name ]);
        } else {
            $value = wp_cache_get( $option_name, 'options' );
            if ( false !== $value ) {
                $values[ $option_name ] = $value;
                unset($options[ $option_name ]);
            }
        }
    }

    if ( count( $options ) ) {
        $suppress = $wpdb->suppress_errors();
        $query = "SELECT option_name, option_value FROM $wpdb->options WHERE option_name IN (" . implode(',', array_fill ( 0, count($options), '%s' )) . ")";
        $results = $wpdb->get_results( $wpdb->prepare( $query, $options ) );

        if ($installing) {
            $wpdb->suppress_errors( $suppress );
        }

        foreach ($results as $row) {
            if ( is_object( $row ) ) {
                $name = $row->option_value;
                $value = $row->option_value;


                if ( 'home' == $name && '' == $value )
                    $value = get_option( 'siteurl' );

                if ( in_array( $name, array('siteurl', 'home', 'category_base', 'tag_base') ) )
                    $value = untrailingslashit( $value );

                $value = apply_filters( 'option_' . $name, maybe_unserialize( $value ) );

                $values[$name] = $value;
                wp_cache_add( $name, $value, 'options' );
            }
        }
    }

    return $values;
}
