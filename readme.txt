=== WP Featherlight ===

Contributors: fatmedia, wpsitecare
Tags: jquery, lightbox, featherlight, photography, images, popup, minimal, responsive
Requires at least: 4.1
Tested up to: 4.2.2
Stable tag: 0.2.0
License: GPL-2.0+

An ultra lightweight jQuery lightbox for WordPress images and galleries.

== Description ==

WP Featherlight is a WordPress plugin wrapper for the Featherlight jQuery lightbox plugin. When installed, the plugin will automatically display all standard WordPress images and galleries in a simple, minimalistic lightbox popup. It's also possible to load Videos, iframes, and ajax content using WP Featherlight by adding data attributes to your content. For more details on custom content loading, check out the [featherlight documentation](https://github.com/noelboss/featherlight/#usage).

There are no settings for WP Featherlight, so you should be able to install it without needing to configure anything. In the event you don't want a lightbox on certain pages or posts, there is an option to disable it from within the post editor screen.

If you find a display problem, it may be related to your theme but please [open an support request](https://wordpress.org/support/plugin/wp-featherlight) about it so we can look into it. For more information about the Featherlight script itself, check out their [GitHub plugin page](http://noelboss.github.io/featherlight/).

= Contributing =

If you'd like to submit code patches or contribute in any other way, please fork the plugin on GitHub. https://github.com/wpsitecare/wp-featherlight

== Screenshots ==

1. A view of the lightbox in action.

== Changelog ==

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
