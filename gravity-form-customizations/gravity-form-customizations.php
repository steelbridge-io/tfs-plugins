<?php
/*
Plugin Name: Gravity Form Customizations
Description: Custom plugin to prevent editing, deleting, and trashing of form with ID 57.
Version: 1.0
Author: Your Name
*/

// Prevent form with ID 57 from being saved
add_filter('gform_pre_form_settings_save', function($form) {
	if ($form['id'] == 57) {
		GFCommon::add_error_message('Editing this form is not allowed.');
		return GFAPI::get_form($form['id']); // Return the original form to prevent changes
	}
	return $form;
});

add_filter('gform_pre_form_editor_save', function($form) {
	if ($form['id'] == 57) {
		GFCommon::add_error_message('Editing this form is not allowed.');
		return GFAPI::get_form($form['id']); // Return the original form to prevent changes
	}
	return $form;
});

// Redirect from form editor if form ID is 57
add_action('admin_init', function() {
	if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'gf_edit_forms' && isset($_GET['id']) && $_GET['id'] == 57) {
		GFCommon::add_error_message('Deleting this form is not allowed.');
		wp_redirect(admin_url('admin.php?page=gf_edit_forms'));
		exit;
	}
});

// Prevent form with ID 57 from being deleted
add_filter('gform_before_delete_form', function($form_id) {
	if ($form_id == 57) {
		GFCommon::add_error_message('Deleting this form is not allowed.');
		wp_redirect(admin_url('admin.php?page=gf_edit_forms'));
		exit;
	}
});

// Prevent form with ID 57 from being moved to trash
add_filter('gform_form_trashable', function($is_trashable, $form) {
	if ($form['id'] == 57) {
		// Display an error message when attempting to move the form to trash
		GFCommon::add_error_message(__('Moving this form to trash is not allowed.'));
		return false; // Prevent moving to trash
	}
	return $is_trashable;
}, 10, 2);

// Prevent trashing the form from bulk actions or any other method
add_action('admin_post_gf_bulk_action', function() {
	if (isset($_POST['action']) && $_POST['action'] === 'trash' && isset($_POST['form_ids'])) {
		$form_ids = array_map('intval', $_POST['form_ids']); // Ensure IDs are integers
		if (in_array(57, $form_ids)) {
			GFCommon::add_error_message(__('Moving this form to trash is not allowed.'));
			wp_redirect(add_query_arg('show_gf_messages', '1', admin_url('admin.php?page=gf_edit_forms')));
			exit;
			//wp_redirect(admin_url('admin.php?page=gf_edit_forms'));
			exit;
		}
	}
});

// Prevent trashing the form via single action
add_action('admin_post_gform_delete_form', function() {
	if (isset($_GET['form_id']) && intval($_GET['form_id']) == 57) {
		GFCommon::add_error_message(__('Moving this form to trash is not allowed.'));
		wp_redirect(add_query_arg('show_gf_messages', '1', admin_url('admin.php?page=gf_edit_forms')));
		exit;
		//wp_redirect(admin_url('admin.php?page=gf_edit_forms'));
		exit;
	}
});






