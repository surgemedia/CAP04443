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


// Include local configuration
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
	include(dirname(__FILE__) . '/local-config.php');
}else{
	define('WP_HOME','http://www.capricornphotography.com.au/');
	define('WP_SITEURL','http://www.capricornphotography.com.au/');
}


// // Global DB config
// if (!defined('DB_NAME')) {
// 	define('DB_NAME', 'capricor_photo_db');
// }
// if (!defined('DB_USER')) {
// 	define('DB_USER', 'capricor_photo');
// }
// if (!defined('DB_PASSWORD')) {
// 	define('DB_PASSWORD', 'v}rHpBX$9"_M?(K\3GMLs;N=Uy{@s!3^');
// }
// if (!defined('DB_HOST')) {
// 	define('DB_HOST', 'localhost');
// }


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */




/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'ZAI>~d=+R&lrE/GGCxN0lZ=9g/2=rJg~^z!;ij7o=ttYQ]14#l4I])I9O.n59BpR');
define('SECURE_AUTH_KEY',  '!BW|kzH:@FE1l3dgHUrW}ynLu CSCE8DzUBldGDy=)B^ov1b;&5--fMkl4,-+Hj5');
define('LOGGED_IN_KEY',    'D;RjpqQ+f~-K /zU4d&j]ZmMB~srzJgkx-~uUj`TY:+g1`z.bm0RAYbVjx#:^rHW');
define('NONCE_KEY',        '$}8`+T` C.;/<wx=*TI|(1}I1mPG+VG:+;~*2dwVP^_cPr## j*S;a7o@;{L`u(O');
define('AUTH_SALT',        '1<yih,G8^W|&>ZyD~#w]xe2mTZ3D&?!Q{=Hm|Ef2P-T]>76/N$<db|rHH!BY(%;-');
define('SECURE_AUTH_SALT', 'cpP (Elz)^p^^1@CbDzd=|;y{iC6fD/bKWfa0!|yoD7OaL@|A`^C/@M/UWcH,e-C');
define('LOGGED_IN_SALT',   'EFa2=Oo=C|.`}iPZyl{G8WbQ]]*GfWR8ZY6|m.bOQ+z`Cc1mPZ2V*}BU>LeEZ|--');
define('NONCE_SALT',       '_?~AaU/|Z}^[&!X_pZ--.y2_Q|]LpX4:w7Rp]dVDDnyG`S/LD>&+uyII$;duw>r+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'HApHjU_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
