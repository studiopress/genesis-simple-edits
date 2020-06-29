=== Plugin Name ===
Contributors: nathanrice, studiopress, wpmuguru
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5553118
Tags: shortcodes, genesis, genesiswp, studiopress
Requires at least: 5.0.0
Tested up to: 5.4
Stable tag: 2.3.1

This plugin lets you edit the three most commonly modified areas in any Genesis theme: the post-info (byline), the post-meta, and the footer area.

== DEPRECATION NOTICE ==
This plugin is now deprecated and will no longer receive feature updates. The reason for deprecation is due to the Genesis Framework parent theme allowing similar functionality, which can be found in the WordPress dashboard under
- Genesis → Theme Settings → Singular Content
- Genesis → Theme Settings → Footer

For more information about how to use these features in Genesis Framework, see this article:
https://my.studiopress.com/documentation/usage/genesis-features/edit-the-entry-meta-and-footer-text-with-genesis/

== Description ==

This plugin creates a new Genesis settings page that allows you to modify the post-info (byline), post-meta, and footer area on any Genesis theme. Using text, shortcodes, and HTML in the textboxes provided in the admin screen, these three commonly modified areas are easily editable, without having to learn PHP or write functions, filters, or mess with hooks.

== Installation ==

1. Upload the entire `genesis-simple-edits` folder to the `/wp-content/plugins/` directory
1. DO NOT change the name of the `genesis-simple-edits` folder
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Navigate to `Genesis > Simple Edits`
1. Edit the areas you would like to change, using text, HTML, and the provided shortcode references.
1. Save the changes

== Frequently Asked Questions ==

= What are Shortcodes? =

Check out the [Shortcodes API](http://codex.wordpress.org/Shortcode_API) for an explanation, and our [Shortcode Reference](https://studiopress.github.io/genesis/basics/genesis-shortcodes/#footer-shortcodes) for a list of available Genesis-specific shortcodes.

= The plugin won't activate =

You must have Genesis (3.1.0+) and a Genesis child theme installed and activated on your site.

== Changelog ==

= 2.3.1 =
* Fixed admin fields on tablets.

= 2.3.0 =
* Remove footer credits setting, replaced by core Genesis 3.1 setting.
* Increase minimum Genesis version to 3.1.0.
* Increase minimum WordPress version to 5.0.0.

= 2.2.2 =
* Add compatibility with WordPress Coding Standards.

= 2.2.1 =
* Genesis 2.6+ compatibility (prevents white screen).

= 2.2.0 =
* Rewrite based in plugin boilerplate.
* Update Author and Author URI.

= 2.1.3 =
* add textdomain loader.
* add plugin header i18n.

= 2.1.2 =
* Generate POT.

= 2.1.1 =
* Prevent fatal error when Genesis 2.1 not active.

= 2.1.0 =
* Genesis 2.1+ compatibility.

= 1.7.1 =
* Increased installation requirement to Genesis 1.7.1.
* Removed PHP4 constructor.
* Whitespace, standards, and documentation.

= 1.0 =
* Initial Release.
