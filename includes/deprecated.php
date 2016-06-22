<?php
/**
 * Define constants to preserve backwards compatibility with older versions.
 *
 * @package   WPFeatherlight\Legacy
 * @author    Robert Neu
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 *
 * @deprecated 1.0.0
 */
class WP_Featherlight {

	/**
	 * Deprecated. Do not use.
	 *
	 * @since 0.3.0
	 * @var   string
	 */
	const VERSION = WP_FEATHERLIGHT_VERSION;

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @var object
	 */
	public $scripts;

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @var object
	 */
	public $i18n;

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @var object
	 */
	public $meta;

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @param  array $args Arguments to be used when setting up properties.
	 * @return void
	 */
	public function __construct( $args ) {}

	/**
	 * Deprecated. Do not use.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function run() {
		$this->scripts = new WP_Featherlight_Scripts;

		if ( is_admin() ) {
			$this->i18n = new WP_Featherlight_Language_Loader( 'wp-featherlight', WP_FEATHERLIGHT_FILE );
			$this->meta = new WP_Featherlight_Admin_Meta;
		}
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return string
	 */
	public function get_version() {
		_deprecated_function( __METHOD__, '1.0.0', 'WP_FEATHERLIGHT_VERSION' );

		return WP_FEATHERLIGHT_VERSION;
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return string
	 */
	public function get_file() {
		_deprecated_function( __METHOD__, '1.0.0', 'WP_FEATHERLIGHT_FILE' );

		return WP_FEATHERLIGHT_FILE;
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return string
	 */
	public function get_dir() {
		_deprecated_function( __METHOD__, '1.0.0', 'WP_FEATHERLIGHT_DIR' );

		return WP_FEATHERLIGHT_DIR;
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return string
	 */
	public function get_url() {
		_deprecated_function( __METHOD__, '1.0.0', 'WP_FEATHERLIGHT_URL' );

		return WP_FEATHERLIGHT_URL;
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function activate() {
		_deprecated_function( __METHOD__, '1.0.0' );
	}
}

/**
 * Language loader class.
 *
 * @deprecated 1.0.0
 */
class WP_Featherlight_Language_Loader {

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @param string $text_domain  Name of the text domain.
	 * @param string $plugin_file Path to language files.
	 */
	public function __construct( $text_domain, $plugin_file ) {}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return bool true when the file was found, false otherwise.
	 */
	public function load() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_load_textdomain()' );

		return wp_featherlight_load_textdomain();
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return bool true if the text domain was loaded, false if it was not.
	 */
	public function unload() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_unload_textdomain()' );

		return wp_featherlight_unload_textdomain();
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return bool
	 */
	public function is_loaded() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_is_textdomain_loaded()' );

		return wp_featherlight_is_textdomain_loaded();
	}
}

/**
 * Scripts class.
 *
 * @deprecated 1.0.0
 */
class WP_Featherlight_Scripts {

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $suffix;

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $url;

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $version;

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->suffix  = wp_featherlight_get_suffix();
		$this->url     = WP_FEATHERLIGHT_URL;
		$this->version = WP_FEATHERLIGHT_VERSION;
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function run() {
		_deprecated_function( __METHOD__, '1.0.0' );
	}

	/**
	 * Hook into WordPress.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function wp_hooks() {
		_deprecated_function( __METHOD__, '1.0.0' );
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function load_css() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_load_css()' );

		wp_featherlight_load_css();
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function load_js() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_load_js()' );

		wp_featherlight_load_js();
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access protected
	 * @return bool
	 */
	protected function enable_packed_js() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_enable_packed_js()' );

		return wp_featherlight_enable_packed_js();
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function load_packed_js() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_load_packed_js()' );

		wp_featherlight_load_packed_js();
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function load_unpacked_js() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_load_unpacked_js()' );

		wp_featherlight_load_unpacked_js();
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function maybe_disable() {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_maybe_disable_post_scripts()' );

		wp_featherlight_maybe_disable_post_scripts();
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @param  array $classes the existing body classes.
	 * @return array $classes the amended body classes.
	 */
	public function script_helpers( $classes ) {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_script_helpers()' );

		return wp_featherlight_script_helpers( $classes );
	}
}

/**
 * Admin meta class.
 *
 * @deprecated 1.0.0
 */
class WP_Featherlight_Admin_Meta {

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function run() {
		_deprecated_function( __METHOD__, '1.0.0' );
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access protected
	 * @return void
	 */
	protected function wp_hooks() {
		_deprecated_function( __METHOD__, '1.0.0' );
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access protected
	 * @param  int $post_id Post ID.
	 * @return bool Whether or not this is a valid request to save our data.
	 */
	protected function validate_request( $post_id ) {
		_deprecated_function( __METHOD__, '1.0.0', '_wp_featherlight_admin_meta_validate_request()' );

		return _wp_featherlight_admin_meta_validate_request( $post_id );
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @param  string $post_type the current post type.
	 * @return void
	 */
	public function add_meta_boxes( $post_type ) {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_admin_meta_add_boxes()' );

		wp_featherlight_admin_meta_add_boxes( $post_type );
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @param WP_Post $post Post object.
	 * @return void
	 */
	public function options_callback( WP_Post $post ) {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_admin_meta_box_view()' );

		wp_featherlight_admin_meta_box_view( $post );
	}

	/**
	 * Deprecated. Do not use.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 * @param  int $post_id Post ID.
	 * @return bool Whether or not data has been saved.
	 */
	public function save_meta_boxes( $post_id ) {
		_deprecated_function( __METHOD__, '1.0.0', 'wp_featherlight_admin_meta_save()' );

		return wp_featherlight_admin_meta_save( $post_id );
	}
}
