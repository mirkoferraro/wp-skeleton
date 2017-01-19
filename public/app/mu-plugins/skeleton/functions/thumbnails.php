<?php
check_directly_access();

add_filter( 'upload_mimes', 'cc_mime_types' );
function cc_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_action( 'admin_head', 'fix_svg_thumb_display' );
function fix_svg_thumb_display() {
    ?>
    <style>
    span.media-icon img[src$=".svg"],
    img[src$=".svg"].attachment-post-thumbnail {
        width: 100% !important;
        height: auto !important;
    }
    </style>
    <?php
}
