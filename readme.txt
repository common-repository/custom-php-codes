=== Plugin Name ===

Plugin Name:  Custom PHP Codes
Description:  This plugin helps you to insert custom PHP Code in Posts & Widgets.
Plugin URI:   https://wordpress.org/plugins/custom-php-codes
Author:       SPcits - spcits.com
Author URI:   http://spcits.com
Version:      1.0
Text Domain:  customphpcode
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
Contributors: Shubhneet, Shilpa
Requires at least: 3.3.1
Tested up to: 4.9.4
Stable tag: 4.0.3
Tags: Custom PHP Codes, Use PHP, PHP Plugin, Custom PHP, Excute PHP, Insert PHP, Run PHP, Insert PHP Page, Custom PHP Code, Insert PHP Code, Insert PHP Post


Executes custom php codes in wordpress posts and widgets and logs any new custom php code for approval before execution to avoid it's misuse.

== Description ==

This plugin helps you to execute custom php codes in your wordpress posts and widgets. Only codes that has been approved by admin can be used for executing php codes in pages or widgets any new code is first shown to admin prior to it's execution on the front end.


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/customphpcodes` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Custom PHP Codes -> Custom Settings to configure the plugin
4. In your posts or widget place your php code with following tags [php_code] <script> Your Code Here </script> [/php_code]
5. Now preview your custom php code of your widget or post in front end to log it for approval in admin panel.
   Please note : Your code will nor execute and nor it will be visible on front end but it will be logged for admin approval.
6. Use the Custom PHP Codes -> Custom PHP Codes to allow your custom php code to execute on front end.
7. Your Custom PHP Code should be visible on front end.

== Frequently Asked Questions ==

= What's the sytax to enclose custom php code ? =

You can enclose your custom php code in following tags [php_code] <script>  </script> [/php_code]

= I can't find my custom php code to allow in Custom PHP Codes page , how can I add it here ? =

It would be added automatically once you preview your custom php code enclosed in tags on front end, although it will not execute nor it will be visible on frontend but it will be logged for approval on Custom PHP Codes Page.

== Screenshots ==

1. Copy customphpcodes folder in  `/wp-content/plugins/` directory.
2. Simple click to activate the plugin.
3. Open Custom PHP Codes -> Custom Settings page to configure the plugin.
4. Enable the features of plugin to Only allow admin enabled queries on front end and to Save custom PHP Codes in database.
5. Now place your custom php code using following tags [php_code] <script>  </script> [/php_code].
6. Now preview your code on the front end although it will not display your code but it will log for approval by admin.
   Please note : Your code will not execute nor it will be visible on front end but it will be logged for admin approval.
7. Now open Custom PHP Codes -> Custom PHP Codes to allow your custom php code for execution.
8. Allow your Custom PHP Codes for execution.
9. Now your Custom PHP Codes will excute and it's results will be visible on front end.

== Changelog ==

= 1.0 =
* Support for Posts & Widgets
* Enhanced Custom PHP Codes Log for admin to allow/disallow codes for execution.
