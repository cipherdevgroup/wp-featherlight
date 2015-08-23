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
	 * Name for the nonce field
	 *
	 * @var string
	 */
	private $nonce_name = 'wp_featherlight_disable_nonce';

	/**
	 * User submitted data.
	 *
	 * @var array
	 */
	private $user_data = array();

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

		if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
			$this->user_data = $_POST;
			add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
		}
	}

	/**
	 * Determine if the request to save data should be allowed to proceed.
	 *
	 * @since  0.3.0
	 * @access protected
	 * @param  int $post_id Post ID.
	 * @return bool Whether or not this is a valid request to save our data.
	 */
	protected function validate_request( $post_id ) {

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

		if ( ! isset( $this->user_data[ $this->nonce_name ] ) ) {
			return false;
		}

		if ( ! wp_verify_nonce( $this->user_data[ $this->nonce_name ] ) ) {
			return false;
		}
		// @link http://make.marketpress.com/multilingualpress/2014/10/how-to-disable-broken-save_post-callbacks/
		if ( is_multisite() && ms_is_switched() ) {
			return false;
		}

		return true;
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
	 *
	 * @param \WP_Post $post Post object.
	 * @return void
	 */
	public function options_callback( WP_Post $post ) {
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
	 * @return bool Whether or not data has been saved.
	 */
	public function save_meta_boxes( $post_id ) {
		if ( ! $this->validate_request( $post_id ) ) {
			return false;
		}

		$value = isset( $this->user_data['wp_featherlight_disable'] ) ? 'yes' : '';

		return (bool) update_post_meta( $post_id, 'wp_featherlight_disable', $value );
	}
}
