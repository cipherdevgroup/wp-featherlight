/**
 * WP Featherlight - Loader and helpers for the Featherlight WordPress plugin
 *
 * @version   Version 0.1.0
 * @copyright Copyright 2015, Robert Neu (http://robneu.com)
 * @license   MIT
 */
(function( window, $, undefined ) {
	'use strict';

	/**
	 * Checks href targets to see if a given anchor is linking to an image.
	 *
	 * Returns false if the anchor is pointing to an external URL.
	 *
	 * @since  0.1.0
	 * @return mixed
	 */
	function testImages( index, element ) {
		if ( element.hostname && element.hostname !== location.hostname ) {
			return false;
		}
		return /(png|jpg|jpeg|gif|tiff|bmp)$/.test( $( element ).attr( 'href' ) );
	}

	/**
	 * Filters all href elements on a page to add Featherlight's data attribute.
	 * When a match is found, the data attribute is added so Featherlight will
	 * open it normally.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function findImages() {
		$( 'a[href]' ).filter( testImages ).attr( 'data-featherlight', 'image' );
	}

	/**
	 * Sets up the Featherlight gallery option for WordPress image galleries.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function setupGallery() {
		var $galleryItem = $( '.gallery-item a' );
		if ( $galleryItem.length === 0 ) {
			return;
		}
		$galleryItem.featherlightGallery({
			openSpeed: 300
		});
	}

	/**
	 * Fires all of our helper methods to load featherlight.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function wpFeatherlightInit() {
		findImages();
		setupGallery();
	}

	$(document).ready(function() {
		wpFeatherlightInit();
	});
})( this, jQuery );
