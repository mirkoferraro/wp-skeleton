<?php
check_directly_access();

if ( class_exists( 'ACFED' ) && ACFED::is_active() ) {

	ACFED::setDefaults('text', array(
		'placeholder' => 'dadssa'
	));

	$group = new CustomGroup('test', 'options_page == acf-options-test5');
	$group->addField('name', 'Name', 'text')
		  ->set('placeholder', 'fdsf432423');
	$group->addField('surname', 'Surname', 'text');
	$group->addField('email', 'E-mail', 'email');
	$group->addField('content', 'Content', 'wysiwyg');
	$repeater = $group->addContainer('repeater', 'Repeater', 'repeater');
	$repeater->addField('item', 'Item', 'text');

	
	$field = new CustomField( $name, $label, $type );
}
