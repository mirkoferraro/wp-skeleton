<?php

check_directly_access();

return array(
	'site_url'      => site_url(),
	'home_url'      => home_url(),
	'theme_url'     => get_template_directory_uri(),
	'assets_url'    => assets_url(),
	'css_url'       => assets_url('css'),
	'favicons_url'  => assets_url('favicons'),
	'font_url'      => assets_url('font'),
	'img_url'       => assets_url('img'),
	'js_url'        => assets_url('js'),
	'css_path'      => assets_path('css'),
	'favicons_path' => assets_path('favicons'),
	'font_path'     => assets_path('font'),
	'img_path'      => assets_path('img'),
	'js_path'       => assets_path('js'),
	'theme_path'    => get_template_directory(),
);