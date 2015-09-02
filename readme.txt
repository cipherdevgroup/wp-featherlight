=== WP Featherlight - A Simple jQuery Lightbox ===

Contributors: fatmedia, wpsitecare
Tags: lightbox, jquery lightbox, jquery, gallery, image, lightbox images, image lightbox, lightbox gallery, lightbox image, lightbox popup, featherlight, photo gallery, popup image, popup images, popup lightbox, responsive lightbox, swipe, wordpress image lightbox, wordpress lightbox, wordpress slideshow lightbox, photography, images, minimal, responsive, photo, photos
Requires at least: 4.3
Tested up to: 4.3
Stable tag: 0.3.0
License: GPL-2.0+

An ultra lightweight jQuery lightbox for WordPress images and galleries.

== Description ==

WP Featherlight is a WordPress lightbox plugin for adding a minimal, high-performance, responsive jQuery lightbox to your WordPress website. At its core, WP Featherlight is a WordPress plugin wrapper for the Featherlight jQuery lightbox plugin. When installed, the plugin will automatically display all standard WordPress images and galleries in a simple, minimalistic lightbox popup.

In order for WordPress images and galleries to be lightboxed, you need to select the "Media File" option when choosing where the thumbnails should link. You can also select the "Custom Link" option if you make sure to link directly to an image file. This should work for any image file, even if it's hosted on another website.

It's also possible to lightbox videos, iframes, and ajax content with WP Featherlight by adding data attributes to your content. For more details on custom content loading, check out the [featherlight documentation](https://github.com/noelboss/featherlight/#usage).

There are no settings for WP Featherlight, so you should be able to install it without needing to configure anything. In the event you don't want a lightbox on certain pages or posts, there is an option to disable it from within the post editor screen.

If you find a display problem, it may be related to your theme but please [open an support request](https://wordpress.org/support/plugin/wp-featherlight) about it so we can look into it. For more information about the Featherlight script itself, check out their [GitHub plugin page](http://noelboss.github.io/featherlight/).

= Developer Notes =

While there are no options in the plugin, there are some handy filters to modify the default behavior. As of `0.3.0` all images which use the default WordPress captions will also include a caption when the image is lightboxed. To disable this behavior, filter `wp_featherlight_captions` to false.

You can also disable inclusion of the CSS and JavaScript conditionally using filters which can be found in the `/includes/class-scripts.php` file. If you have questions about how any part of the plugin works, please don't hesitate to [open an issue on GitHub](https://github.com/wpsitecare/wp-featherlight/issues).

= Contributing =

If you'd like to submit code patches or contribute in any other way, please fork the plugin on GitHub. https://github.com/wpsitecare/wp-featherlight

== Screenshots ==

1. A view of the jQuery lightbox in action.

== Changelog ==

= 0.3.0 =

There are quite a few internal changes in the plugin for this release, plus some nice new features and improvements on the front-end. We've streamlined everything as much as possible and also added support for some languages other than English! Here's a breakdown of everything that's changed:

New Features
- Automatic captioning for WordPress images and gallery items (Including Jetpack Galleries)
- Spanish language translation

Enhancements
- Updated [Featherlight](https://github.com/noelboss/featherlight/) to `1.3.3`
- Improved gallery styles on desktop and mobile devices
- Streamlined overall styles
- Added SVG icons for more visual consistency across various platforms
- Simplified the text used in the admin metabox to ease translations (props @toscho)

Bug Fixes
- Improved handling of images when certain caching plugins are enabled
- Prevented gallery arrows from being hijacked by WP Emoji
- Fixed a bug which allowed multiple light boxes to be opened using keyboard commands

Developer Stuff
- Reduced overhead by loading language files only when needed (props @toscho)
- Improved the save routine for our admin metabox (props @toscho)
- Added a `wp_featherlight_captions` filter to control auto-captioning. Filter it to false to disable captions.
- Re-structured the plugin's internal code base and deprecated plugin constants
- Added Grunt and Bower the plugin to allow easier updates and releases in the future

Added Language Support
- German
- Spanish
- French
- Portuguese (Brazil)
- Spanish (Peru)

= 0.2.0 =
The primary feature in this release is the addition of a visual loader and the automatic lightboxing of external images. In prior versions, only images from the WordPress host domain were lightboxed automatically. This caused some problems with people using a CDN as the URLs were treated as external.

There have also been a handful of code improvements under the hood including:

- Added gallery support for Jetpack Tiled Galleries
- Improved URL handling to match more image instances automatically
- Fixed a mistake in the textdomain path
- Improved admin metabox markup
- Fixed a typo in the main stylesheet's script handle

= 0.1.1 =
Fixed a bug that caused all WordPress galleries to open in a light box. Now only galleries which have been set to link to the media attachment are opened using Featherlight.

= 0.1.0 =
Initial release!
