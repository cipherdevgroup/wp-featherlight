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
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post',      array( $this, 'save_meta_boxes' ) );
	}

	/**
	 * Helper function to determine if an automated task which should prevent
	 * saving meta box data is running.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function stop_save() {
		return defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ||
			defined( 'DOING_AJAX' ) && DOING_AJAX ||
			defined( 'DOING_CRON' ) && DOING_CRON;
	}

	/**
	 * Adds a simple metabox to disable the after entry widget areas.
	 *
	 * @since  1.0.0
	 * @access public
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
		$type    = get_post_type_object( $post->post_type );
		$name    = $type->labels->singular_name;
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
	 * @return void
	 */
	public function save_meta_boxes( $post_id ) {
		// Bail if something is in progress.
		if ( $this->stop_save() ) {
			return;
		}

		$no = 'wp_featherlight_disable_nonce';

		//	Bail if we can't verify the nonce.
		if ( ! isset( $_POST[ $no ] ) || ! wp_verify_nonce( $_POST[ $no ], 'toggle_wp_featherlight' ) ) {
			return;
		}

		$disable = isset( $_POST['wp_featherlight_disable'] ) ? 'yes' : '';

		update_post_meta( $post_id, 'wp_featherlight_disable', $disable );
	}

}
