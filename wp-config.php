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
define( 'DB_NAME', 'webbanhang' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '12345' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'a7x+59+u%SMCl)Z2ILB1~a6aiv[|I.65:V u>iADoul3u: ZSS=vfw0vv8@BV,m<' );
define( 'SECURE_AUTH_KEY',  'u]]`2LV)qb{]cmE)bM[aR3(ft&jL]K<5YaAA:S+WE|,Z-*W=nmAqM|,`5R-jA$<}' );
define( 'LOGGED_IN_KEY',    '(XY%yA`EAw`OQ89sp*{Fu18{x%=PA6sk1<r5We8`t;(!1**8$g@:E!.!yo!(uy6p' );
define( 'NONCE_KEY',        '4y2B#$oHrWb.5|{Xn/Id*sAo}q<([nVIF%1_TGO+_G:zSpL*?:=WUf;SRG/kN+}e' );
define( 'AUTH_SALT',        'bnPP77IF|=c|7l0DY1} @]A;r$y [8^}BK>o!.)A+&Z>&65I3RD?t,eCe`eo}d8Q' );
define( 'SECURE_AUTH_SALT', 'Ht;R]_`M>0(7|IXU`sWua1I&8dTa y|FaI^y)W=QW3Pr<.6r TX]U`^H{hUFts<K' );
define( 'LOGGED_IN_SALT',   'Ym. meG1k~|$v0)a6{zK5m~-_{Jpcv s`6t/^5Twt-},[AX)B}GW.+VZ%P,doMjV' );
define( 'NONCE_SALT',       '4t2)KN|FM4a%_2XAu1LX<H~_77o]{=[}T`>uC>l~7>^=05gZKG4AM DX#,C3WRB|' );

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
