<?php

check_directly_access();

if (function_exists('register_sidebar')) {

    register_sidebar(array(
        'name'          => _t('Widget Area 1'),
        'description'   => _t('Description for this widget-area...'),
        'id'            => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));

}
