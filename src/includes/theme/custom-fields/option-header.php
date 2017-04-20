<?php

if ( class_exists( 'ACFD' ) && ACFD::isActive() ) {
	
	$group = new CustomGroup( 'Header', 'options_page == acf-options-Header' );
	$group->addField( 'logo', 'Logo', 'image' );
	
}