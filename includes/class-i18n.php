<?php
/**
 * Load translations for the plugin.
 *
 * @package   WPFeatherlight\Internationalization
 * @copyright Copyright (c) 2018, Cipher Development, LLC
 * @license   GPL-2.0+
 * @since     0.3.0
 */

/**
 * Based on t5-libraries' language loader by Thomas Scholz
 *
 * @link https://github.com/toscho/t5-libraries/blob/master/Core/I18n/Language_Loader.php
 */
class WP_Featherlight_Language_Loader {
	/**
	 * Path to the root plugin file.
	 *
	 * @var string
	 */
	private $plugin_file;

	/**
	 * Name of the text domain.
	 *
	 * @var string
	 */
	private $text_domain;

	/**
	 * Constructor.
	 *
	 * @param string $text_domain  Name of the text domain.
	 * @param string $plugin_file Path to language file.
	 */
	public function __construct( $text_domain, $plugin_file ) {
		$this->text_domain = $text_domain;
		$this->plugin_file = $plugin_file;
	}

	/**
	 * Loads translation file.
	 *
	 * @since  0.3.0
	 * @access public
	 * @return bool true when the file was found, false otherwise.
	 */
	public function load() {
		return load_plugin_textdomain(
			$this->text_domain,
			false,
			dirname( plugin_basename( $this->plugin_file ) ) . '/languages'
		);
	}

	/**
	 * Remove translations from memory.
	 *
	 * @since  0.3.0
	 * @access public
	 * @return bool true if the text domain was loaded, false if it was not.
	 */
	public function unload() {
		return unload_textdomain( $this->text_domain );
	}

	/**
	 * Whether or not the language has been loaded already.
	 *
	 * @since  0.3.0
	 * @access public
	 * @return bool
	 */
	public function is_loaded() {
		return is_textdomain_loaded( $this->text_domain );
	}

	/**
	 * Get the class running!
	 *
	 * @since  0.3.0
	 * @access public
	 * @return void
	 */
	public function run() {
		_deprecated_function( __METHOD__, '1.0.0' );
	}

	/**
	 * Hook into WordPress.
	 *
	 * @since  0.3.0
	 * @access protected
	 * @return void
	 */
	protected function wp_hooks() {
		_deprecated_function( __METHOD__, '1.0.0' );
	}
}
