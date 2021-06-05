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
define('AUTH_KEY',         'ev1Ap8yCe+roUSWL8shy7Rhqv/5SUS5X7fsQMGhZAK/LUHXzuyZvmBKBFrGKFhV3M/jyRAAI4enyUj/sFOjj2w==');
define('SECURE_AUTH_KEY',  'E3yS2KG3JBrycaPcRuVlZK8eZ92NS39yFSdqQ69faYDhBmCTA3AsHnm6yNKkP4bCgbJjTWAGQ1zB88DagaxzyA==');
define('LOGGED_IN_KEY',    'wXSfvVaj7FNoq0YksD45rQlePhl45DszPlR+e+72IaqaBM0htV7/A6vJyZwQRq7Yn9MZp/1wqhN2Joj1ilqtTw==');
define('NONCE_KEY',        'yeQ1aykG/Duwls8jr08r8C43JyVrwK5vHIbb1//O6wnSSxOLS8WF5i76bVDjcuFl/hSg4UDPjUbvbwzLD4A8HA==');
define('AUTH_SALT',        'jVWospXlPNDwVMO5hRQxun62npfeuwSOu5WuJja7o68QNcn23NOtTRVXdH951voVIahJciyU4G+76Up3X+SAbg==');
define('SECURE_AUTH_SALT', 'ZyjdMy4Ugnq4uVPyHqby12PaA8oXpyY3ZmqNRSmR3ijYuqYoLVqaqsy0677HbnrZLJ7Bhyiu/6RLHBFVN5GDdQ==');
define('LOGGED_IN_SALT',   '3u15INR1lCDbCSjeksZSXKQRePk5v9zuscElJLolArPs3gd5Qbmp9PGSNQ6ecrdalaun9ffhASm0w9d/UDmmcA==');
define('NONCE_SALT',       'cX4s5gdf8un7iW2J5LcrkisUnnzhBESgWROqlTdliA4S+R9MgrAo99OuBDiCeEwdDuMzrsEn5rSb7LhT8h35bA==');

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
