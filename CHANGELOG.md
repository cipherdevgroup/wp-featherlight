## 0.3.0

There are quite a few internal changes in the plugin for this release, plus some nice new features and improvements on the front-end. We've streamlined everything as much as possible and also added support for some languages other than English! Here's a breakdown of everything that's changed:

### New Features
- Automatic captioning for WordPress images and gallery items (Including Jetpack Galleries)
- Spanish language translation

### Enhancements
- Updated [Featherlight](https://github.com/noelboss/featherlight/) to `1.3.3`
- Improved gallery styles on desktop and mobile devices
- Streamlined overall styles
- Added SVG icons for more visual consistency across various platforms
- Simplified the text used in the admin metabox to ease translations (props @toscho)

### Bug Fixes
- Improved handling of images when certain caching plugins are enabled
- Prevented gallery arrows from being hijacked by WP Emoji
- Fixed a bug which allowed multiple light boxes to be opened using keyboard commands

### Developer Stuff
- Reduced overhead by loading language files only when needed (props @toscho)
- Improved the save routine for our admin metabox (props @toscho)
- Added a `wp_featherlight_captions` filter to control auto-captioning. Filter it to false to disable captions.
- Re-structured the plugin's internal code base and deprecated plugin constants
- Added Grunt and Bower the plugin to allow easier updates and releases in the future

### Added Language Support
- German
- Spanish
- French
- Portuguese (Brazil)
- Spanish (Peru)

## 0.2.0

The primary feature in this release is the addition of a visual loader and the automatic lightboxing of external images. In prior versions, only images from the WordPress host domain were lightboxed automatically. This caused some problems with people using a CDN as the URLs were treated as external.

There have also been a handful of code improvements under the hood including:

- Added gallery support for Jetpack Tiled Galleries
- Improved URL handling to match more image instances automatically
- Fixed a mistake in the textdomain path
- Improved admin metabox markup (props @GaryJones)
- Fixed a typo in the main stylesheet's script handle (props @GaryJones)

## 0.1.1

Fixed a bug that caused all WordPress galleries to open in a light box. Now only galleries which have been set to link to the media attachment are opened using Featherlight.

## 0.1.0

Initial release!
