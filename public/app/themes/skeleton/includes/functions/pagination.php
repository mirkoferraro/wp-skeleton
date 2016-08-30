<?php
check_directly_access();

add_action('init', 'pagination');
function pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
		'base'    => str_replace($big, '%#%', get_pagenum_link($big)),
		'format'  => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total'   => $wp_query->max_num_pages
    ));
}
