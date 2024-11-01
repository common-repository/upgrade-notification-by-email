=== Plugin Name ===
Contributors: Konrad Karpieszuk
Tags: upgrade, notification, mail, security, 
Requires at least: 2.0.2
Tested up to: 3.0
Stable tag: 0.3

Sends daily notofication at admins' email if installation of Wordpress is out of date

== Description ==

This plugin is for you if you don't look inside of your Admin Panel every day (for example you have tens of wordpress installations) but still want to have wordpress up to date. After installation plugin will check every day if newer version of wordpress is available and if yes, will send email to blog's admin with notification. 

== Installation ==

1. Like every plugin, download zip file
2. Upload to /wp-content/plugins
3. Activate it. 
4. Wait for notifications ;)

== Frequently Asked Questions ==

= Newer version of wordpress is available but I don't get emails =

Check your spam folder in email account

= I've got newest version but plugin sends me notifications, which says that i have installed wordpress in strange version 'abc' =

This is caused by plugin WP Security Scan. Deactivate it or look into its code and deacctivate this place, which changes variable $wp_version into string 'abc'.

== Screenshots ==



== Changelog ==
= 0.3 =
* Removed problem with version 3.0 of Wordpress

= 0.2 =
* nothing new, just code is cleaner, shorter and should be faster. it uses core wordpress functions to upgrade check in place of written by me (and now removed).  

= 0.1 =
* Works fine. Sends very sexy emails ;)
