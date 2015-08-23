<?php
/**
 * Methods used for adding and saving meta data for WP Featherlight.
 *
 * @package   WPFeatherlight
 * @author    Robert Neu
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   GPL-2.0+
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

class WP_Featherlight_Admin_Meta {

	/**
	 * Get the class running!
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function run() {
		self::wp_hooks();
	}

	/**
	 * Hook into WordPress.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function wp_hooks() {
		add_action( 'add_meta_boxes',      array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post',           array( $this, 'save_meta_boxes' ) );
		add_filter( 'wp_insert_post_data', array( $this, 'stop_multisite_save' ) );
	}

	/**
	 * Determine if the request to save data should be allowed to proceed.
	 *
	 * @since  0.3.0
	 * @access protected
	 * @param  int $post_id Post ID.
	 * @param  array $data the $_POST data to be saved.
	 * @param  string $nonce Nonce that was used in the form to verify
	 * @param  string|int $action Should give context to what is taking place and be the same when nonce was created.
	 * @return array|bool data to be saved if all checks pass, false on failure.
	 */
	protected function validate_request( $post_id, $data, $nonce, $action = -1 ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ||
			defined( 'DOING_AJAX' ) && DOING_AJAX ||
			defined( 'DOING_CRON' ) && DOING_CRON ||
			! current_user_can( 'edit_post', $post_id ) ||
			! isset( $data[ $nonce ] ) ||
			! wp_verify_nonce( $data[ $nonce ], $action ) ) {
			return false;
		}
		return $data;
	}

	/**
	 * Adds a simple metabox to disable the after entry widget areas.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  string $post_type the current post type.
	 * @return void
	 */
	public function add_meta_boxes( $post_type ) {
		$type = get_post_type_object( $post_type );
		if ( is_object( $type ) && $type->public ) {
			add_meta_box(
				'wp_featherlight_options',
				__( 'WP Featherlight Options', 'wp-featherlight' ),
				array( $this, 'options_callback' ),
				null,
				'side'
			);
		}
	}

	/**
	 * Outputs the content of our disable after-entry metabox.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function options_callback( $post ) {
		$disable = get_post_meta( $post->ID, 'wp_featherlight_disable', true );
		$checked = empty( $disable ) ? '' : $disable;
		require_once wp_featherlight()->get_dir() . 'admin/templates/metabox-sidebar.php';
	}

	/**
	 * Callback function for saving our testimonial details meta box data.
	 * Handles data validation and sanitization for our content label.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  int $post_id Post ID.
	 * @return int|bool Meta ID if the key didn't exist, true on successful update, false on failure.
	 */
	public function save_meta_boxes( $post_id ) {
		if ( ! $safe_data = $this->validate_request( $post_id, $_POST, 'wp_featherlight_disable_nonce', 'toggle_wp_featherlight' ) ) {
			return false;
		}
		return update_post_meta( $post_id, 'wp_featherlight_disable', isset( $safe_data['wp_featherlight_disable'] ) ? 'yes' : '' );
	}

	/**
	 * Prevent unwanted extra calls to `save_post` on WordPress multisite.
	 *
	 * @since  0.3.0
	 * @access public
	 * @link   http://make.marketpress.com/multilingualpress/2014/10/how-to-disable-broken-save_post-callbacks/
	 * @param  array $data the current sanitized post data
	 * @return array $data the unmodified post data
	 */
	public function stop_multisite_save( $data ) {
		if ( is_multisite() && ms_is_switched() ) {
			remove_action( 'save_post', array( $this, 'save_meta_boxes' ) );
		}
		return $data;
	}

}
