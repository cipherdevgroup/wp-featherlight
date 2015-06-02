=== WP Featherlight ===

Contributors: fatmedia, wpsitecare
Tags: jquery, lightbox, featherlight, photography, images, popup, minimal, responsive
Requires at least: 4.1
Tested up to: 4.2.2
Stable tag: 0.2.0
License: GPL-2.0+

An ultra lightweight jQuery lightbox for WordPress images and galleries.

== Description ==

A WordPress plugin wrapper for the Featherlight jQuery lightbox plugin. WP Featherlight will automatically display all standard WordPress images and galleries in a simple, minimalistic lightbox popup.

There are no settings for the plugin, so you should be able to install it without having to configure anything. If you find a display problem, it may be related to your theme but please let us know about it so we can look into it.

The script this plugin is based on, [Featherlight](http://noelboss.github.io/featherlight/), is a very lightweight jQuery lightbox plugin. It's simple yet flexible and easy to use. Featherlight has minimal css and uses no inline styles, and everything is name-spaced. Featherlight's small footprint weights about 4kB – in total.

== Developers ==

If you'd like to submit code patches or contribute in any other way, please fork the plugin on GitHub. https://github.com/wpsitecare/wp-featherlight

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
