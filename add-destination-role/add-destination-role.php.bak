<?php
/*
Plugin Name: Add Destination Role and Redirect
Description: Adds a custom user role called "Destination" and redirects users with this role to a specific "travel-form" post upon login.
Version: 1.0
Author: Your Name
*/

// Function to add the 'destination' role
function add_destination_role() {
  add_role(
    'destination',
    'Destination',
    array(
      'read'                     => true,
      'edit_posts'               => false,
      'delete_posts'             => false,
      'read_private_travel_forms'=> true, // Capability to read private travel-form posts
    )
  );
}

// Hook to add the role when the plugin is activated
function add_role_on_activation($network_wide) {
  add_destination_role();

  if (is_multisite() && $network_wide) {
    global $wpdb;
    $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs WHERE site_id = {$wpdb->siteid}");
    foreach ($blog_ids as $blog_id) {
      switch_to_blog($blog_id);
      add_destination_role();
      restore_current_blog();
    }
  }
}
register_activation_hook(__FILE__, 'add_role_on_activation');

// Hook to remove the role when the plugin is deactivated
function remove_destination_role() {
  remove_role('destination');
}
register_deactivation_hook(__FILE__, 'remove_destination_role');

// Grant the 'destination' role access to private travel forms
function grant_destination_role_private_access() {
  $role = get_role('destination');
  if ($role) {
    $role->add_cap('read_private_travel_forms');
  }
}
add_action('init', 'grant_destination_role_private_access');

// Redirect 'destination' users to a specific page upon login
function redirect_destination_user_on_login($redirect_to, $request, $user) {
  if (isset($user->roles) && is_array($user->roles) && in_array('destination', $user->roles)) {
    // Set the URL of the specific travel form post
    $redirect_to = 'http://www.theflyshop.local/travel-form/alaska-rainbow-adventures-ak-questionnaire';
  }
  return $redirect_to;
}
add_filter('login_redirect', 'redirect_destination_user_on_login', 10, 3);