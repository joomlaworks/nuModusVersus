# nuModusVersus

**nuModusVersus is a free, multi-purpose template emphasizing in K2.**

It comes with many content blocks: edge to edge slideshows, feature lists, a screenshots showcase, client spotlight, testimonials, a blog section and more.

It has 3 colour combinations, or your own through the template options, and 350+ icons for the highlight section of your front page. It supports K2 for slideshows and photo and video galleries inside articles, and it is mobile and tablet friendly.

nuModusVersus is a free port of the original ["Modus Versus" PSD template](http://www.webdesignerdepot.com/2013/06/free-psd-template-modus-versus/) designed by Dimitar Tsankov for webdesignerdepot.com.

## Features

- Multi-purpose content blocks
- 3 colour combinations, plus your own
- 350+ icons for front page highlights
- Mobile and tablet friendly design
- Built for K2

## Links

- [Product page](https://www.joomlaworks.net/joomla-templates/free-templates/numodusversus)
- [Live demo](https://templates.joomlaworks.net/#numodusversus)
- [Template documentation](https://www.joomlaworks.net/support/templates)
- [Installation, content & customization guides](https://www.joomlaworks.net/support/templates/general-resources)

## Requirements

- Joomla 3.9 or newer, including [Joomla 3.x UTD](https://github.com/joomlaworks/joomla-3.x)
- PHP 7.1 or newer (tested up to PHP 8.5)
- K2 for the K2 layouts

## License

Free template. See the [Terms of Service](https://www.joomlaworks.net/about/tos).

## Third-party code

Third-party code bundled with the template (versions as shipped; upstream status as of November 2026). Everything else is JoomlaWorks code.

### Front-end

| Library | Version | Location | License | Upstream |
|---|---|---|---|---|
| jQuery Tools (tabs) | 1.2.7 | `js/behaviour.js` | Public domain | Abandoned (2012) |
| normalize.css | 2012-03-11 / 2.1.2 | `css/component.css` / `css/template.css` | MIT | Latest 8.0.1 |
| ZURB Foundation grid (CSS) | 4.x | `css/template.css`, `css/component.css` | MIT | Latest 6.9 |
| Font Awesome | 3.2.0 | `fonts/nufontawesome` | SIL OFL 1.1 (font), MIT (CSS) | Latest 7.x (renamed classes) |

### Template settings (backend)

| Library | Version | Location | License | Upstream |
|---|---|---|---|---|
| jQuery MiniColors | ~2.0 | `includes/elements/assets/js/behaviour.js` | MIT | Latest 2.3.6 |
| jQuery Swipebox | early 1.x | `includes/elements/assets/js/behaviour.js` | MIT | Latest 1.4.6, barely maintained |
| jQuery Tools (tabs) | 1.2.7 | `includes/elements/assets/js/behaviour.js` | Public domain | Abandoned (2012) |
| Google WebFont Loader | 1.x (Google CDN) | `includes/elements/nubase.php`, `includes/variations.php` | Apache-2.0 | Latest 1.6.28, unmaintained |
| Ace editor | CDN build | `includes/elements/nutextarea.php` | BSD-3-Clause | Actively maintained |

## Changelog

### Unreleased

Modernisation:

- **No MooTools needed any more:** K2 popups use K2's own modal (`data-k2-modal`), layouts no longer load MooTools or its tooltips, nuContent image popups use Joomla's modal behaviour without evaluated options (works with a strict Content Security Policy), and the template settings image field is plain JavaScript
- Removed code for Joomla versions before 3 and the "jQuery version" template parameter
- **nuSlider 2.0:** the content slider is now plain JavaScript in its own file (`js/nuslider.js`), with the same options and markup; Hammer.js, Minimit Anima, Bez, jquery.transform and the requestAnimationFrame polyfill were removed
- Removed the unused jQuery Tools mousewheel script

### v2.0 - November 8th, 2026

- **Requirements:** Joomla 3.9 or newer (including Joomla 3.x UTD) and PHP 7.1 up to PHP 8.5
- **PHP 8 compatibility:** `count()` calls on values that may be empty (e.g. K2 tags, extra fields, attachments) replaced with `empty()` checks, so they no longer throw fatal errors on PHP 8; template parameters that are unset (e.g. on a fresh install) no longer pass `null` to string functions; the Google Fonts list is handled safely when its cache is missing or incomplete
- Tested on PHP 8.5 and PHP 7.4 by rendering the main Joomla views (home, featured, article, print view, category blog & list, archive, search, login, error page) and K2 views (item, print view, category, tag, user, search, date archive) for every K2 sub-template set: no PHP errors, warnings, notices or deprecations
- All PHP code formatted to the PSR-12 coding standard and checked for syntax errors on PHP 5.6, 7.4 and 8.1 to 8.5
- **Internet Explorer support removed:** conditional comments and IE-only `<html>` classes, the `X-UA-Compatible` and `imagetoolbar` meta tags, the html5shiv loader, IE CSS hacks (`*prop`, `_prop`, `filter: progid:...`, `-ms-` properties, `zoom: 1`, `.lt-ie9`/`.isIE*` rules) and IE-only image filters in inline styles
- **Vendor prefixes removed** where all browsers support the standard property (`-moz-`, `-o-`, `-ms-` and most `-webkit-` declarations, prefixed gradients and keyframes); legacy gradients converted to the standard syntax; `::-webkit-input-placeholder` & co. replaced by `::placeholder`
- CSS syntax errors and invalid declarations fixed (see below); empty rule sets and the obsolete `speak` property removed; stylesheets formatted one rule per line
- Images optimized losslessly (jpegoptim & optipng)
- Added the standard `mobile-web-app-capable` meta tag next to Apple's (Chrome deprecates the Apple-only one)
- Template manifest: Joomla 3.9 minimum, new update server, version 2.0
- Tested on the real demo sites (60 pages each, Joomla 3.x UTD 3.18) on PHP 7.4 and 8.5, before and after the update
- **PHP 8 fatal errors fixed:** Joomla tag pages (the `id[]` request array broke the `<body>` class), error pages rendered after a failed page ("Cannot redeclare function nuText()"), Joomla category list layouts (`$this->item->params` in a list view) and the K2 authors module (`count()` on an undefined list)
- K2 search module: removed the `maxlength`/`size` attributes whose values K2 no longer provides
- K2 layouts and modules no longer throw warnings for authors without a K2 profile, user pages without a description or undefined layout variables
- `JFilterOutput::cleanText()` now gets a variable (it takes its argument by reference)

Fixes specific to nuModusVersus:

- Google Fonts list no longer throws warnings when the font URLs haven't been cached yet
- Google Fonts: the cached font list was never read (the code decoded `JFile::exists()` instead of the file's contents), causing warnings on every page
- The `<body>` class and page class suffix no longer throw warnings
- Blog/featured "more articles" links now point to the right articles
- **PHP 8 fatal error fixed:** the Joomla archive view counted a string (`count()` on the pagination links)
- CSS: the Tumblr social icon now shows (`content"\f173"` was missing its colon)
