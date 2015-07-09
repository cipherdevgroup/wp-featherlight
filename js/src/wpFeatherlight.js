/**
 * WP Featherlight - Loader and helpers for the Featherlight WordPress plugin
 *
 * @version   Version 0.2.0
 * @copyright Copyright 2015, Robert Neu (http://robneu.com)
 * @license   MIT
 */
(function( window, $, undefined ) {
	'use strict';

	/**
	 * Checks href targets to see if a given anchor is linking to an image.
	 *
	 * @since  0.1.0
	 * @return mixed
	 */
	function testImages( index, element ) {
		return /(png|jpg|jpeg|gif|tiff|bmp)$/.test(
			$( element ).attr( 'href' ).toLowerCase().split( '?' )[0].split( '#' )[0]
		);
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
	 * Callback function to initialize Featherlight galleries when they contain
	 * items that are able to be opened in a light box.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function buildGalleries( index, element ) {
		var $galleryObj   = $( element ),
			$galleryItems = $galleryObj.find( '.gallery-item a' );

		if ( 0 === $galleryItems.length ) {
			$galleryItems = $galleryObj.find( '.tiled-gallery-item a' );
		}

		if ( ! $galleryItems.attr( 'data-featherlight' ) ) {
			return;
		}

		$galleryItems.featherlightGallery();
	}

	/**
	 * Finds and creates Featherlight galleries for WordPress image galleries.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function findGalleries() {
		var $gallery = $( '.gallery, .tiled-gallery' );

		if ( 0 === $gallery.length ) {
			return;
		}

		$.each( $gallery, buildGalleries );
	}

	/**
	 * Fires all of our helper methods to load featherlight.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function wpFeatherlightInit() {
		findImages();
		findGalleries();
	}

	$( document ).ready(function() {
		wpFeatherlightInit();
	});
})( this, jQuery );
