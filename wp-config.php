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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bookstore' );

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
define( 'AUTH_KEY',         '46KwfnI<-BT1ewO}Q*/pO28%9xH%Z8l!){U=5B(RW6O85^SeGI?)QayhwTu.S8UT' );
define( 'SECURE_AUTH_KEY',  'Gg#tF7=Nf3DnIYs5lc9.Hl!m(~G1eOi,qcTA7TdD8,o_VMnqJnhWXX{_XhbnA~RE' );
define( 'LOGGED_IN_KEY',    'Z@7Uc9_##YNjSuV|;$]ahs^d+zdQ>PtR 9.5% _<Jm|RNX%,+>T)(~saDx|J{Uy,' );
define( 'NONCE_KEY',        'A0*g]a1zsUpDDmc5>YFF7w)nYEUeXf`b:]LE8Eyv4nqDGuC4e3Qw@Q8{c/#M|R[+' );
define( 'AUTH_SALT',        'nipZrG9eB[M/FX<FN^al1U<c6; A)H[FHs~V;8-BqrOgDvHx;BqR6dTX0Ln];qU(' );
define( 'SECURE_AUTH_SALT', '}w)%zc%1w~&L8#]Fv:y;M,^w72yNOe!Zr4Rb#|Wfc#K,3gpg*?NW/!6jCwoyGVq1' );
define( 'LOGGED_IN_SALT',   'TaaHCZ4D_~?ckCncW?rXn+~LiyHVN)3FqY4`k37vXv0*d@]-p!j@E(k!0R<^QlIC' );
define( 'NONCE_SALT',       ')i0{Z >iCO)D|>}Td^Zc>C5v;T;jH3QY1>|t{SxN<!on8rI6/P(dqZ2FN8tk^Wu2' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
