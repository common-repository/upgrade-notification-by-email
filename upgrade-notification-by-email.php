<?php  
/* 
Plugin Name: Upgrade Notification by Email
Version: 0.4 
Description: Sends daily notofication at admins' email if installation of Wordpress is out of date
Author: Konrad Karpieszuk 
Author URI: http://www.muzungu.pl/ 
Plugin URI: http://www.muzungu.pl/moje-pluginy-do-wordpressa/upgrade-notification-by-email/
*/ 

/*
Copyright (C) 2009 Konrad Karpieszuk / www.muzungu.pl / kkarpieszuk@gmail.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

register_activation_hook(__FILE__, 'wpu_my_activation');

function wpu_my_activation() {
	wp_schedule_event(time(), 'daily', 'wpu_my_daily_event');
	wp_clear_scheduled_hook('my_daily_event'); // remove it newer version (0.3 or above)
}

add_action('wpu_my_daily_event', 'wpu_do_this_daily');

register_deactivation_hook(__FILE__, 'wpu_my_deactivation');

function wpu_my_deactivation() {
	wp_clear_scheduled_hook('wpu_my_daily_event');
}

function wpu_do_this_daily() {
	$taken_transient = get_transient('update_core');
	if ( empty($taken_transient->updates) ) return;
	$za = $taken_transient->updates;
	$zb = $za[0];
//	$zm = $zb->response;
//	if ($zm == "upgrade") {
global $wp_version;
$cur = $zb->current;
$instaled = $wp_version;
if (version_compare($instaled, $cur, "<")) {
		$wpsender = get_option('admin_email');
        $forwhom = get_option('admin_email');
        $subject = "Your blog " . wp_specialchars( get_option('blogname') ) . " should be upgraded";
        $headers = "From: " . wp_specialchars( get_option('blogname') ) . " <$wpsender>\n";
        $headers .= "Content-Type: text/html\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n";
        $mailtext = "The plugin Upgrade Notification by Email noticed that at Wordpress server is available newer version of blogging software than this, which is installed at " . wp_specialchars( get_option('blogname') ) . ". Please upgrade it in your admin panel. You have ".$instaled." and newest is " . $zb->current . ". You can download Wordpress directly from " . $zb->package;
            mail($forwhom, $subject, $mailtext, $headers);
		}
}

?>
