<?php
define( 'WP_CACHE', true );


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
define( 'DB_NAME', 'cabinetmaster.com.vn' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'j8Ml]iSvL#OgmzQ1$7HV}cj}+yqj_^2c1?Fjr7_;$]E8VF=IQZLvz[@M/QUX|jQ0' );
define( 'SECURE_AUTH_KEY',  'v&q)p[>x@E-Yv3.|-mU!m:r}~SjAH){3,T44X#&WI(aXW:#B&.*l2-25;jCNCBgh' );
define( 'LOGGED_IN_KEY',    '@>_VGLnueno,jnJbWEe$#A8=4E7Wk3&+lLjy^Yh4]zr92:l]:_W(3# }u55-m CA' );
define( 'NONCE_KEY',        '3yMeM4XbI$mi^*i,67[WayLd9J;spzrFtA6Vbzh-BY<X@@8=9FPndb?MS^$+ut(L' );
define( 'AUTH_SALT',        'o~`r&R)`Llx#7U7~j/V+T<mMsBh:]Hf%OPN![[a2tW455,/N&IRr5.#Y}iC*U6gR' );
define( 'SECURE_AUTH_SALT', 'ZLCC,=3}V9w287J41eaO//6Dyld765/`ceNsWYn{G^Kd4F-s[5+BP%zvc#2Qo$bA' );
define( 'LOGGED_IN_SALT',   'k-BTRo{KkY?Gy*lHYC:>[uQ([8jd{|n%n?;HqD8{wEYYanDP2:F,&jTgoqIT*4K ' );
define( 'NONCE_SALT',       '31H$Jh>Eb5B {O!eC;J4;VCw#,1}nZE -i[dp=H&O+U? ?z/yl$0KUSXfB]@gtCC' );

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
