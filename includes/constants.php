<?php
/**
 * Define constants to preserve backwards compatibility with older versions.
 *
 * @package   WPFeatherlight
 * @copyright Copyright (c) 2018, Cipher Development, LLC
 * @license   GPL-2.0+
 * @since     0.3.0
 */

define( 'WP_FEATHERLIGHT_FILE',    wp_featherlight()->get_file() );
define( 'WP_FEATHERLIGHT_VERSION', wp_featherlight()->get_version() );

if ( ! defined( 'WP_FEATHERLIGHT_DIR' ) ) {
	define( 'WP_FEATHERLIGHT_DIR', wp_featherlight()->get_dir() );
}

if ( ! defined( 'WP_FEATHERLIGHT_URL' ) ) {
	define( 'WP_FEATHERLIGHT_URL', wp_featherlight()->get_url() );
}
