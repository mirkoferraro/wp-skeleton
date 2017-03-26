<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


function nav_menu( $position, $args = array() ) {
	return wp_nav_menu( array_merge( array(
		'theme_location'  => "{$position}",
	), $args ) );
}

function foundation_nav_menu( $position, $args = array() ) {
    return nav_menu( $position, array(
        'menu_class' => 'menu dropdown',
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
        'walker'     => new Foundation_Walker_Nav_Menu(),
    ) );
}

class Foundation_Walker_Nav_Menu extends Walker_Nav_Menu {
    
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );
		$output .= "{$n}{$indent}<ul class=\"vertical menu\" data-dropdown-menu>{$n}";
	}
}