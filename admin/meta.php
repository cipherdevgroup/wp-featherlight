<?php
/**
 * Methods used for adding and saving meta data for WP Featherlight.
 *
 * @package   WPFeatherlight\Admin
 * @author    Robert Neu
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     1.0.0
 */

/**
 * Determine if the request to save data should be allowed to proceed.
 *
 * @since  1.0.0
 * @access protected
 * @param  int $post_id Post ID.
 * @return bool Whether or not this is a valid request to save our data.
 */
function _wp_featherlight_admin_meta_validate_request( $post_id ) {
	if ( 'POST' !== $_SERVER['REQUEST_METHOD'] ) { // Input var okay.
		return false;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return false;
	}

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return false;
	}

	if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
		return false;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return false;
	}

	$nonce = 'wp_featherlight_metabox_nonce';

	if ( ! isset( $_POST[ $nonce ] ) ) { // Input var okay.
		return false;
	}

	if ( ! wp_verify_nonce( sanitize_key( $_POST[ $nonce ] ), 'save_wp_featherlight_metabox' ) ) { // Input var okay.
		return false;
	}

	// @link http://make.marketpress.com/multilingualpress/2014/10/how-to-disable-broken-save_post-callbacks/
	if ( is_multisite() && ms_is_switched() ) {
		return false;
	}

	return wp_unslash( $_POST ); // Input var okay.
}

/**
 * Output the content of our metabox.
 *
 * @since  1.0.0
 * @access public
 *
 * @param WP_Post $post Post object.
 * @return void
 */
function wp_featherlight_admin_meta_box_view( WP_Post $post ) {
	$type = get_post_type_object( $post->post_type );

	if ( ! is_object( $type ) ) {
		return;
	}

	if ( current_user_can( $type->cap->edit_post, $post->ID ) && $type->public ) {
		$disable = get_post_meta( $post->ID, 'wp_featherlight_disable', true );
		$checked = empty( $disable ) ? '' : $disable;

		require_once WP_FEATHERLIGHT_DIR . 'admin/views/meta-box.php';
	}
}

/**
 * Callback function for saving our meta box data.
 *
 * @since  1.0.0
 * @access public
 * @param  int $post_id Post ID.
 * @return bool Whether or not data has been saved.
 */
function wp_featherlight_admin_meta_save( $post_id ) {
	if ( ! $valid_request = _wp_featherlight_admin_meta_validate_request( $post_id ) ) {
		return false;
	}

	$value = isset( $valid_request['wp_featherlight_disable'] ) ? 'yes' : '';

	return (bool) update_post_meta( $post_id, 'wp_featherlight_disable', $value );
}
