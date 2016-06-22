<?php
/**
 * Plugin Name:  WP Featherlight
 * Plugin URI:   http://www.wpsitecare.com/wp-featherlight/
 * Description:  An ultra lightweight jQuery lightbox for WordPress images and galleries.
 * Version:      0.3.0
 * Author:       WP Site Care
 * Author URI:   http://www.wpsitecare.com
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  wp-featherlight
 * Domain Path:  /languages
 *
 * @package   WPFeatherlight
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * The current version of the plugin.
 *
 * @since 0.1.0
 */
define( 'WP_FEATHERLIGHT_VERSION', '0.3.0' );

/**
 * The absolute path to the root plugin file.
 *
 * @since 0.1.0
 */
define( 'WP_FEATHERLIGHT_FILE', __FILE__ );

if ( ! defined( 'WP_FEATHERLIGHT_DIR' ) ) {
	/**
	 * The absolute path to the plugin's root directory with a trailing slash.
	 *
	 * @since 0.1.0
	 * @uses  plugin_dir_path()
	 */
	define( 'WP_FEATHERLIGHT_DIR', plugin_dir_path( WP_FEATHERLIGHT_FILE ) );
}

if ( ! defined( 'WP_FEATHERLIGHT_URL' ) ) {
	/**
	 * The absolute path to the plugin's root directory with a trailing slash.
	 *
	 * @since 0.1.0
	 * @uses  plugin_dir_url()
	 */
	define( 'WP_FEATHERLIGHT_URL', plugin_dir_url( WP_FEATHERLIGHT_FILE ) );
}

require_once WP_FEATHERLIGHT_DIR . 'includes/language.php';
require_once WP_FEATHERLIGHT_DIR . 'includes/deprecated.php';
require_once WP_FEATHERLIGHT_DIR . 'includes/scripts.php';
require_once WP_FEATHERLIGHT_DIR . 'admin/meta.php';

add_action( 'plugins_loaded', 'wp_featherlight' );
/**
 * Load global functionality.
 *
 * @since  0.1.0
 * @access public
 * @uses   WP_Featherlight
 * @return WP_Featherlight
 */
function wp_featherlight() {
	require_once WP_FEATHERLIGHT_DIR . 'includes/init.php';

	static $plugin;

	if ( null === $plugin ) {
		$plugin = new WP_Featherlight( array() );
		$plugin->run();
	}

	return $plugin;
}

add_action( 'plugins_loaded', 'wp_featherlight_admin' );
/**
 * Load admin functionality.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function wp_featherlight_admin() {
	if ( is_admin() ) {
		require_once WP_FEATHERLIGHT_DIR . 'admin/init.php';
	}
}
