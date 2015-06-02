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
