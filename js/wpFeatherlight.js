/**
 * WP Featherlight - Loader and helpers for the Featherlight WordPress plugin
 *
 * @copyright Copyright 2015, WP Site Care (http://www.wpsitecare.com)
 * @license   MIT
 */
(function( window, $, undefined ) {
	'use strict';

	var $body = $( document.body );

	/**
	 * Checks href targets to see if a given anchor is linking to an image.
	 *
	 * @since  0.1.0
	 * @return mixed
	 */
	function testImages( index, element ) {
		return /(.png|.jpg|.jpeg|.gif|.tiff|.bmp)$/.test(
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
		$body.find( 'a[href]' ).filter( testImages ).attr( 'data-featherlight', 'image' );
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

		if ( $galleryItems.attr( 'data-featherlight' ) ) {
			$galleryItems.featherlightGallery({
				previousIcon: '',
				nextIcon: ''
			});
		}
	}

	/**
	 * Finds and creates Featherlight galleries for WordPress image galleries.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function findGalleries() {
		var $gallery = $body.find( '.gallery, .tiled-gallery' );

		if ( 0 !== $gallery.length ) {
			$.each( $gallery, buildGalleries );
		}
	}

	/**
	 * Append image captions to the Featherlight content <div>.
	 *
	 * @since  0.3.0
	 * @return void
	 */
	function addCaptions() {
		$.featherlight.prototype.afterContent = function() {
			var object    = this.$instance,
				target    = this.$currentTarget,
				parent    = target.parent(),
				caption   = parent.find( '.wp-caption-text' ),
				galParent = target.parents( '.gallery-item' ),
				jetParent = target.parents( '.tiled-gallery-item' );

			if ( 0 !== galParent.length ) {
				caption = galParent.find( '.wp-caption-text' );
			} else if ( 0 !== jetParent.length ) {
				caption = jetParent.find( '.tiled-gallery-caption' );
			}

			object.find( '.caption' ).remove();
			if ( 0 !== caption.length ) {
				var $captionElm = $( '<div class="caption">' ).appendTo( object.find( '.featherlight-content' ) );
				$captionElm[0].innerHTML = caption.html();
			}
		};
	}

	/**
	 * Fires all of our helper methods to load featherlight.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function wpFeatherlightInit() {
		$.featherlight.defaults.closeIcon = '';
		findImages();
		findGalleries();
		if ( $body.hasClass( 'wp-featherlight-captions' ) ) {
			addCaptions();
		}
	}

	$( document ).ready(function() {
		wpFeatherlightInit();
	});
})( this, jQuery );
