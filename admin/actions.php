<?php
/**
 * Methods used for filtering and displaying WP Featherlight images.
 *
 * @package   WPFeatherlight\Admin\Hooks
 * @author    Robert Neu
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Callback defined in includes/language.php
 *
 * @see wp_featherlight_load_textdomain
 */
add_action( 'admin_head-plugins.php', 'wp_featherlight_load_textdomain', 10 );

/**
 * Callback defined in includes/language.php
 *
 * @see wp_featherlight_load_textdomain
 */
add_action( 'post_submitbox_misc_actions', 'wp_featherlight_load_textdomain', 5 );

/**
 * Callback defined in admin/meta.php
 *
 * @see wp_featherlight_admin_meta_box_view
 */
add_action( 'post_submitbox_misc_actions', 'wp_featherlight_admin_meta_box_view', 10 );

/**
 * Callback defined in admin/meta.php
 *
 * @see wp_featherlight_admin_meta_save
 */
add_action( 'save_post', 'wp_featherlight_admin_meta_save', 10 );
