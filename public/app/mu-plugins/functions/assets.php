<?php
check_directly_access();

function assets_url( $type = null ) {
    $url = home_url() . "/assets";

    if ($type != null && in_array($type, array('css', 'favicons', 'fonts', 'img', 'js'))) {
        $url .= "/" . $type;
    }

    return $url;
}

function assets_path( $type = null ) {
    $url = WP_DIR . "/assets";

    if ($type != null && in_array($type, array('css', 'favicons', 'fonts', 'img', 'js'))) {
        $url .= "/" . $type;
    }

    return $url;
}

add_action( 'wp_footer', 'print_svg_sprite', 0 );
function print_svg_sprite() {
	include WP_DIR . '/assets/img/svg-sprite.svg';
}

add_action( 'wp_footer', 'load_async_css', 1000 );
function load_async_css() {
    global $async_styles;
    $libpath = WP_DIR . '/assets/js/lib/loadcss.min.js';
    if ( is_array( $async_styles ) && count( $async_styles ) && file_exists( $libpath ) ) : ?>
    <script type="text/javascript">
        <?php
        include $libpath;
        foreach ( $async_styles as $style_src ) : ?>
            loadCSS('<?= $style_src ?>');
        <?php endforeach; ?>
    </script>
    <?php
    endif;
}

add_action( 'wp_footer', 'font_loader', 1000 );
function font_loader() {
    ?>
    <script type="text/javascript">
    <?php include WP_DIR . '/assets/js/lib/fontloader.min.js'; ?>
    fontloader.onload({
        'Lato': [400,300,700],
    });
    </script>
    <?php
}

if ( WP_ENV == 'development' ) {
    add_action( 'wp_footer', 'browser_sync_snippet', 1000 );
}
function browser_sync_snippet() {
    ?>
    <script id="__bs_script__">//<![CDATA[
        document.write("<script async src='http://localhost:3000/browser-sync/browser-sync-client.2.14.0.js'><\/script>");
    //]]></script>
    <?php


}
