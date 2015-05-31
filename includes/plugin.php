<?php
/**
 * Enhanced User Profiles main plugin class.
 *
 * @package   WPFeatherlight
 * @author    Robert Neu
 * @copyright Copyright (c) 2015, Robert Neu
 * @license   GPL-2.0+
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
class WP_Featherlight {

	/**
	 * An empty placeholder for referencing the scripts class.
	 *
	 * @since 0.1.0
	 * @var   object
	 */
	public $scripts;

	/**
	 * An empty placeholder for referencing the meta class.
	 *
	 * @since 0.1.0
	 * @var   object
	 */
	public $meta;

	/**
	 * Method to initialize the plugin.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function run() {
		self::load_textdomain();
		self::includes();
		self::instantiate();
	}

	/**
	 * Loads the plugin language files
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'wp-featherlight',
			false,
			dirname( plugin_basename( WP_FEATHERLIGHT_FILE ) ) . '/languages'
		);
	}

	/**
	 * Require all plugin files.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	private function includes() {
		$includes_dir = WP_FEATHERLIGHT_DIR . 'includes/';
		require_once $includes_dir . 'classes/scripts.php';
		require_once $includes_dir . 'classes/admin/meta.php';
	}

	/**
	 * Load all required files and get all of our classes running.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	private function instantiate() {
		$this->scripts = new WP_Featherlight_Scripts;
		$this->scripts->run();
		if ( ! is_admin() ) {
			return;
		}
		$this->meta = new WP_Featherlight_Admin_Meta;
		$this->meta->run();
	}

	/**
	 * Runs on plugin activation to set a default admin content label for all
	 * existing posts using the post title.
	 *
	 * @since  0.1.0
	 * @access public
	 * @global $wpdb
	 * @return void
	 */
	public function activate() {
		// Nothing yet.
	}

}
