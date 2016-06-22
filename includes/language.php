<?php
/**
 * Load translations for the plugin.
 *
 * @package   WPFeatherlight\Internationalization
 * @author    Robert Neu
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     1.0.0
 */

/**
 * Loads translation file.
 *
 * @since  0.3.0
 * @access public
 * @return bool true when the file was found, false otherwise.
 */
function wp_featherlight_load_textdomain() {
	return load_plugin_textdomain(
		'wp-featherlight',
		false,
		dirname( plugin_basename( WP_FEATHERLIGHT_FILE ) ) . '/languages'
	);
}

/**
 * Remove translations from memory.
 *
 * @since  0.3.0
 * @access public
 * @return bool true if the text domain was loaded, false if it was not.
 */
function wp_featherlight_unload_textdomain() {
	return unload_textdomain( 'wp-featherlight' );
}

/**
 * Whether or not the language has been loaded already.
 *
 * @since  0.3.0
 * @access public
 * @return bool
 */
function wp_featherlight_is_textdomain_loaded() {
	return is_textdomain_loaded( 'wp-featherlight' );
}
