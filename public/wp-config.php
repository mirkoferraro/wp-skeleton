<?php

$root_dir    = dirname(__DIR__);
$webroot_dir = $root_dir . '/public';

 // Support for WP-CLI
$server_name = isset ( $_SERVER['SERVER_NAME'] ) ? $_SERVER['SERVER_NAME'] : '';
$server_port = isset ( $_SERVER['SERVER_PORT'] ) ? $_SERVER['SERVER_PORT'] : '';

// Project config
$config_path = '/local-config.php';

// Check for required files
if ( ! file_exists( $root_dir . '/vendor/autoload.php' ) ) {
    die( 'Missing Composer autoloader: run <i>composer install</i>' );
}

if ( ! file_exists( $root_dir . $config_path ) ) {
    die( 'Missing project config: create the <i>local-config.php</i> file' );
}

if ( ! file_exists( $root_dir . '/wp-keys.php' ) ) {
    die( 'Missing wp-keys.php: generate keys at <a href="https://api.wordpress.org/secret-key/1.1/salt/" target="_blank">https://api.wordpress.org/secret-key/1.1/salt/</a>' );
}

require_once( $root_dir . '/vendor/autoload.php' ); // Composer
require_once( $root_dir . $config_path ); // Project config
include_once( $root_dir . '/wp-keys.php' ); // Generate keys here: https://api.wordpress.org/secret-key/1.1/salt/

define( 'WP_DIR', $webroot_dir );
define( 'WPLANG', 'it_IT' );
define( 'WP_LANG_DIR', $webroot_dir . '/app/languages' );
define( 'WP_DEFAULT_THEME', 'skeleton' );

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

define( 'WP_PORT', ($server_port == 80 || $server_port == 443) ? '' : ':' . $server_port );
define( 'WP_PROTOCOL', ($server_port == 443) ? 'https://' : 'http://' );
define( 'WP_DOMAIN', WP_PROTOCOL . $server_name . WP_PORT );

define( 'WP_HOME',    WP_DOMAIN . '/' );
define( 'WP_SITEURL', WP_DOMAIN . '/core' );
define( 'CONTENT_DIR', '/app' );
define( 'WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR );
define( 'WP_CONTENT_URL', WP_DOMAIN . CONTENT_DIR );
define( 'UPLOADS', '../up' ); // Relative to WP_SITEURL

define( 'WP_ALLOW_REPAIR', false ); // In order to repair a corrupted database put this to true and visit /wp-admin/maint/repair.php

switch ( WP_ENV ) {
    case 'development':
        define( 'SAVEQUERIES', true ); // Saves the database queries into $wpdb->queries for analysis
        define( 'WP_DEBUG', true ); // Allow error reporting
        break;
    case 'production':
        ini_set('display_errors', 0); // Suppress error reporting
        define( 'WP_DEBUG_DISPLAY', false ); // Suppress error reporting
        define( 'SCRIPT_DEBUG', false ); // Be sure to load minified version of css and js files
        define( 'DISALLOW_FILE_MODS', true ); // Disable plugin and theme updates and installation

        if ( file_exists( $root_dir . '/assets_versions.php' ) ) {
            include_once( $root_dir . '/assets_versions.php' ); // Generated by gulp
        }
}

$table_prefix = DB_PREFIX;

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', $webroot_dir . '/core/' );
}

if ( defined( 'MULTISITE' ) && MULTISITE ) {
	if ( ! defined( 'SUBDOMAIN_INSTALL' ) ) {
		define( 'SUBDOMAIN_INSTALL', true );
	}

	if ( ! defined( 'DOMAIN_CURRENT_SITE' ) ) {
		define( 'DOMAIN_CURRENT_SITE', WP_DOMAIN );
	}

	if ( ! defined( 'PATH_CURRENT_SITE' ) ) {
		define( 'PATH_CURRENT_SITE', '/' );
	}

	if ( ! defined( 'SITE_ID_CURRENT_SITE' ) ) {
		define( 'SITE_ID_CURRENT_SITE', 1 );
	}

	if ( ! defined( 'BLOG_ID_CURRENT_SITE' ) ) {
		define( 'BLOG_ID_CURRENT_SITE', 1 );
	}

	if ( ! defined( 'WP_ALLOW_MULTISITE' ) ) {
		define( 'WP_ALLOW_MULTISITE', true );
	}
}

require_once( ABSPATH . 'wp-settings.php' );
