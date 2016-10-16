<?php

// Redirect to templates/searchform
add_filter('get_search_form', 'get_new_search_form');
function get_new_search_form( $form ) {

	locate_template('/views/searchform.php', true, false);
	return '';

}
