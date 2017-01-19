<?php
check_directly_access();

// Disable admin bar
add_filter( 'show_admin_bar', '__return_false' );

add_filter( 'admin_footer_text', 'modify_footer_admin' );
function modify_footer_admin () {
    echo '<a href="https://github.com/mirkoferraro/wp-skeleton" target="_blank">WpSkeleton</a> created by <a href="http://www.mirkoferraro.it" target="_blank">Mirko Ferraro</a> and powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>';
}

add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
    global $pagenow;
    if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' ) {
        wp_deregister_script( 'heartbeat' );
    }
}
