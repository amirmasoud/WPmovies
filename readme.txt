=== Plugin Name ===
Contributors: amir32
Tags: shortcode, CPT, cache, angular
Requires at least: 2.7
Tested up to: 4.3
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html



== Description ==

Movie post type with rating and year.
* AngularJS
* Caching
* JSON API
* PHPUnit test
* Translation ready

== Installation ==

1. Download Zip and extract it
2. Rename WPmovies-master to movies
3. Zip the folder
4. Upload to your WordPress site and activate it (Plugins>Add new>Upload>activate or upload directly to wp-content/plugins and activate it)
5. Add `[movies]` shortcode to any part of site you want to show your movies

== Frequently Asked Questions ==
= How to set movies as frontpage? =
* add `[movies]` shortcode to a page
* set the page as homepage(frontpage) of your site

= How to get list of movies in JSON API format? =
* get list of all movies in JSON API format at `http://yoursite.com/?api=1&paged=1`

= How to use? =
* add [movies] short code to your prefer post/page to show the movies.

== Changelog ==

= 1.0 =
* Initial release