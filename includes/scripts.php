<?php
/**
 * Methods used for filtering and displaying WP Featherlight images.
 *
 * @package   WPFeatherlight\Scripts
 * @author    Robert Neu
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     1.0.0
 */

/**
 * Helper function for getting the script `.min` suffix for minified files.
 *
 * @since  0.1.0
 * @access public
 * @return string
 */
function wp_featherlight_get_suffix() {
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
function wp_featherlight_load_css() {
	if ( ! apply_filters( 'wp_featherlight_load_css', true ) ) {
		return;
	}

	$suffix = wp_featherlight_get_suffix();

	wp_enqueue_style(
		'wp-featherlight',
		WP_FEATHERLIGHT_URL . "css/wp-featherlight{$suffix}.css",
		array(),
		WP_FEATHERLIGHT_VERSION
	);

	wp_style_add_data( 'wp-featherlight', 'rtl', 'replace' );

	wp_style_add_data( 'wp-featherlight', 'suffix', $suffix );
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
function wp_featherlight_load_js() {
	if ( ! apply_filters( 'wp_featherlight_load_js', true ) ) {
		return;
	}

	if ( _wp_featherlight_enable_packed_js() ) {
		wp_featherlight_load_packed_js();
	} else {
		wp_featherlight_load_unpacked_js();
	}
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
function _wp_featherlight_enable_packed_js() {
	$suffix = wp_featherlight_get_suffix();

	if ( empty( $suffix ) ) {
		return false;
	}

	return (bool) apply_filters( 'wp_featherlight_enable_packed_js', true );
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
function wp_featherlight_load_packed_js() {
	$suffix = wp_featherlight_get_suffix();

	wp_enqueue_script(
		'wp-featherlight',
		WP_FEATHERLIGHT_URL . "js/wpFeatherlight.pkgd{$suffix}.js",
		array( 'jquery' ),
		WP_FEATHERLIGHT_VERSION,
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
function wp_featherlight_load_unpacked_js() {
	$suffix = wp_featherlight_get_suffix();
	$url    = WP_FEATHERLIGHT_URL . 'js/src/';

	wp_enqueue_script(
		'jquery-detect-swipe',
		"{$url}vendor/jquery.detect_swipe{$suffix}.js",
		array( 'jquery' ),
		'2.1.3',
		true
	);

	wp_enqueue_script(
		'featherlight',
		"{$url}vendor/featherlight{$suffix}.js",
		array( 'jquery-detect-swipe' ),
		'1.5.0',
		true
	);

	wp_enqueue_script(
		'featherlight-gallery',
		"{$url}vendor/featherlight.gallery{$suffix}.js",
		array( 'featherlight' ),
		'1.5.0',
		true
	);

	wp_enqueue_script(
		'wp-featherlight',
		"{$url}wpFeatherlight{$suffix}.js",
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
function wp_featherlight_maybe_disable_scripts_singular() {
	if ( ! is_singular() ) {
		return;
	}

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
function wp_featherlight_script_helpers( $classes ) {
	if ( (bool) apply_filters( 'wp_featherlight_captions', true ) ) {
		$classes[] = 'wp-featherlight-captions';
	}

	return $classes;
}
