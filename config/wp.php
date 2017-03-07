<?php

define( 'WPLANG', 'it_IT' );
define( 'WP_LANG_DIR', PUBLIC_DIR . '/app/languages' );
define( 'WP_DEFAULT_THEME', 'base' );
define( 'WP_POST_REVISIONS', 3 ); // Number of max revisions, false to disable
define( 'WP_AUTO_UPDATE_CORE', false ); // Disable wp core updates notifications
define( 'AUTOMATIC_UPDATER_DISABLED', true ); // Disable all wp auto-updates
define( 'DISALLOW_FILE_EDIT', true ); // Disable plugins and theme editor
define( 'FS_METHOD', 'direct' ); // Force the filesystem method to use Direct File I/O
define( 'WP_USE_EXT_MYSQL', false ); // Don't use deprecated mysql module
define( 'WP_HTTP_BLOCK_EXTERNAL', true ); // Block external http requests
define( 'WP_ACCESSIBLE_HOSTS', 'api.wordpress.org,*.github.com' ); //Except this
define( 'FS_CHMOD_FILE', 0755 ); // Override file permissions
define( 'FS_CHMOD_DIR', 0644 ); // Override folder permissions
define( 'IMAGE_EDIT_OVERWRITE', true ); // Delete old versions of images
define( 'DISABLE_WP_CRON', true ); // Disable the cron system
define( 'WP_CRON_LOCK_TIMEOUT', 900 ); // Define the interval between the crons
define( 'AUTOSAVE_INTERVAL', -1 ); // Define the interval between auto-saves in wp-admin (-1: disabled)
define( 'ALLOW_UNFILTERED_UPLOADS', true ); // Allows users to upload everything
define( 'WP_ALLOW_REPAIR', false ); // In order to repair a corrupted database put this to true and visit /wp-admin/maint/repair.php
