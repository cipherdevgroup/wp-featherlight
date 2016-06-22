<?php
/**
 * Methods used for filtering and displaying WP Featherlight images.
 *
 * @package   WPFeatherlight\Hooks
 * @author    Robert Neu
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Callback defined in includes/scripts.php
 *
 * @see wp_featherlight_load_css
 */
add_action( 'wp_enqueue_scripts', 'wp_featherlight_load_css', 20 );

/**
 * Callback defined in includes/scripts.php
 *
 * @see wp_featherlight_load_js
 */
add_action( 'wp_enqueue_scripts', 'wp_featherlight_load_js', 20 );

/**
 * Callback defined in includes/scripts.php
 *
 * @see wp_featherlight_maybe_disable_scripts_singular
 */
add_action( 'wp_enqueue_scripts', 'wp_featherlight_maybe_disable_scripts_singular', 10 );

/**
 * Callback defined in includes/scripts.php
 *
 * @see wp_featherlight_script_helpers
 */
add_action( 'body_class', 'wp_featherlight_script_helpers', 10 );
