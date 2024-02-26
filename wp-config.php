<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wynfluencer_com' );

/** MySQL database username */
define( 'DB_USER', 'wynfluencer' );

/** MySQL database password */
define( 'DB_PASSWORD', 'RhoybecvashEshbaymityiecnaniv2' );

/** MySQL hostname */
define( 'DB_HOST', 'wynflu4.sql.ghserv.net' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'jssuki82pzcc40vupz9b38l2c58f4o' );
define( 'SECURE_AUTH_KEY',  'fvdaueurugizwf8rdqren8bdss2ct9' );
define( 'LOGGED_IN_KEY',    'eezqpcn5f08yhf7tksippstigi7jyo' );
define( 'NONCE_KEY',        'vyuvg2884ez0ggqkqui212we53b602' );
define( 'AUTH_SALT',        'pt2xlzsxduk1qgga40ze2r4jfzhc27' );
define( 'SECURE_AUTH_SALT', '3w39ktbzum5ugfigovrxnir9ntkbml' );
define( 'LOGGED_IN_SALT',   'ezmcxnymxo0twoqs5m4iycj9y12xcs' );
define( 'NONCE_SALT',       '4ccygslwhni7kd71i81zo4xn4pp9p5' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
