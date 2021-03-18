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
define( 'DB_NAME', 'SQU4D' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'chtFHrq1VPYSaWcW' );

/** MySQL hostname */
define( 'DB_HOST', 'devkinsta_db' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '-zYQ92?)[^BQ`89yjOiEAebOt1@>X5[JYi9gsb@n`bdXmiucp;*Z!(JllQ&w(G5b' );
define( 'SECURE_AUTH_KEY',   'Mny5q[,B*03=W59Ed-|Rjh~ZIFZ]GCbE1})#F~HP~?B),Fl>P6s ?8;jg*>0Xu|D' );
define( 'LOGGED_IN_KEY',     'HcJ>RyjQ=z9:An, 8Vd/3kIc`5geM?b&OE:=jS|w0!?H]HYq*x!tas9lJXuYDfnB' );
define( 'NONCE_KEY',         'ex0Hf=A_h&fg5h7?c,V%BDzE5Amo62 (}!8+`-qu2Jj]neCG$<ys)OsX[gxPB;&I' );
define( 'AUTH_SALT',         '$$(x$Jk:>gF~HSB)<(AVrHgT0yR0)gY6OE`|u[Xo$RrMtAp!<WpVP+K!Q02RT>-m' );
define( 'SECURE_AUTH_SALT',  'khh9[4FJuX,xu{g/5!3@HceeFM&LXJu3]RMv)`sj|aZFP=;XWMl&j1?.q|#`tu}!' );
define( 'LOGGED_IN_SALT',    'z=*4,-[&_E6#NSO7hat_T}{y}dkE3k,@+)S886TH(^)l~S,aFWQnSU?So_ 7~Tf?' );
define( 'NONCE_SALT',        'A]K(wDS&lsVMvVF)3/}D7K?B!qSbJr,Tz~okrm~6)OHJ!1}*XOG7kM^Oo|v~!jAK' );
define( 'WP_CACHE_KEY_SALT', '&TV5Un~B=yL$;PEkx}aJ6Hkx|wT!`4v=>RCa=XbLWTw3$):Az)`wWl&/<g]y:i}*' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




define( 'WP_DEBUG_DISPLAY', 'true' );
define( 'WP_DEBUG', 'true' );
define( 'WP_DEBUG_LOG', 'true' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
