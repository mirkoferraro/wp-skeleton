<?php

if ( class_exists( 'ACFD' ) && ACFD::isActive() ) {
	
	$group = new CustomGroup( 'Integrations', 'options_page == acf-options-Integrations' );
	$group->addField( 'google_analytics_id', 'Google Analytics ID', 'text' );
	$group->addField( 'google_tag_manager_id', 'Google Tag Manager ID', 'text' );
	$group->addField( 'google_api_key', 'Google API Key', 'text' );

}