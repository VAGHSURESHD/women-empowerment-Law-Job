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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'woman_empowerment' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'p5-#Q%AWv7O=&^1ud~-n>L,w]l.ld0JTGe^5HQ@{BJD?qMF9_@y4kv=$Gs;=3WoF' );
define( 'SECURE_AUTH_KEY',  'yEuT)5G9y>-^IJz}9RdpFsnFtDG8[v|z:``ct)7<)sM.i5,5#uM/h|x]h9FVV%XW' );
define( 'LOGGED_IN_KEY',    'Im6.0R!MUpZ~ *gd&8IG^aU3Cwf~*!eWSk$z^F5Xyr kyke%QGlQ)qIgi012,u0A' );
define( 'NONCE_KEY',        'J]|O?]upqD.?J,#WU^!umoHDEgmK-S[Nw2|A~NT!j& XP:YFrgG|j*67{k1 *6zm' );
define( 'AUTH_SALT',        'J]~(IWbY.nfWp{B n&h>2vDa{/_Yjl2`zsRZX12]J`#|>B1K$hFP|kvsa?6wqz!~' );
define( 'SECURE_AUTH_SALT', 'S]/y8F<K]@hf)[76s|]I]{*+NCtj5%[;D--C&0t@,T9M[/B<.Q]krT@(O#J=v AV' );
define( 'LOGGED_IN_SALT',   'u8[s+$;sXO03=v@HCW3!LU?`}mT[lm.~}8^j/w<Y7;fl{R%l2tsbxuhDyn`$,T`e' );
define( 'NONCE_SALT',       '{eGS!YGSy~9bh6`ZwW~:S&Ui70<ntI[pEE{h{SK+FrJH^$g78n/!E1XQ*qgv1~P<' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
