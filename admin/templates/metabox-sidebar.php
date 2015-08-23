<?php
/**
 * Template to display the WP Featherlight admin sidebar meta box.
 *
 * @package   WPFeatherlight\Admin\Templates
 * @author    Robert Neu
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   GPL-2.0+
 * @since     0.1.0
 */
?>
<p>
	<label for="wp_featherlight_disable">
		<input type="checkbox" name="wp_featherlight_disable" id="wp_featherlight_disable" value="yes"<?php checked( $checked, 'yes' ); ?> />
		<?php esc_html_e( 'Disable lightbox', 'wp-featherlight' ); ?>
	</label>
</p>
<?php wp_nonce_field( $this->nonce_action, $this->nonce_name ); ?>
