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
define('DB_NAME', 'charitustwo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'GHCd5LhB9Jo(,NkLN;=|s_EHWF>gMe;k9FjvSSK-[RZ-n>JH#CIPeWQ*GF&L],kF');
define('SECURE_AUTH_KEY',  '^G!$UbJL]YEQP@3fu5q1s4>H*3gV&j%rU?#9!{g73>/nqJ1&4OJMd6bZvxA/kw-*');
define('LOGGED_IN_KEY',    '+}K^3ZfC^3MBT?J>65^!%,uKg;Z0 ymhAjS.C$#9s6NN[b{e}[wC[&9Rs>^7P#_n');
define('NONCE_KEY',        '{F((o]YU#R_9m:98GO4iw&kgXkCPPTx#XCg]}5McvO+~RL](zBpThb@x<D7IzsSA');
define('AUTH_SALT',        'Hl0TK&6-0?MWHX^7N)n4-;0>rpuhhwO%g)I=Iha+sJg7LWb2_)p9V-%5n|bDg0Ib');
define('SECURE_AUTH_SALT', '1P [IoE/`u]0rL%>8Lf%!Gb/js|SD`[wU)]1z),Jk4+J(S^>/ujSX/n,z:[VY&4p');
define('LOGGED_IN_SALT',   'dtm8j*Cc<1/_h=+lH{|@t4s|7fR`rXsiBrP&WF[TVqTG*uc}W!=[o)/qy_?U?O.C');
define('NONCE_SALT',       'pH4Au2J,&fEJ+4,P8U/ldR}wUBs(]/8]z?kr~Q@*`uEC $~l%#u!&i]J7k]w**|7');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
