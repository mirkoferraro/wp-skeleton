<?php
check_directly_access();

// Disable admin bar
add_filter( 'show_admin_bar', '__return_false' );

add_filter( 'admin_footer_text', 'modify_footer_admin' );
function modify_footer_admin () {
    echo 'Created by <a href="http://www.mirkoferraro.it">Mirko Ferraro</a>. Powered by <a href="http://www.wordpress.org">WordPress</a>';
}

add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
    global $pagenow;
    if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' ) {
        wp_deregister_script( 'heartbeat' );
    }
}