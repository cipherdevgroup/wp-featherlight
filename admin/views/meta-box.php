<?php
/**
 * Template to display the WP Featherlight admin sidebar meta box.
 *
 * @package   WPFeatherlight\Admin\Views
 * @copyright Copyright (c) 2018, Cipher Development, LLC
 * @license   GPL-2.0+
 * @since     0.1.0
 */

?>
<div id="wp-featherlight-enable-wrap" class="misc-pub-section wp-featherlight-enable" style="position:relative;">
	<label for="wp_featherlight_disable">
		<input type="checkbox" name="wp_featherlight_disable" id="wp_featherlight_disable" value=""<?php checked( $checked, 'yes' ); ?> />
		<?php esc_html_e( 'Disable lightbox', 'wp-featherlight' ); ?>
	</label>
</div>
<?php wp_nonce_field( 'save_wp_featherlight_metabox', 'wp_featherlight_metabox_nonce' ); ?>
