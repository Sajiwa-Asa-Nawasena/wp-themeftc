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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/vafh5947/public_html/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'vafh5947_wp_39dxu' );

/** MySQL database username */
define( 'DB_USER', 'vafh5947_wp_lu6nx' );

/** MySQL database password */
define( 'DB_PASSWORD', 'VJ@Y4gr3*HurV7BR' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define('AUTH_KEY', '7+zRQ|NN]N7WsO&*3uT2SDn5K+_U2x129*_*03n7l7)((G#p;~yhg&7Mv2W1I&*|');
define('SECURE_AUTH_KEY', 's]Xi%L7NLZi3-4;aZ;cbiE88JyR)#|#V29j%gpCHw%J2O01l02PwPqdH25KI3Hb1');
define('LOGGED_IN_KEY', 'C8cY6q8:XWN5jZPgm93m5+pjpYy9#-3!8&z60~J_[1KaWI*3d10bhmh--F9x3]%@');
define('NONCE_KEY', 'hP33C3F07PNq0346mT8djyRyY7@2C609-f-H-I#-g@F]:jR*FCo4C96)67M4hZcz');
define('AUTH_SALT', ')!B&41Y8Uwn1g2|6gu]4009P:g66*N7KzClG;7/2-fA!9:ujQq&k*@32h1-Up4Bk');
define('SECURE_AUTH_SALT', '@__FBAPz)Rl3cV/b69w|P9~k7VwC;8os8DYa91tql89!iH8ZP_(jv~@798Kg~s@A');
define('LOGGED_IN_SALT', '3/Ho7n_C4PzW943D&uwBWX91p-|W]5R;O9~Fm~c]e_qqVqy%2z9p-Z40F(]K!xjy');
define('NONCE_SALT', '~vt8F(!m*2F0)5@o/&|]qC+91s0L6IE7046~O%x5@J#u4ue!H#bza83#ocwPCSAA');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'xFyh7xiP_';


define('WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
