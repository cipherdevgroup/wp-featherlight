<?php
/**
 * Methods used for adding and saving meta data for WP Featherlight.
 *
 * @package   WPFeatherlight\Admin
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   GPL-2.0+
 * @since     0.1.0
 */

/**
 * The main featherlight admin meta box and related methods.
 *
 * @since 0.1.0
 */
class WP_Featherlight_Admin_Meta {
	/**
	 * Name for the nonce field
	 *
	 * @var string
	 */
	private $nonce_name = 'wp_featherlight_metabox_nonce';

	/**
	 * Name for the nonce action
	 *
	 * @var string
	 */
	private $nonce_action = 'save_wp_featherlight_metabox';

	/**
	 * Determine if the request to save data should be allowed to proceed.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  int $post_id Post ID.
	 * @return bool Whether or not this is a valid request to save our data.
	 */
	protected function validate_request( $post_id ) {
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

		if ( ! isset( $_POST[ $this->nonce_name ] ) ) { // Input var okay.
			return false;
		}

		if ( ! wp_verify_nonce( sanitize_key( $_POST[ $this->nonce_name ] ), $this->nonce_action ) ) { // Input var okay.
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
	 * @param  object $post Post object.
	 * @return void
	 */
	public function meta_box_view( $post ) {
		if ( empty( $post ) ) {
			$post = get_post();
		}

		if ( ! is_object( $post ) || ! isset( $post->post_type ) ) {
			return;
		}

		$type = get_post_type_object( $post->post_type );

		if ( ! is_object( $type ) ) {
			return;
		}

		if ( current_user_can( $type->cap->edit_post, $post->ID ) && $type->public ) {
			$disable = get_post_meta( $post->ID, 'wp_featherlight_disable', true );
			$checked = empty( $disable ) ? '' : $disable;

			require_once wp_featherlight()->get_dir() . 'admin/views/meta-box.php';
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
	public function save_meta_boxes( $post_id ) {
		if ( ! $valid_request = $this->validate_request( $post_id ) ) {
			return false;
		}

		$value = isset( $valid_request['wp_featherlight_disable'] ) ? 'yes' : '';

		return (bool) update_post_meta( $post_id, 'wp_featherlight_disable', $value );
	}

	/**
	 * Add a metabox to control featherlight display options.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  string $post_type the current post type.
	 * @return void
	 */
	public function add_meta_boxes( $post_type ) {
		_deprecated_function( __METHOD__, '1.0.0' );
	}

	/**
	 * Output the content of our metabox.
	 *
	 * @deprecated 1.0.0
	 * @access public
	 *
	 * @param WP_Post $post Post object.
	 * @return void
	 */
	public function options_callback( WP_Post $post ) {
		_deprecated_function( __METHOD__, '1.0.0' );

		$this->meta_box_view( $post );
	}

	/**
	 * Get the class running!
	 *
	 * @since  0.1.0
	 * @deprecated 1.0.0
	 * @access public
	 * @return void
	 */
	public function run() {
		_deprecated_function( __METHOD__, '1.0.0' );
	}
}
