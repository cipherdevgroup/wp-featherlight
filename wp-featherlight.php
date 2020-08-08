<?php
/**
 * Plugin Name:  WP Featherlight
 * Plugin URI:   https://wpfeatherlight.cipherdevelopment.com
 * Description:  An ultra lightweight jQuery lightbox for WordPress images and galleries.
 * Version:      1.3.4
 * Author:       Cipher
 * Author URI:   https://cipherdevelopment.com
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  wp-featherlight
 * Domain Path:  /languages
 *
 * @package   WPFeatherlight
 * @copyright Copyright (c) 2018, Cipher Development, LLC
 * @license   GPL-2.0+
 * @since     0.1.0
 */

defined( 'WPINC' ) || die;

// Load the main plugin class.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/constants.php';

add_action( 'plugins_loaded', array( wp_featherlight(), 'run' ) );
/**
 * Allow themes and plugins to access WP_Featherlight methods and properties.
 *
 * Because we aren't using a singleton pattern for our main plugin class, we
 * need to make sure it's only instantiated once in our helper function.
 * If you need to access methods inside the plugin classes, use this function.
 *
 * Example:
 *
 * <?php wp_featherlight()->scripts; ?>
 *
 * @since  0.1.0
 * @access public
 * @uses   WP_Featherlight
 * @return object WP_Featherlight A single instance of the main plugin class.
 */
function wp_featherlight() {
	static $plugin;
	if ( null === $plugin ) {
		$plugin = new WP_Featherlight( array( 'file' => __FILE__ ) );
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
register_activation_hook( __FILE__, array( wp_featherlight(), 'activate' ) );
