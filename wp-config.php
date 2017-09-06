<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache








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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'yempo_yemposolutionswp');

/** MySQL database username */
define('DB_USER', 'yempo_ysuser');

/** MySQL database password */
define('DB_PASSWORD', 'Yempo123!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'MNEVmFglpdu3oksfj7DexYFUyooW8yKn9GCH8LJwohPGyeB3pRwwAG9ky2zVX00P');
define('SECURE_AUTH_KEY',  '0ml5t9D6zUTsGVSwAWxbqkMPzDFMeKD5ShN047Pe9WN1rKdbLTzqtSdTyiCnGJMf');
define('LOGGED_IN_KEY',    'SmNNR2W59yEE9y7tI0oHF7DbvZYRu2woKEeXE6wyIuNgZJ9qCjX2ntvE3oiQvNRt');
define('NONCE_KEY',        'xkhSMVbB04v27cwvN2KKRjvUPujFM7ax864phGfSfBlDpzOyavnisfUSa9D2SW50');
define('AUTH_SALT',        'LSDIJhsbwIS883MN9UjlPKQYp7Xl4cjNMleFQCxQuvuOfXSRzEfLiFEFq6oy0qf8');
define('SECURE_AUTH_SALT', 'b8i2UJDdSkOvjn6x3l6a5AvYx4JyinGbAXFlcY1IGeK2ky9O8eg0lipuUdjHWXMO');
define('LOGGED_IN_SALT',   'rg87amupQWKlRxniwsBlReVpK7id2S4k4ozqRqhN2FUTwHmrC9FZFpYSiuXgE0Ns');
define('NONCE_SALT',       'FdDDofWZqs47nTgpwMKXXgVwjDFMZTdmMyH0k7RXxrY8LteQC9wwJuRjZYFtn3oQ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
// define('WP_DEBUG', false);
 // Enable WP_DEBUG mode
define( 'WP_DEBUG', true );
define('DISALLOW_FILE_EDIT', false);

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
