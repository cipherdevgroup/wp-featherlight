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
	<label for="wp_featherlight_disable">
		<input type="checkbox" name="wp_featherlight_disable" id="wp_featherlight_disable" value="yes"<?php checked( $checked, 'yes' ); ?> />
		<?php echo esc_html( sprintf( _x( 'Disable Lightbox on This %s', '%s = post type singular name', 'wp-featherlight' ), $name ) ); ?>
	</label>
</p>
