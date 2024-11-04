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
	add_meta_box('gda_meta_box', __('Guest Data App', 'guest-data-app'), 'gda_meta_box_callback', 'travel-form');
}

// Enqueue admin styles specifically for this plugin
add_action('admin_enqueue_scripts', 'gda_enqueue_admin_styles');
function gda_enqueue_admin_styles($hook_suffix) {
	global $post;
	
	if ($hook_suffix == 'post.php' || $hook_suffix == 'post-new.php') {
		if ($post->post_type == 'travel-form') {
			$template_file = get_post_meta($post->ID, '_wp_page_template', true);
			if ($template_file === 'questionnaire-templates/travel-form-posts-v2.php') {
				wp_enqueue_style('gda_admin_styles', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
			}
		}
	}
}

// Meta box callback function
function gda_meta_box_callback($post) {
	$template_file = get_post_meta($post->ID, '_wp_page_template', true);
	if ($template_file === 'questionnaire-templates/travel-form-posts-v2.php') {
		wp_nonce_field('gda_save_meta_box_data', 'gda_meta_box_nonce');
		
		// Form ID
		$gda_meta_value = get_post_meta($post->ID, '_gda_meta_key', true);
		echo '<div class="form-id">';
		echo '<label for="gda_meta_field">' . __('Gravity Form ID:', 'guest-data-app') . '</label>';
		echo '<input type="number" id="gda_meta_field" name="gda_meta_field" value="' . esc_attr($gda_meta_value) . '" />';
		echo '<p class="description">' . __('Enter the ID of the Gravity Form you want to link to this post.', 'guest-data-app') . '</p>';
		echo '</div>';
		
		echo '<div class="gda-meta-box">';
		
		// Table header title
		$gda_meta_value = get_post_meta($post->ID, '_gda_meta_key_table_header_title', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_table_header_title">' . __('Table header title:', 'guest-data-app') . '</label>';
		echo '<input type="text" id="gda_meta_field_table_header_title" name="gda_meta_field_table_header_title" value="' . esc_attr($gda_meta_value) . '" />';
		echo '</div>';
		
		// First name ID
		$gda_name_value = get_post_meta($post->ID, '_gda_meta_key_first_name_id', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_first_name_id">' . __('First name ID:', 'guest-data-app') . '</label>';
		echo '<input type="number" id="gda_meta_field_first_name_id" name="gda_meta_field_first_name_id" value="' . esc_attr
			($gda_name_value) . '" />';
		echo '</div>';
		
		// Last name ID
		$gda_name_value = get_post_meta($post->ID, '_gda_meta_key_last_name_id', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_last_name_id">' . __('Last name ID:', 'guest-data-app') . '</label>';
		echo '<input type="number" id="gda_meta_field_last_name_id" name="gda_meta_field_last_name_id" value="' . esc_attr
			($gda_name_value) . '" />';
		echo '</div>';
		
		echo '</div>'; // end .gda-meta-box
		
		echo '<div class="gda-meta-box">';
		
		// Table header title: Reservation
		$gda_meta_value_reservation = get_post_meta($post->ID, '_gda_meta_key_header_title_res', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_header_title_res">' . __('Reservation table header title:', 'guest-data-app') . '</label>';
		echo '<input type="text" id="gda_meta_field_header_title_res" name="gda_meta_field_header_title_res" value="' . esc_attr($gda_meta_value_reservation) . '" />';
		echo '</div>';
		
		// Reservation #
		$gda_res_value = get_post_meta($post->ID, '_gda_meta_key_reservation_id', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_reservation_id">' . __('Reservation ID:', 'guest-data-app') . '</label>';
		echo '<input type="number" id="gda_meta_field_reservation_id" name="gda_meta_field_reservation_id" value="' . esc_attr
			($gda_res_value) . '" />';
		echo '</div>';
		
		echo '</div>'; // end .gda-meta-box
		
		echo '<div class="gda-meta-box">';
		
		// Table header title: Date of arrival
		$gda_meta_value_date_of_arrival = get_post_meta($post->ID, '_gda_meta_key_header_date_of_arrival', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_header_date_of_arrival">' . __('Date of arrival table header title:', 'guest-data-app') . '</label>';
		echo '<input type="text" id="gda_meta_field_header_date_of_arrival" name="gda_meta_field_header_date_of_arrival" value="' . esc_attr($gda_meta_value_date_of_arrival) . '" />';
		echo '</div>';
		
		// Arrival date
		$gda_arrival_value = get_post_meta($post->ID, '_gda_meta_key_date_of_arrival_id', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_date_of_arrival_id">' . __('Date of arrival ID:', 'guest-data-app') . '</label>';
		echo '<input type="number" id="gda_meta_field_date_of_arrival_id" name="gda_meta_field_date_of_arrival_id" value="' . esc_attr
			($gda_arrival_value) . '" />';
		echo '</div>';
		
		echo '</div>'; // end .gda-meat-box
		
		echo '<div class="gda-meta-box">';
		
		// Table header title: Date of departure
		$gda_meta_value = get_post_meta($post->ID, '_gda_meta_key_header_date_of_departure', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_header_date_of_departure">' . __('Date of departure table header title:',
				'guest-data-app') . '</label>';
		echo '<input type="text" id="gda_meta_field_header_date_of_departure" name="gda_meta_field_header_date_of_departure" value="' . esc_attr($gda_meta_value) . '" />';
		echo '</div>';
		
		// Depature date
		$gda_meta_value = get_post_meta($post->ID, '_gda_meta_key_date_of_departure_id', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_date_of_departure_id">' . __('Date of departure ID:', 'guest-data-app') . '</label>';
		echo '<input type="number" id="gda_meta_field_date_of_departure_id" name="gda_meta_field_date_of_departure_id" value="' . esc_attr
			($gda_meta_value) . '" />';
		echo '</div>';
		
		echo '</div>'; // end .gta-meta-box
		
		echo '<div class="gda-meta-box">';
		
		// Table header title: Cell phone
		$gda_meta_value = get_post_meta($post->ID, '_gda_meta_key_header_cell_phone', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_header_cell_phone">' . __('Cell phone table header title:',
				'guest-data-app') . '</label>';
		echo '<input type="text" id="gda_meta_field_header_cell_phone" name="gda_meta_field_header_cell_phone" value="' . esc_attr($gda_meta_value) . '" />';
		echo '</div>';
		
		// Cell phone
		$gda_meta_value = get_post_meta($post->ID, '_gda_meta_key_cell_phone_id', true);
		echo '<div class="gda-meta-row">';
		echo '<label for="gda_meta_field_cell_phone_id">' . __('Cell phone ID:', 'guest-data-app') . '</label>';
		echo '<input type="number" id="gda_meta_field_cell_phone_id" name="gda_meta_field_cell_phone_id" value="' . esc_attr
			($gda_meta_value) . '" />';
		echo '</div>';
		
		echo '</div>'; // end .gta-meta-box
		
		
		
		
		
		
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
	
	if (isset($_POST['gda_meta_field'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field']);
		update_post_meta($post_id, '_gda_meta_key', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_table_header_title'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_table_header_title']);
		update_post_meta($post_id, '_gda_meta_key_table_header_title', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_first_name_id'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_first_name_id']);
		update_post_meta($post_id, '_gda_meta_key_first_name_id', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_last_name_id'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_last_name_id']);
		update_post_meta($post_id, '_gda_meta_key_last_name_id', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_header_title_res'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_header_title_res']);
		update_post_meta($post_id, '_gda_meta_key_header_title_res', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_reservation_id'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_reservation_id']);
		update_post_meta($post_id, '_gda_meta_key_reservation_id', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_header_date_of_arrival'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_header_date_of_arrival']);
		update_post_meta($post_id, '_gda_meta_key_header_date_of_arrival', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_date_of_arrival_id'])) {
		$gda_arrival_data = sanitize_text_field($_POST['gda_meta_field_date_of_arrival_id']);
		update_post_meta($post_id, '_gda_meta_key_date_of_arrival_id', $gda_arrival_data);
	}
	
	if (isset($_POST['gda_meta_field_header_date_of_departure'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_header_date_of_departure']);
		update_post_meta($post_id, '_gda_meta_key_header_date_of_departure', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_date_of_departure_id'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_date_of_departure_id']);
		update_post_meta($post_id, '_gda_meta_key_date_of_departure_id', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_header_cell_phone'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_header_cell_phone']);
		update_post_meta($post_id, '_gda_meta_key_header_cell_phone', $gda_data);
	}
	
	if (isset($_POST['gda_meta_field_cell_phone_id'])) {
		$gda_data = sanitize_text_field($_POST['gda_meta_field_cell_phone_id']);
		update_post_meta($post_id, '_gda_meta_key_cell_phone_id', $gda_data);
	}
	
}