<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'wp_mail_content_type', 'force_mail_html_type', 1000 );
function force_mail_html_type() {
	return 'text/html';
}

function send_mail_template( $template, $to, $subject, $arguments, $headers = '', $attachments = array() ) {

	$to        = (array) $to;
	$arguments = (array) $arguments;
	$returns   = array();

	if ( ! count( $to ) ) {
		return false;
	}

	$subject     = apply_filters( 'skeleton_mail_subject', $subject, $template );
	$headers     = apply_filters( 'skeleton_mail_header', $headers, $template );
	$attachments = apply_filters( 'skeleton_mail_attachments', $attachments, $template );

	add_filter( 'wp_mail_from', 'skeleton_mail_address' );
	add_filter( 'wp_mail_from_name', 'skeleton_mail_name' );
	add_filter( 'wp_mail_content_type', 'skeleton_mail_content_type' );

	for ( $i = 0, $l = min( count( $to ), count( $arguments ) ); $i < $l; $i++ ) {

		$message = get_mail_template( $template, $arguments[$i] );
		$returns[]  = wp_mail( $to, $subject, $message, $headers, $attachments );

	}

	remove_filter( 'wp_mail_from', 'skeleton_mail_address' );
	remove_filter( 'wp_mail_from_name', 'skeleton_mail_name' );
	remove_filter( 'wp_mail_content_type', 'skeleton_mail_content_type' );

	return count( $returns ) == 1 ? reset ( $returns ) : $returns;

}

function get_mail_template( $template, $arguments ) {
	return ''; //TODO
}

function skeleton_mail_address() {
	return apply_filters( 'skeleton_mail_address', get_option( 'skeleton_mail_address' ) );
}

function skeleton_mail_name() {
	return apply_filters( 'skeleton_mail_name', get_option( 'skeleton_mail_name' ) );
}

function skeleton_mail_content_type() {
	return apply_filters( 'skeleton_mail_content_type', 'text/html' );
}