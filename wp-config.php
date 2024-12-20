<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mywordpress' );

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
define( 'AUTH_KEY',         'jH~^kAlH>8}N[>hcOz@PRNB`]@0y+88(#D_%imFISkGggD#O^f}Z-axhYKt9Z1Y>' );
define( 'SECURE_AUTH_KEY',  'VeN:.@AP2<+3k+MzTq/|+l=a#B.H Z&c17T27uL>a;~I^pAx,L#7ILDkVe#jphY*' );
define( 'LOGGED_IN_KEY',    'P4`<B3?m>;~w44R7IJbxK3Pk6nF7J}^X&EH:xB8T:lsw</fvLC9V3y=KTW{gROx>' );
define( 'NONCE_KEY',        'jmaS(OlV}| k$L:lW?~xZIr&-Pmkb2;E;4WEycs9Y`a=AqfRgwRkr*iAVC$EtIc]' );
define( 'AUTH_SALT',        'V$@_$mr7W@;lxP@TncPrYs}dmb_cPGu 5:Tjo>;yU#hHYBn:Wer X7?gMk,`T+E:' );
define( 'SECURE_AUTH_SALT', 'd)X;}J|Ct6a7rM/hAeP><f5+4*7Gn:rU.^Fk>sf|H~ToWTi3dp+ErnauBxH_U$Dg' );
define( 'LOGGED_IN_SALT',   '(c%vw*Ex]/*}Ccj})%j!efUmDyxtF:vhb2yYP=o-3qYXost|U/:}A)]dnE]UQ,vo' );
define( 'NONCE_SALT',       '1gwkvDAKc8$_]$ b[wSJHirUIY`{P~D#5d=RRn(Wiu]j4$ke6*J2z!&WP%/)wd8j' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
