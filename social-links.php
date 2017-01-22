<?php
/**
 * Plugin Name: Social Links
 * Description: Adds Social Icons for Facebook, Twitter, Linkedin and Google+ with profile link
 * Version: 1.0
 * Author: Benjamin Mercer
 *
 **/

// Exit if accessed directly
if(!defined('ABSPATH')) {
	exit;
}

// Load scripts
require_once(plugin_dir_path(__FILE__).'/includes/social-links-scripts.php');

// Load class
require_once(plugin_dir_path(__FILE__).'/includes/social-links-class.php');

// Load settings
if(is_admin()) {
	require_once(plugin_dir_path(__FILE__).'/includes/social-links-settings.php');
}

// Register Widget
function register_social_links() {
	register_widget('Social_Links_Widget');
}

add_action('widgets_init', 'register_social_links');