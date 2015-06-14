<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

{% if wp_pre_config_filename is defined and wp_pre_config_filename != None %}
require_once( '{{ wp_pre_config_filename }}' );
{% endif %}



// ** MySQL settings - You can get this info from your web host ** //
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/** The name of the database for WordPress */
define( 'DB_NAME', '{{ wp_db_name }}' );

/** MySQL database username */
define( 'DB_USER', '{{ wp_db_user }}' );

/** MySQL database password */
define( 'DB_PASSWORD', '{{ wp_db_password }}' );

/** MySQL hostname */
define( 'DB_HOST', '{{ wp_db_host }}' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', 'utf8_general_ci' );





/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{{ auth_key }}' );
define( 'SECURE_AUTH_KEY',  '{{ secure_auth_key }}' );
define( 'LOGGED_IN_KEY',    '{{ logged_in_key }}' );
define( 'NONCE_KEY',        '{{ nonce_key }}' );
define( 'SECRET_KEY',       '{{ secret_key }}' );
define( 'AUTH_SALT',        '{{ auth_salt }}' );
define( 'SECURE_AUTH_SALT', '{{ secure_auth_salt }}' );
define( 'LOGGED_IN_SALT',   '{{ logged_in_salt }}' );
define( 'NONCE_SALT',       '{{ nonce_salt }}' );
define( 'SECRET_SALT',      '{{ secret_salt }}' );


/**
 * Turn off automatic updates since these are managed upstream.
 */
{% if auto_up_disable is defined %}
define( 'AUTOMATIC_UPDATER_DISABLED', {{auto_up_disable}} );
{% endif %}


/** Define AUTOMATIC Updates for Components. */
{% if core_update_level is defined %}
define( 'WP_AUTO_UPDATE_CORE', {{core_update_level}} );
{% endif %}






/**#@-*/
{% if wp_post_config_filename is defined and wp_post_config_filename != None %}
require_once( '{{ wp_post_config_filename }}' );
{% endif %}





/**************************************************************************************************************************
 FILE AND URL LOCATION CONSTANTS
 **************************************************************************************************************************/
/** Absolute path to the WordPress directory. */
! defined( 'ABSPATH' ) && define( 'ABSPATH', __DIR__ . '/' );
define( 'FS_METHOD', 'direct' );
define( 'FS_CHMOD_DIR', 0755 );
define( 'FS_CHMOD_FILE', 0644 );
define( 'WP_TEMP_DIR', __DIR__ . '/wp-content/uploads' );
define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
define( 'WP_CONTENT_URL', WP_SITEURL . '/wp-content' );
define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );
define( 'COOKIEPATH', preg_replace( '|https?://[^/]+|i', '', WP_HOME . '/' ) );
define( 'SITECOOKIEPATH', preg_replace( '|https?://[^/]+|i', '', WP_SITEURL . '/' ) );
define( 'ADMIN_COOKIE_PATH', SITECOOKIEPATH . 'wp-admin' );
define( 'PLUGINS_COOKIE_PATH', preg_replace( '|https?://[^/]+|i', '', WP_PLUGIN_URL ) );
define( 'COOKIE_DOMAIN', $_SERVER['HTTP_HOST'] );




/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );




/**************************************************************************************************************************
 INCLUSIONS AFTER LOADING WP
 **************************************************************************************************************************/
if ( ( defined( 'ISC_DEBUG' ) && ISC_DEBUG ) || ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ) {
	ini_set( 'error_reporting', 2147483647 );
}




// EOF
