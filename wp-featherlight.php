<?php
/**
 * Plugin Name:  WP Featherlight
 * Plugin URI:   http://www.wpsitecare.com/wp-featherlight/
 * Description:  An ultra lightweight jQuery lightbox for WordPress images and galleries.
 * Version:      0.1.1
 * Author:       Robert Neu
 * Author URI:   http://robneu.com
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  wp-featherlight
 * Domain Path:  /languages
 * Git URI:      https://github.com/wpsitecare/wp-featherlight
 * GitHub Plugin URI: https://github.com/wpsitecare/wp-featherlight
 * GitHub Branch: master
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

define( 'WP_FEATHERLIGHT_FILE', __FILE__ );
define( 'WP_FEATHERLIGHT_VERSION', '0.1.1' );

if ( ! defined( 'WP_FEATHERLIGHT_DIR' ) ) {
	define( 'WP_FEATHERLIGHT_DIR', plugin_dir_path( WP_FEATHERLIGHT_FILE ) );
}

if ( ! defined( 'WP_FEATHERLIGHT_URL' ) ) {
	define( 'WP_FEATHERLIGHT_URL', plugin_dir_url( WP_FEATHERLIGHT_FILE ) );
}

// Load the main plugin class.
require_once WP_FEATHERLIGHT_DIR . 'includes/plugin.php';

/**
 * Allow themes and plugins to access WP_Featherlight methods and properties.
 *
 * Because we aren't using a singleton pattern for our main plugin class, we
 * need to make sure it's only instantiated once in our helper function.
 * If you need to access methods inside the plugin classes, use this function.
 *
 * Example:
 *
 * <?php wp_featherlight()->meta; ?>
 *
 * @since  0.1.0
 * @access public
 * @uses   WP_Featherlight
 * @return object WP_Featherlight A single instance of the main plugin class.
 */
function wp_featherlight() {
	static $plugin;
	if ( null === $plugin ) {
		$plugin = new WP_Featherlight;
	}
	return $plugin;
}

/**
 * Register an activation hook to run all necessary plugin setup procedures.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
register_activation_hook(
	WP_FEATHERLIGHT_FILE,
	array( wp_featherlight(), 'activate' )
);

// Hook the main plugin class into WordPress to get things running.
add_action( 'plugins_loaded', array( wp_featherlight(), 'run' ) );
