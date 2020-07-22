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
define('AUTH_KEY',         'j0h/ZJMp528GPTc1YbvAKbsfBIa41boI5ihwCXC3j8YKtBMplCdU1YWbOkHJKnVEwJeCreSc34HeUXSpBpDoAQ==');
define('SECURE_AUTH_KEY',  '2rJNHvjc1RSPvX+JLnricBOC9+AhSbJNP/GiB5wxBPOqaIhcmADw1eThp83ufWvZpkwIMG65SSOcjtD1sEPhbw==');
define('LOGGED_IN_KEY',    'JgrpWoqQAkINkS4Rq/MY8PxQbHJAUCpW4jObWORhgFn867Df1S8e5peUkcLH2gTYgdtVS6KRV0tYESKVkBiuiQ==');
define('NONCE_KEY',        '1Xs38MHONL9VA5DciAFUvt1qKzMyhmQvfVffE7oh6heMocsDAbiUaVJjkEMkVQBB961bU0R2Dj6QlKIyLNfyfA==');
define('AUTH_SALT',        'qBQZsiPMu4BsZD40ZqSPRHWyC0tZOX6b1yM5iA516oIKaNY+Jtj5vNVw1a7AfkPBwVKjdldWx0aDoCbwAdZsCQ==');
define('SECURE_AUTH_SALT', 'a4LQyPwMThqhSaW2iLTpnStNyTfRbTYH2/PuwqadLdqpU7P1j9/3xlK9QydglsfllfKQ8BeUXSB++n0+KhPuKA==');
define('LOGGED_IN_SALT',   'BEJMGq6L62ts4QTZzJZMzdjsi36mw68SlmTbNEpiGfZLzsvGdLeVS0DZQftE9TMFjh/8yfgi57sc1o2Xx+YrVA==');
define('NONCE_SALT',       'Ut/7DxIVl1mBxvvEZJs1IkNLQy9+EjrVFblMlRDMTH0ret20CxXkwQC+Dl752Jwojk8ZEi2BsUrdtaD4zoAobQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define('WP_DEBUG', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
