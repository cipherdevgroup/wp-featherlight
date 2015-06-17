<?php
/**
 * Methods used for filtering and displaying WP Featherlight images.
 *
 * @package   WPFeatherlight
 * @author    Robert Neu
 * @copyright Copyright (c) 2015, Robert Neu
 * @license   GPL-2.0+
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

class WP_Featherlight_Scripts {

	protected $suffix;

	/**
	 * Get the class running!
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function run() {
		$this->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		self::wp_hooks();
	}

	/**
	 * Hook into WordPress.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	protected function wp_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_css' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_js' ),  20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'maybe_disable' ) );
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
			WP_FEATHERLIGHT_URL . "css/wp-featherlight{$this->suffix}.css",
			array(),
			WP_FEATHERLIGHT_VERSION
		);
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
		$this->load_packed_js();
		$this->load_unpacked_js();
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
		// Never pack JS files if SCRIPT_DEBUG is enabled.
		if ( empty( $this->suffix ) ) {
			return false;
		}
		return apply_filters( 'wp_featherlight_enable_packed_js', true );
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
		if ( ! $this->enable_packed_js() ) {
			return;
		}
		wp_enqueue_script(
			'wp-featherlight',
			WP_FEATHERLIGHT_URL . "js/dist/wpFeatherlight.pkgd{$this->suffix}.js",
			array( 'jquery' ),
			WP_FEATHERLIGHT_VERSION,
			true
		);
	}

	/**
	 * Load all of our JS files individually to for maximum compatibility.
	 *
	 * @todo Add logic to use minified versions of scripts when not debugging.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_unpacked_js() {
		if ( $this->enable_packed_js() ) {
			return;
		}
		$url = WP_FEATHERLIGHT_URL . 'js/src/';
		wp_enqueue_script(
			'jquery-detect-swipe',
			$url . 'vendor/jquery.detect_swipe.js',
			array( 'jquery' ),
			'2.0.4',
			true
		);
		wp_enqueue_script(
			'featherlight',
			$url . 'vendor/featherlight.js',
			array( 'jquery-detect-swipe' ),
			'1.2.3',
			true
		);
		wp_enqueue_script(
			'featherlight-gallery',
			$url . 'vendor/featherlight.gallery.js',
			array( 'featherlight' ),
			'1.2.3',
			true
		);
		wp_enqueue_script(
			'wp-featherlight',
			$url . 'wpFeatherlight.js',
			array( 'featherlight-gallery' ),
			WP_FEATHERLIGHT_VERSION,
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

}
