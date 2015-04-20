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
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	function load_css() {
		if ( ! apply_filters( 'wp_featherlight_load_css', true ) ) {
			return;
		}
		wp_enqueue_style(
			'wp-feahterlight',
			WP_FEATHERLIGHT_URL . "css/wp-featherlight{$this->suffix}.css",
			array(),
			WP_FEATHERLIGHT_VERSION
		);
	}

	/**
	 * Load all required JavaScript files on the front end.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	function load_js() {
		if ( ! apply_filters( 'wp_featherlight_load_js', true ) ) {
			return;
		}
		$this->load_debug_js();
		$this->load_packed_js();
	}

	/**
	 * Load the default packed and minified version of our JavaScript files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	function load_packed_js() {
		if ( empty( $this->suffix ) ) {
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
	* Load the full un-minified version of our JavaScript files for debugging.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	function load_debug_js() {
		if ( ! empty( $this->suffix ) ) {
			return;
		}
		$url = WP_FEATHERLIGHT_URL . 'js/src/';
		wp_enqueue_script(
			'hammer',
			$url . 'vendor/hammer.js',
			array(),
			'2.0.4',
			true
		);
		wp_enqueue_script(
			'featherlight',
			$url . 'vendor/featherlight.js',
			array( 'jquery' ),
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
