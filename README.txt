=== Plugin Name ===

Contributors: Levi Coplen
Donate link: http://www.leviathanc.com/
Tags: netflix, rss, feed, widget
Requires at least: 2.0.2
Tested up to: 3.1
Stable tag: trunk

== Description ==

Netflix RSS Feeder is a WordPress plugin to display your Netflix's List of
At Homes, Queue, Recommendations, Reviews, Notifications and Watch Instantly 
Queue on your blog sidebar. Also, it's widgetized.

Requirements: Up to Wordpress Version 3.1, A NetFlix account.

== Installation ==

1) Decompress the archive netflix-latest.rar

2) Upload netflix folder to your wp-content/plugins directory

3) Go to the plugins link in the WordPress admin control panel and 
   activate the plugin

4) Go to Netflix Option under Setting section and enter your Netflix ID
   and check what you would like to show on your sidebar. And Submit it

5) Add Netflix Widget to your side OR enter this code to your sidebar as
   you wish:

		<?php if (function_exists('netflix')) : ?>
			<?php netflix(); ?>
		<?php endif; ?>

6) Voila!

== Changelog ==

Version 1.0.0 - 04/17/2008 - Initial Release
Version 1.0.1 - 11/17/2009 - Retest if the current version still work with WP 2.8
Version 1.1   - 02/28/2011 - Fix the minor error
