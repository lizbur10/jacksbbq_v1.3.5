# Kraken for WordPress

Kraken for WordPress is a lightweight boilerplate that includes just the essentials for building a WordPress theme.

* Common template files with HTML5 semantic markup.
* An (almost) empty stylesheet with just a few WordPress-specific classes.
* A small set of custom functions that make development easier.
* HTML5 Shim, friendly "old browser" messaging, and an IE-conditional class.
* Fully internationalized and translation-ready.

[Download Kraken for WordPress 3](https://github.com/cferdinandi/kraken-for-wordpress/archive/master.zip)


**In This Documentation**

1. [Getting Started](#getting-started)
2. [Useful Functions](#useful-functions)
3. [FAQ](#faq)
4. [How to Contribute](#how-to-contribute)
5. [License](#license)
6. [Changelog](#changelog)



## Getting Started

### 1. Include Kraken for WordPress on your site.

```html
<link rel="stylesheet" href="css/kraken-for-wp.css">
```

Kraken for WordPress is [built with Sass](http://sass-lang.com/) for easy customization. If you don't use Sass, that's ok. The `css` folder contains compiled vanilla CSS.

The `_config.scss` and `_mixins.scss` files are the same ones used in [Kraken](http://cferdinandi.github.io/kraken/), so you can drop the `_wordpress-images.css` file right into Kraken without making any updates. Or, adjust the variables to suit your own project.

The `style.css` file is used by the WordPress admin dashboard to identify your theme. The styles used on the front-end are located in the css folder, and linked to in the `header.php` file.

The `kraken-for-wp.css` file includes just a few WordPress-specific classes that control image and avatar styling. Drop in the [Kraken boilerplate](http://cferdinandi.github.io/kraken/), or write your own stylesheet from scratch.

### 2. Structure your markup

The PHP templates include content and semantic markup, but no styling. Structure your HTML as desired.

And that's it, you're done. Nice work!



## Useful Functions

Kraken for WordPress includes a few useful functions that make development easier.

* `kraken_load_theme_js()` registers your theme JavaScript files and loads them in the footer.
* `kraken_wpsearch()` creates a shortcode for the searchform.
* `kraken_post_password_form()` replaces the default password-protected post messaging with custom language.
* `kraken_pretty_wp_title()` makes the `wp_title()` function more useful.



## FAQ

### What's new in version 3?

Many of the functions from version 2 were converted to [optional plugins](http://cferdinandi.github.io/kraken/addons.html). This means more modular, portable code. Internationalization was added to whole theme, so it's 100% translation-ready. Some deprecated functions were removed, and it now consistenly uses tabs everywhere.

And, Kraken for WordPress is now powered by Sass!

### Why don't you use the new comment functions?

Several versions back, WordPress introduced a few functions to make the `comments.php` template a bit less unwieldy. `wp_list_comments()` creates a loop for all of a post's comments, and `comment_form()`, well, creates a comment form.

While they result in cleaner templates, they hide too much of the markup for my liking. Customizing the markup with these functions is a lot harder than when it's explicity written out, and certain things can't be customized at all.

Because of this, Kraken for WordPress still uses the traditional `comments.php` template.

### I'm new to WordPress theming. How do I get started?

The [WordPress Codex](http://codex.wordpress.org/Theme_Development) has a lot of great information. You can also find a ton of great resources on [StackOverflow](http://stackoverflow.com/).



## How to Contribute

In lieu of a formal style guide, take care to maintain the existing coding style. Don't forget to update the version number, the changelog (in the `readme.md` file), and when applicable, the documentation.



## License

Kraken for WordPress is licensed under the [MIT License](http://gomakethings.com/mit/).



## Changelog

* v3.3 - March 15, 2014
	* Added `is_paginated()` and `is_last_post()` to `functions.php`.
	* Added `content.php` file to make content pages more DRY.
	* Added skiplink to `header.php`.
	* Fixed rendering issues with `search.php`.
* v3.2 - December 6, 2013
	* Added Sass support.
	* Removed all styles from `style.css` file.
	* Moved front-end styles to `css` folder.
* v3.1 - October 18, 2013
	* Replaced `echo sprintf()` with `printf()`.
* v3.0 - October 17, 2013
	* Add i18n everywhere.
	* Updated several functions to be more aligned with WordPress best practices.
	* Moved various functions to [standalone plugins](http://cferdinandi.github.io/kraken/addons.html).
	* Converted from spaces to tabs.
	* Added customized "password protected post" messaging.
* v2.0 - September 1, 2013
	* Added templates for:
		* Main navigation
		* Next/previous page navigation
		* "No posts found" message
		* Search form
	* Removed search form function (replaced with WordPress standard `searchform.php` template).
	* Cleaned up  code and removed some unused snippets.
	* Added `get_template_directory()` to `require_once` in `functions.php`.
* v1.4 - July 29, 2013
	* Removed the canonical link from `header.php` (served no purpose).
	* Split theme JS and jQuery into two separate functions.
	* Function now calls CDN-hosted jQuery with local fallback.
* v1.3 - June 7, 2013
	* Switched to MIT license.
* v1.3 - June 7, 2013
	* Added more flexible way to link stylesheet in header.
* v1.2 - February 19, 2013
	* Added `no-self-pings.php` to the `functions.php` file.
* v1.1 - February 15, 2013
	* Removed `media="screen"` from `header.php` to allow for print styles in main CSS file.
* v1.0 - February 10, 2013
	* Initial release.