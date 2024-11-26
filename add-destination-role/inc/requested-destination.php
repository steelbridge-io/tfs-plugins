<?php
// Add the custom field to the user profile page
function add_requested_destination_to_profile($user) {
	?>
	<h3><?php _e('Custom User Information', 'your-textdomain'); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="requested_destination"><?php _e('Travel Destination', 'your-textdomain'); ?></label></th>
			<td>
				<input type="text" name="requested_destination" id="requested_destination" value="<?php echo esc_attr(get_user_meta($user->ID, 'requested_destination', true)); ?>" class="regular-text">
				<p class="description"><?php _e('Please enter your requested travel destination.', 'your-textdomain'); ?></p>
			</td>
		</tr>
	</table>
	<?php
}
add_action('show_user_profile', 'add_requested_destination_to_profile');
add_action('edit_user_profile', 'add_requested_destination_to_profile');

// Save the custom field value
function save_requested_destination_to_profile($user_id) {
	if (!current_user_can('edit_user', $user_id)) return false;
	if(isset($_POST['requested_destination'])) {
		update_user_meta($user_id, 'requested_destination', sanitize_text_field($_POST['requested_destination']));
	}
}
add_action('personal_options_update', 'save_requested_destination_to_profile');
add_action('edit_user_profile_update', 'save_requested_destination_to_profile');

function prevent_subscriber_login($user) {
	if (is_wp_error($user)) {
		return $user;
	}
	
	if (in_array('subscriber', (array)$user->roles)) {
		return new WP_Error('subscriber_login_blocked', __('<h5 style="color:#ff4500;">Hello! Sorry, Your login is pending approval at this time.</h5>', 'your-textdomain'));
	}
	
	return $user;
}
add_filter('wp_authenticate_user', 'prevent_subscriber_login', 10, 1);