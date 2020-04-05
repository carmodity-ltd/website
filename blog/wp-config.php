<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitnami_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'bn_wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', '8dda70506f' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '157670d7982f44e9eb679a3bc96a5c7b66eb5f9c5c32df46f91801e3690d0a7b');
define('SECURE_AUTH_KEY', 'fe1a0de1392a04a2ce90e79d2547af284fe637537bd65444ce8fca07215cefb8');
define('LOGGED_IN_KEY', '4046259b655ef7a9456da2530bccbb62dd5d0ae054b9044e34071a0353048c3c');
define('NONCE_KEY', '3b813fd5b28126f3784cb6653a82e13fe63d7625c5606b3edc08125a3b8ee4d7');
define('AUTH_SALT', '8bdd0c81f7d23f978add31d4cc585fef40e7e55d6fddcbbafc60914d6066db02');
define('SECURE_AUTH_SALT', '057b6244fb5bf35ef35788e22ea037652286ea2540359b7de88d6811f46b9c0d');
define('LOGGED_IN_SALT', '5126ad8e30fd7dbdc3d876291e2c85e09439feb4c61e8d173de776a144418eeb');
define('NONCE_SALT', 'c21222e1820fb54719c0420ba47b241238e987ca67cfe903a2495700f6c7c33b');

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

define('FS_METHOD', 'direct');

/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','https://example.com');
 *  define('WP_SITEURL','https://example.com');
 *
*/

if ( defined( 'WP_CLI' ) ) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

define('WP_SITEURL','https://' . $_SERVER['HTTP_HOST'] . '/blog');
define('WP_HOME','https://' . $_SERVER['HTTP_HOST'] . '/blog');


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

define('WP_TEMP_DIR', '/opt/bitnami/apps/wordpress/tmp');


//  Disable pingback.ping xmlrpc method to prevent Wordpress from participating in DDoS attacks
//  More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/

if ( !defined( 'WP_CLI' ) ) {
    // remove x-pingback HTTP header
    add_filter('wp_headers', function($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
    // disable pingbacks
    add_filter( 'xmlrpc_methods', function( $methods ) {
            unset( $methods['pingback.ping'] );
            return $methods;
    });
    add_filter( 'auto_update_translation', '__return_false' );
}
