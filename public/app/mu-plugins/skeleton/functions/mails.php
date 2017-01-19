<?php

add_filter( 'wp_mail_content_type', 'force_mail_html_type', 1000 );
function force_mail_html_type() {
	return 'text/html';
}
