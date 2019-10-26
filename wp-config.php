<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define( 'DB_NAME', 'wordpress_installer_pack' );

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
define( 'AUTH_KEY',         'Q4<;Nzk7UF$)&LE=jx/:%vLKf<bkO(T+GelFo0@5X00qi=E9!t2J(*gPcRbQ]{G}' );
define( 'SECURE_AUTH_KEY',  '/XaK0d.mlW9ZpUldX*,o~&fy,q5)4L7A{t{(|^Eo>/ux$Z1(X.#uX;oKm.CgQkII' );
define( 'LOGGED_IN_KEY',    'd~d`!O@hvD(:TgGV~X(S),ySuirkv1 C=_zPRLijO(WE|o %xW3a^kmK&y$<isDH' );
define( 'NONCE_KEY',        '@?c5*{Lu;40=Ww7U]j|ixQ9c$0AE9W<V}>5R*?fAp-qV#sWZa?{7hb`g*W,OY@9z' );
define( 'AUTH_SALT',        'PN@o)vc@D/Q>,D{BurL}}{S1Y@!bcoaq:8C:0_nR|TmYyzL&FNM78JN{5o9,5u]S' );
define( 'SECURE_AUTH_SALT', 'K:Qg1Cw^N)*9w&8F4LP`c6GuTes-uW2j!AOtCzREJh`3rUY{~j2nN5.B,.IOrq0V' );
define( 'LOGGED_IN_SALT',   'D0AW.Dc. DO^rnb<i?d~9y+hMh!`Zje|>,%`bbA$7r6E>qVMLC0$wPj.xyD((](w' );
define( 'NONCE_SALT',       '`4>tP<djE`)H,4^n80o}=L{A]^<wi0(c% B<fj#l*+Um?T,.D3]AIV2hs_*g~Gy5' );

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

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
