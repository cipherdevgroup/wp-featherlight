<?php
/**
 * WP Featherlight main plugin class.
 *
 * @package   WPFeatherlight
 * @author    Robert Neu
 * @copyright Copyright (c) 2015, WP Site Care
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
	 * Property for storing the plugin version.
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	private $version = '0.1.0';

	/**
	 * Property for storing a reference to the main plugin file.
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	private $file;

	/**
	 * Property for storing the plugin's directory path.
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	private $dir;

	/**
	 * Property for storing the plugin directory URL.
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	private $url;

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

	public function __construct( $args ) {
		$this->file = $args['file'];
		$this->dir  = plugin_dir_path( $this->file );
		$this->url  = plugin_dir_url( $this->file );
	}

	/**
	 * Method to initialize the plugin.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function run() {
		self::includes();
		self::instantiate();
		if ( is_admin() ) {
			self::load_textdomain();
		}
	}

	/**
	 * Retrieve the plugin version number.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve a trailing slashed path to the plugin directory.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function get_file() {
		return $this->file;
	}

	/**
	 * Retrieve a trailing slashed path to the plugin directory.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function get_dir() {
		return $this->dir;
	}

	/**
	 * Retrieve a trailing slashed URL to the plugin directory.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function get_url() {
		return $this->url;
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
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
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
		require_once $this->dir . 'includes/class-scripts.php';
		if ( is_admin() ) {
			require_once $this->dir . 'admin/class-meta.php';
		}
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
		if ( is_admin() ) {
			$this->meta = new WP_Featherlight_Admin_Meta;
			$this->meta->run();
		}
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
