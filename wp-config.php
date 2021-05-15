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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         'W1eIpErP7nuTgchzm4MeEE6CaWNFgf+1bDtN91ArYbdjR0HbRthGJ81ZYYKKHn7LR9C6HpxNZfji0YO3JAYehA==');
define('SECURE_AUTH_KEY',  '/TF56DYH2PATd/UoeTKB2NSYWDLYke0XrSdTVtE8DGPOyCLHqAu/GaGO0s+6VvqO48a3M25jRvNlTXLlm+2Eyw==');
define('LOGGED_IN_KEY',    'MoEZ3nl5a+uaAEe+hp2lpYcGHk4zAnnnI3URgUD0LQqQnJoE7fwZop9m6a4kbVUp6u6VaXvuFa8Cz7yRFl2Vew==');
define('NONCE_KEY',        'tKZdFgDHhnTLmH4AHVGSNa4GE070gZoK/SnPAMXPuXZAG3oTlYvTFS8UC2WnK1zQ+B2n8ETb52Mm+vO1dMGMTA==');
define('AUTH_SALT',        'UngStJ3WAx8c2TU7E4JpmKZywQB5CMhfK94PqQzqcRl4s0O94W5hkVEHWcqezA31jONhwaxxerV0lUi7UTGsBQ==');
define('SECURE_AUTH_SALT', 'dgyVDgXBP28BzoZnD2vimw+5XU+5FYAiAO1FK9jPokYubaYhDD/uAonZntP7lybs2fbMoQ50068RloLndFOpdQ==');
define('LOGGED_IN_SALT',   '2L5L2swhjIAmVa+3kWyk5xbruTMAvomJoZK0w2XrK5ZrtMwvATrcdYIGYGXDsZVTgwLc2c0CVH/QBXNO5/LxUA==');
define('NONCE_SALT',       'kSbMU4Dr+QcCqnqgA+jnetWyuIjemUPbe5aJNyKgbiZpv8RTvPjs6A317uCXGY9EDXECr8DtpdhmMRWCvTEskw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
