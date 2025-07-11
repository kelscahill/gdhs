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
define( 'DB_NAME', 'stag41575801522' );

/** Database username */
define( 'DB_USER', 'stag41575801522' );

/** Database password */
define( 'DB_PASSWORD', 'OrD_Qal#2|Y_}' );

/** Database hostname */
define( 'DB_HOST', '10.205.19.55:3313' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'wcxTFE6@/4 nGZXx%-S#' );
define( 'SECURE_AUTH_KEY',  '9FH (62vE=k!( W_K#wJ' );
define( 'LOGGED_IN_KEY',    'n%EpP Ac1A&AaAb$T%Qc' );
define( 'NONCE_KEY',        '%IqXkbGsyOh)/XKZDLT7' );
define( 'AUTH_SALT',        '29vJr(p6hnJRx1A&pFmt' );
define( 'SECURE_AUTH_SALT', 'B@r4MCDg$/G8H%vcQ*1y' );
define( 'LOGGED_IN_SALT',   ' WBxh1b1=8z-h=@N/hG$' );
define( 'NONCE_SALT',       'GDy*dp$wCg(nDfp7*RRN' );

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
//define( 'WP_CACHE', true );
define( 'GD_SITE_CREATED', 1517530829 );
define( 'GD_RESELLER', 1 );
define( 'GD_ASAP_KEY', '93b697ac3cb6bf06fe5ed017737ae669' );
define( 'GD_CUSTOMER_ID', '91cc660e-a4a1-48fe-9f82-8e2e6f36fbc0' );
define( 'GD_CDN_ENABLED', TRUE );
define( 'GD_CDN_FULLPAGE', TRUE );
define( 'GD_GF_LICENSE_KEY', 'PM3olBKhPBw9TmG2rHGC92KdBJNu9rYh' );
define( 'GD_MIGRATED_SITE', FALSE );
define( 'GD_SITE_TOKEN', '21e2fe63-364e-49f9-8fa8-df0ed6a2fbf0' );
define( 'GD_DC_ID', 'a2n' );
define( 'GD_TEMP_DOMAIN', 'ikf.f84.myftpupload.com' );
define( 'GD_ACCOUNT_UID', '7bfa4590-4d61-458e-a444-2506a4680a0b' );
define( 'GD_HMT_SERVICE_KEY', '6a6327c3-06db-4b77-9f34-a4d0f779ad9a' );
define( 'GD_RUM_ENABLED', FALSE );
define( 'GD_PLAN_NAME', 'ultimate' );
define( 'GD_VIP', '132.148.184.3' );
define( 'GD_NEXTGEN_ENABLED', FALSE );
define( 'FS_METHOD', 'direct' );
define( 'FS_CHMOD_DIR', (0705 & ~ umask()) );
define( 'FS_CHMOD_FILE', (0604 & ~ umask()) );


/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
  define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
