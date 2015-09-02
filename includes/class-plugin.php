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
	 * @since 0.3.0
	 * @var   string
	 */
	const VERSION = '0.3.0';

	/**
	 * Property for storing a reference to the main plugin file.
	 *
	 * @since 0.3.0
	 * @var   string
	 */
	private $file;

	/**
	 * Property for storing the plugin's directory path.
	 *
	 * @since 0.3.0
	 * @var   string
	 */
	private $dir;

	/**
	 * Property for storing the plugin directory URL.
	 *
	 * @since 0.3.0
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
	 * An empty placeholder for referencing the i18n class.
	 *
	 * @since 0.1.0
	 * @var   object
	 */
	public $i18n;

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
		$this->includes();
		$this->instantiate();
	}

	/**
	 * Retrieve the plugin version number.
	 *
	 * @since  0.3.0
	 * @access public
	 * @return string
	 */
	public function get_version() {
		return self::VERSION;
	}

	/**
	 * Retrieve a trailing slashed path to the plugin directory.
	 *
	 * @since  0.3.0
	 * @access public
	 * @return string
	 */
	public function get_file() {
		return $this->file;
	}

	/**
	 * Retrieve a trailing slashed path to the plugin directory.
	 *
	 * @since  0.3.0
	 * @access public
	 * @return string
	 */
	public function get_dir() {
		return $this->dir;
	}

	/**
	 * Retrieve a trailing slashed URL to the plugin directory.
	 *
	 * @since  0.3.0
	 * @access public
	 * @return string
	 */
	public function get_url() {
		return $this->url;
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
		require_once $this->dir . 'includes/class-i18n.php';
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
			$this->i18n = new WP_Featherlight_Language_Loader( 'wp-featherlight', $this->file );
			$this->meta = new WP_Featherlight_Admin_Meta;
			$this->i18n->run();
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
