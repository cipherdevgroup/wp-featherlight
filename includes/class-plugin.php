<?php
/**
 * WP Featherlight main plugin class.
 *
 * @package   WPFeatherlight
 * @copyright Copyright (c) 2018, Cipher Development, LLC
 * @license   GPL-2.0+
 * @since     0.1.0
 */

defined( 'WPINC' ) || die;

/**
 * Main plugin class.
 *
 * @since 0.1.0
 */
class WP_Featherlight {

	/**
	 * Property for storing the plugin version.
	 *
	 * @since 0.3.0
	 * @var   string
	 */
	const VERSION = '1.3.4';

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

	/**
	 * Set up class properties.
	 *
	 * @since  0.1.0
	 * @param  array $args Arguments to use when setting up class properties.
	 * @return void
	 */
	public function __construct( $args ) {
		$this->file = $args['file'];
		$this->dir  = plugin_dir_path( $this->file );
		$this->url  = plugin_dir_url( $this->file );
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
	 * Require all global plugin files.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function includes() {
		require_once $this->dir . 'includes/class-scripts.php';
	}

	/**
	 * Require all admin plugin files.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function admin_includes() {
		require_once $this->dir . 'includes/class-i18n.php';
		require_once $this->dir . 'admin/class-meta.php';
	}

	/**
	 * Load all required files and get all of our classes running.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function instantiate() {
		$this->scripts = new WP_Featherlight_Scripts( $this->url, self::VERSION );
	}

	/**
	 * Load all required files and get all of our classes running.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function admin_instantiate() {
		$this->i18n = new WP_Featherlight_Language_Loader( 'wp-featherlight', $this->file );
		$this->meta = new WP_Featherlight_Admin_Meta;
		$this->meta->run();
	}

	/**
	 * Run all global WordPress hooks.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	protected function wp_hooks() {
		/**
		 * Callback defined in includes/class-scripts.php
		 *
		 * @see WP_Featherlight_Scripts::load_css
		 */
		add_action( 'wp_enqueue_scripts', array( $this->scripts, 'load_css' ), 20 );

		/**
		 * Callback defined in includes/class-scripts.php
		 *
		 * @see WP_Featherlight_Scripts::load_js
		 */
		add_action( 'wp_enqueue_scripts', array( $this->scripts, 'load_js' ), 20 );

		/**
		 * Callback defined in includes/class-scripts.php
		 *
		 * @see WP_Featherlight_Scripts::maybe_disable
		 */
		add_action( 'wp_enqueue_scripts', array( $this->scripts, 'maybe_disable' ), 10 );

		/**
		 * Callback defined in includes/class-scripts.php
		 *
		 * @see WP_Featherlight_Scripts::script_helpers
		 */
		add_action( 'body_class', array( $this->scripts, 'script_helpers' ), 10 );
	}

	/**
	 * Run all admin WordPress hooks.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	protected function admin_wp_hooks() {
		/**
		 * Callback defined in includes/class-i18n.php
		 *
		 * @see WP_Featherlight_Language_Loader::load
		 */
		add_action( 'admin_head-plugins.php', array( $this->i18n, 'load' ), 10 );

		/**
		 * Callback defined in includes/class-i18n.php
		 *
		 * @see WP_Featherlight_Language_Loader::load
		 */
		add_action( 'post_submitbox_misc_actions', array( $this->i18n, 'load' ), 5 );

		/**
		 * Callback defined in admin/class-meta.php
		 *
		 * @see WP_Featherlight_Admin_Meta::meta_box_view
		 */
		add_action( 'post_submitbox_misc_actions', array( $this->meta, 'meta_box_view' ), 10 );

		/**
		 * Callback defined in admin/class-meta.php
		 *
		 * @see WP_Featherlight_Admin_Meta::save_meta_boxes
		 */
		add_action( 'save_post', array( $this->meta, 'save_meta_boxes' ), 10 );
	}

	/**
	 * Initialize all global functionality.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function init() {
		/**
		 * Provide reliable access to the plugin's functions and methods before
		 * the plugin's global actions, filters, and functionality are initialized.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		do_action( 'wp_featherlight_before_init' );

		$this->includes();
		$this->instantiate();
		$this->wp_hooks();

		/**
		 * Provide reliable access to the plugin's functions and methods after
		 * the plugin's global actions, filters, and functionality are initialized.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		do_action( 'wp_featherlight_after_init' );
	}

	/**
	 * Initialize all admin functionality.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function admin_init() {
		/**
		 * Provide reliable access to the plugin's functions and methods before
		 * the plugin's admin actions, filters, and functionality are initialized.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		do_action( 'wp_featherlight_admin_before_init' );

		$this->admin_includes();
		$this->admin_instantiate();
		$this->admin_wp_hooks();

		/**
		 * Provide reliable access to the plugin's functions and methods after
		 * the plugin's admin actions, filters, and functionality are initialized.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		do_action( 'wp_featherlight_admin_after_init' );
	}

	/**
	 * Initialize the plugin.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function run() {
		$this->init();
		if ( is_admin() ) {
			$this->admin_init();
		}
	}

	/**
	 * Runs on plugin activation to set a default admin content label for all
	 * existing posts using the post title.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function activate() {
		// Nothing yet.
	}
}
