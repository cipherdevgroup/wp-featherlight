<?php
/**
 * Template to display the WP Featherlight admin sidebar meta box.
 *
 * @package   WPFeatherlight
 * @author    Robert Neu
 * @copyright Copyright (c) 2015, Robert Neu
 * @license   GPL-2.0+
 * @since     0.1.0
 */
?>
<?php wp_nonce_field( plugin_basename( WP_FEATHERLIGHT_FILE ), 'wp_featherlight_nonce' ); ?>
<p>
	<label for="meta-checkbox">
		<input type="checkbox" name="wp_featherlight_disable" id="wp_featherlight_disable" value="yes" <?php esc_attr( checked( $checked, 'yes' ) ); ?> />
		<?php _e( 'Disable Lightbox on This', 'wp-featherlight' ); ?> <?php echo $name; ?>
	</label>
</p>
