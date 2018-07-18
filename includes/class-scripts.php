<?php
/**
 * Methods used for filtering and displaying WP Featherlight images.
 *
 * @package   WPFeatherlight\Scripts
 * @copyright Copyright (c) 2018, Cipher Development, LLC
 * @license   GPL-2.0+
 * @since     0.1.0
 */

/**
 * The main featherlight script and style loader.
 *
 * @since 0.1.0
 */
class WP_Featherlight_Scripts {

	/**
	 * Property for storing the script and style suffix.
	 *
	 * @since 0.3.0
	 * @var   string
	 */
	protected $suffix;

	/**
	 * Property for storing the plugin directory URL.
	 *
	 * @since 0.3.0
	 * @var   string
	 */
	protected $url;

	/**
	 * Property for storing the script and style version.
	 *
	 * @since 0.3.0
	 * @var   string
	 */
	protected $version;

	/**
	 * Set up class properties.
	 *
	 * @since  0.1.0
	 * @param  string $url The absolute URI path to the plugin directory.
	 * @param  string $version The version to use when loading scripts.
	 * @return void
	 */
	public function __construct( $url, $version ) {
		$this->suffix  = $this->get_suffix();
		$this->url     = $url;
		$this->version = $version;
	}

	/**
	 * Helper function for getting the script `.min` suffix for minified files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_suffix() {
		static $suffix;

		if ( null === $suffix ) {
			$debug   = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
			$enabled = (bool) apply_filters( 'wp_featherlight_enable_suffix', ! $debug );
			$suffix  = $enabled ? '.min' : '';
		}

		return $suffix;
	}

	/**
	 * Load all required CSS files on the front end.
	 *
	 * Developers can disable our CSS by filtering wp_featherlight_load_css to
	 * false within their theme or plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_css() {
		if ( ! apply_filters( 'wp_featherlight_load_css', true ) ) {
			return;
		}

		wp_enqueue_style(
			'wp-featherlight',
			"{$this->url}css/wp-featherlight{$this->suffix}.css",
			array(),
			$this->version
		);

		wp_style_add_data( 'wp-featherlight', 'rtl', 'replace' );

		wp_style_add_data( 'wp-featherlight', 'suffix', $this->suffix );
	}

	/**
	 * Helper function to determine whether or not to load a packed version of
	 * our JavaScript libraries on the front end.
	 *
	 * Developers can filter wp_featherlight_enable_packed_js to false if they
	 * are loading any of the following libraries in their theme or plugin:
	 *
	 * http://noelboss.github.io/featherlight/
	 * http://noelboss.github.io/featherlight/gallery.html
	 * https://github.com/marcandre/detect_swipe
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return bool
	 */
	protected function enable_packed_js() {
		if ( empty( $this->suffix ) ) {
			return false;
		}

		return apply_filters( 'wp_featherlight_enable_packed_js', true );
	}

	/**
	 * Load all required JavaScript files on the front end.
	 *
	 * Developers can disable our JS by filtering wp_featherlight_load_js to
	 * false within their theme or plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_js() {
		if ( ! apply_filters( 'wp_featherlight_load_js', true ) ) {
			return;
		}
		if ( $this->enable_packed_js() ) {
			$this->load_packed_js();
		} else {
			$this->load_unpacked_js();
		}
	}

	/**
	 * Load the packed and minified version of our JavaScript files. This is the
	 * preferred loading method as it saves us from adding a bunch of http
	 * requests, but it could create conflicts with some plugins and themes.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_packed_js() {
		wp_enqueue_script(
			'wp-featherlight',
			"{$this->url}js/wpFeatherlight.pkgd{$this->suffix}.js",
			array( 'jquery' ),
			$this->version,
			true
		);
	}

	/**
	 * Load all of our JS files individually to for maximum compatibility.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_unpacked_js() {
		wp_enqueue_script(
			'jquery-detect-swipe',
			"{$this->url}js/vendor/jquery.detect_swipe{$this->suffix}.js",
			array( 'jquery' ),
			'2.1.4',
			true
		);

		wp_enqueue_script(
			'featherlight',
			"{$this->url}js/vendor/featherlight{$this->suffix}.js",
			array( 'jquery-detect-swipe' ),
			'1.7.9',
			true
		);

		wp_enqueue_script(
			'featherlight-gallery',
			"{$this->url}js/vendor/featherlight.gallery{$this->suffix}.js",
			array( 'featherlight' ),
			'1.7.9',
			true
		);

		wp_enqueue_script(
			'wp-featherlight',
			"{$this->url}js/wpFeatherlight{$this->suffix}.js",
			array( 'featherlight-gallery' ),
			$this->version,
			true
		);
	}

	/**
	 * Remove all required scripts and styles on entries where the user has
	 * checked the admin option to disable the lightbox.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function maybe_disable() {
		if ( get_post_meta( get_the_ID(), 'wp_featherlight_disable', true ) ) {
			add_filter( 'wp_featherlight_load_css', '__return_false' );
			add_filter( 'wp_featherlight_load_js',  '__return_false' );
		}
	}

	/**
	 * Add custom body classes to help our script enable and disable features
	 * without creating true plugin database options.
	 *
	 * @since  0.3.0
	 * @access public
	 * @param  array $classes the existing body classes.
	 * @return array $classes the amended body classes.
	 */
	public function script_helpers( $classes ) {
		if ( apply_filters( 'wp_featherlight_captions', true ) ) {
			$classes[] = 'wp-featherlight-captions';
		}

		return $classes;
	}

	/**
	 * Get the class running!
	 *
	 * @since  0.1.0
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
}
