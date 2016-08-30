<?php
check_directly_access();

add_action( 'init', 'register_menu_locations' );
function register_menu_locations() {
    register_nav_menus(array(
        'header-menu'   => _t( 'Header Menu' ),
        'sidebar-menu'  => _t( 'Sidebar Menu' ),
        'footer-menu'   => _t( 'Footer Menu' ),
    ));
}

function nav_menu( $position ) {
	return wp_nav_menu(array(
		'theme_location'  => "{$position}-menu",
		'menu'            => '',
		'container'       => '',
		// 'container_class' => 'menu-header-container',
		// 'container_id'    => '',
		// 'menu_class'      => 'menu',
		// 'menu_id'         => '',
		// 'echo'            => false,
		// 'fallback_cb'     => 'wp_page_menu',
		// 'before'          => '',
		// 'after'           => '',
		// 'link_before'     => '',
		// 'link_after'      => '',
		// 'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		// 'depth'           => 0,
		// 'walker'          => ''
	));
}
