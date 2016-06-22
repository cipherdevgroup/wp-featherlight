<?php
/**
 * Initialize all admin functionality.
 *
 * @package   WPFeatherlight\Admin\Init
 * @author    Robert Neu
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Provide reliable access to the plugin's functions and methods before
 * the plugin's global actions, filters, and functionality are initialized.
 *
 * @since  1.0.0
 * @access public
 */
do_action( 'wp_featherlight_before_admin_init' );

require_once WP_FEATHERLIGHT_DIR . 'admin/actions.php';

/**
 * Provide reliable access to the plugin's functions and methods after
 * the plugin's global actions, filters, and functionality are initialized.
 *
 * @since  1.0.0
 * @access public
 */
do_action( 'wp_featherlight_after_admin_init' );
