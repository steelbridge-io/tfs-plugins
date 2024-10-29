<?php

/**
 * Plugin Name: Guest Data App
 * Plugin URI: https://example.com/guest-data-app
 * Description: A plugin to manage travel guest data. It includes functionality to add, edit, and manage guest
 * records and associated templates.
 * Version: 1.0.0
 * Author: Chris Parsons
 * Author URI: https://example.com
 * License: GPLv2 or later
 * Text Domain: guest-data-app
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Register meta box
add_action('add_meta_boxes', 'gda_register_meta_box');
function gda_register_meta_box() {
	// Add meta box for custom post type: travel-form
	add_meta_box('gda_meta_box', __('Guest Data App', 'guest-data-app'), 'gda_meta_box_callback', 'travel-form');
}

// Meta box callback function
function gda_meta_box_callback($post) {
	// Check if the post uses the specified template
	$template_file = get_post_meta($post->ID, '_wp_page_template', true);
	if ($template_file === 'questionnaire-templates/travel-form-posts-v2.php') {
		wp_nonce_field('gda_save_meta_box_data', 'gda_meta_box_nonce');
		
		$value = get_post_meta($post->ID, '_gda_meta_key', true);
		
		echo '<label for="gda_meta_field">';
		_e('Gravity Form ID:', 'guest-data-app');
		echo '</label> ';
		echo '<input type="number" id="gda_meta_field" name="gda_meta_field" value="' . esc_attr($value) . '" />';
	} else {
		echo '<p>' . __('This meta box is only available for the "travel-form-posts-v2.php" template', 'guest-data-app') . '</p>';
	}
}

// Save meta box data
add_action('save_post', 'gda_save_meta_box_data');
function gda_save_meta_box_data($post_id) {
	if (!isset($_POST['gda_meta_box_nonce'])) {
		return;
	}
	
	if (!wp_verify_nonce($_POST['gda_meta_box_nonce'], 'gda_save_meta_box_data')) {
		return;
	}
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	
	if (!isset($_POST['gda_meta_field'])) {
		return;
	}
	
	$gda_data = sanitize_text_field($_POST['gda_meta_field']);
	update_post_meta($post_id, '_gda_meta_key', $gda_data);
}
?>