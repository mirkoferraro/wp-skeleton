<?php

function get_image_optimizer_bins() {
    $bins = array(
        'optipng_bin'   => 'BIN_OPTIPNG',
        'pngquant_bin'  => 'BIN_PNGQUANT',
        'pngcrush_bin'  => 'BIN_PNGCRUSH',
        'pngout_bin'    => 'BIN_PNGOUT',
        'gifsicle_bin'  => 'BIN_GIFSICLE',
        'jpegoptim_bin' => 'BIN_JPEGOPTIM',
        'jpegtran_bin'  => 'BIN_JPEGTRAN'
    );

    foreach ( $bins as &$def ) {
        $def = defined( $def ) ? constant($def) : false;
    }

    return $bins;
}

add_action( 'admin_notices', 'image_optimizer_bin_warning' );
function image_optimizer_bin_warning() {
    $bins = get_image_optimizer_bins();
    $undefined = [];

    foreach ( $bins as $name => $defined ) {
        if ( ! $defined ) {
            $undefined[] = $name;
        }
    }
    
    if ( ! count( $undefined ) ) {
        return;
    }

    $class = 'notice notice-warning is-dismissible';
    $message = 'The image optimizer may don\'t work properly because the following BIN path are not defined: ' . implode( ', ', $undefined );
    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}

function image_optimizer() {
    global $image_optimizer;

    if ( empty( $image_optimizer ) ) {
        $options = array(
            'ignore_errors'     => WP_ENV != 'development',
            'optipng_options'   => array( '-i0', '-o2', '-quiet' ),
            'pngquant_options'  => array( '--force' ),
            'pngcrush_options'  => array( '-reduce', '-q', '-ow' ),
            'pngout_options'    => array( '-s3', '-q', '-y' ),
            'gifsicle_options'  => array( '-b', '-O5' ),
            'jpegoptim_options' => array( '--strip-all', '--all-progressive' ),
            'jpegtran_options'  => array( '-optimize', '-progressive' )
            );
        
        foreach ( get_image_optimizer_bins() as $name => $path ) {
            if ( $path ) {
                $options[$name] = $path;
            }
        }

        $factory = new \ImageOptimizer\OptimizerFactory( $options );
            
        $image_optimizer = $factory->get();
    }

    return $image_optimizer;
}


add_action( 'attachment_updated', 'queue_optimize_attachment', 100, 1 );
add_action( 'add_attachment', 'queue_optimize_attachment', 100, 1 );
function queue_optimize_attachment( $attachment_id ) {
    CronManager::put( 'Optimize attachment #' . $attachment_id, 'optimize_attachment', [ $attachment_id ] );
}

function optimize_attachment( $attachment_id ) {
    try {
        $attachment_path = get_attached_file( $attachment_id );
        image_optimizer()->optimize( $attachment_path );

        $metadata = wp_get_attachment_metadata( $attachment_id );
        $upload_dir = wp_upload_dir()['path'] . '/';

        foreach ( $metadata['sizes'] as $thumbs ) {
            $thumb_path = $upload_dir . $thumbs['file'];
            image_optimizer()->optimize( $thumb_path );
        }
    } catch ( Exception $e ) {}
}