<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * Database settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', '43e6e386fefc575d2e4bed9642d96cfa5949a54bc5e43b755ec44f3df6f4f9e7' );


/** Database hostname */

define( 'DB_HOST', 'localhost:3306' );


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

define( 'AUTH_KEY',         'l`u{9ZX}u~6;tVpaVnMZ<fdM>DrXzZ{TR*5[i)R,sSsP7M7(KRj^pI>EK|Z1Fh3%' );

define( 'SECURE_AUTH_KEY',  '*&wR>_o1?:L9N} &L!ar{}ig+8r]tg<^X;e?-V.e`}^|[5A+A=zr/#jFD7eNzj#J' );

define( 'LOGGED_IN_KEY',    ':)oOX$T<fD=tlN-33f@NbnV3j7EIp*ME Y:ngIMRJ/>PR Cr[|tL%gbccy&Q}Phx' );

define( 'NONCE_KEY',        ',sw6?cXaJBlW{93t*NG*:#S>N}LS/X[D0^4Rq=[?VS_zW2s<n7!kpH6LMPu!ZU5|' );

define( 'AUTH_SALT',        '0p~e&gASn )6fJS.]x|:8-<&1;%o3s[b!z,-n9a?4^~JnvFpXbn+oO67Ksp;UacK' );

define( 'SECURE_AUTH_SALT', 'r[ws24{eFBDqAkFr]_]DF{fT0/W+~!v5,Nee1b@M#g|)k=!kFxoIKNKg [gtc;>m' );

define( 'LOGGED_IN_SALT',   'FVu&lB+zr(pU=LB.|#5X;2, 6p5S)G6o3;+X@O/y}mJX6*R>OW0pnF@tQC;pVSC0' );

define( 'NONCE_SALT',       'iw)Fa}+k/n1di)NsSjjvY=fP{0^5If)[lyb{;vZ%NWV =A5([a]-PGj8L. S+ M9' );


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




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
