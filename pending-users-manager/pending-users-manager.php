<?php
/*
Plugin Name: Pending Users Manager
Description: Display and manage pending user registrations for this specific blog only
Version: 2.0.0
*/

defined('ABSPATH') || exit;

class PendingUsersManager {

 public function __construct() {
  add_action('admin_menu', array($this, 'add_admin_menu'));
  add_action('admin_post_pum_resend_activation', array($this, 'handle_resend_activation'));
  add_action('admin_post_pum_activate_user', array($this, 'handle_activate_user'));
  add_action('admin_post_pum_remove_user', array($this, 'handle_remove_user'));
  add_action('admin_post_pum_bulk_action', array($this, 'handle_bulk_action'));
  add_action('admin_post_pum_remove_existing_user', array($this, 'handle_remove_existing_user'));
  add_action('admin_post_pum_change_user_role', array($this, 'handle_change_user_role'));
  add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
 }

 public function enqueue_scripts($hook) {
  if ($hook !== 'users_page_pending-users') {
   return;
  }

  wp_enqueue_script('jquery');
  wp_enqueue_style(
   'pending-users-css',
   plugin_dir_url(__FILE__) . 'assets/pending-users.css',
   array(),
   '2.0.0'
  );

  wp_add_inline_script('jquery', '
            jQuery(document).ready(function($) {
                $("#check-all-users").change(function() {
                    $(".user-checkbox").prop("checked", this.checked);
                });
                
                $("form[data-confirm]").submit(function(e) {
                    var message = $(this).data("confirm");
                    if (!confirm(message)) {
                        e.preventDefault();
                    }
                });
            });
        ');
 }

 public function add_admin_menu() {
  if (!current_user_can('list_users')) {
   return;
  }

  add_users_page(
   'Pending Users',
   'Pending Users',
   'list_users',
   'pending-users',
   array($this, 'display_pending_users_page')
  );
 }

 private function get_redirect_url($message = '') {
  $url = admin_url('users.php?page=pending-users');
  if ($message) {
   $url = add_query_arg('message', $message, $url);
  }
  return $url;
 }

 private function safe_redirect($message = '') {
  $redirect_url = $this->get_redirect_url($message);
  wp_safe_redirect($redirect_url);
  exit;
 }

 private function get_available_roles() {
  global $wp_roles;
  if (!isset($wp_roles)) {
   $wp_roles = new WP_Roles();
  }

  // Get all roles including custom ones
  return $wp_roles->get_names();
 }

 private function generate_role_selector($name, $selected_role = 'subscriber', $css_class = '') {
  $available_roles = $this->get_available_roles();
  $html = '<select name="' . esc_attr($name) . '"';
  if ($css_class) {
   $html .= ' class="' . esc_attr($css_class) . '"';
  }
  $html .= '>';

  foreach ($available_roles as $role_key => $role_name) {
   $html .= '<option value="' . esc_attr($role_key) . '"';
   if ($role_key === $selected_role) {
    $html .= ' selected';
   }
   $html .= '>' . esc_html($role_name) . '</option>';
  }

  $html .= '</select>';
  return $html;
 }

 /**
  * Get ONLY pending users for THIS specific blog
  */
 private function get_pending_users_for_this_blog() {
  global $wpdb;

  $current_blog_id = get_current_blog_id();

  // Get site domain and path for this blog
  $blog_details = get_blog_details($current_blog_id);
  $blog_domain = $blog_details->domain;
  $blog_path = $blog_details->path;

  // Method 1: Exact domain and path match
  $exact_signups = $wpdb->get_results($wpdb->prepare(
   "SELECT * FROM {$wpdb->signups} 
             WHERE domain = %s 
             AND path = %s 
             AND active = 0
             ORDER BY registered DESC",
   $blog_domain,
   $blog_path
  ));

  // Method 2: Meta data contains this blog ID
  $meta_signups = $wpdb->get_results($wpdb->prepare(
   "SELECT * FROM {$wpdb->signups} 
             WHERE (meta LIKE %s OR meta LIKE %s)
             AND active = 0
             ORDER BY registered DESC",
   '%"add_to_blog";i:' . $current_blog_id . ';%',
   '%"add_to_blog":"' . $current_blog_id . '"%'
  ));

  // Combine results and remove duplicates
  $all_signups = array_merge($exact_signups, $meta_signups);
  $unique_signups = array();
  $seen_emails = array();

  foreach ($all_signups as $signup) {
   if (!in_array($signup->user_email, $seen_emails)) {
    $unique_signups[] = $signup;
    $seen_emails[] = $signup->user_email;
   }
  }

  return $unique_signups;
 }

 /**
  * Get existing users for THIS specific blog
  */
 private function get_existing_users_for_this_blog() {
  $current_blog_id = get_current_blog_id();

  // Get users for this specific blog
  $args = array(
   'blog_id' => $current_blog_id,
   'orderby' => 'user_registered',
   'order' => 'DESC'
  );

  $users = get_users($args);

  // Process user data
  foreach ($users as $key => $user) {
   // Create a new user object for this specific blog to get correct roles
   $user_obj = new WP_User($user->ID, '', $current_blog_id);

   // Get all roles for this user on this specific blog
   $roles = array();
   $role_names = array();

   // Only process if user has roles
   if (!empty($user_obj->roles) && is_array($user_obj->roles)) {
    $roles = $user_obj->roles;

    // Get the translated role names
    foreach ($roles as $role) {
     // Make sure the role exists in the role names
     $all_roles = wp_roles()->get_names();
     if (isset($all_roles[$role])) {
      $role_names[] = translate_user_role($all_roles[$role]);
     } else {
      $role_names[] = $role; // Fallback to role key if not found
     }
    }
   }

   // Set the primary role (first role) or 'none' if no roles
   $primary_role = !empty($roles) ? reset($roles) : 'none';

   // Add these properties to the user object
   $users[$key]->roles = $roles;
   $users[$key]->role_names = $role_names;
   $users[$key]->primary_role = $primary_role;
  }

  return $users;
 }

 // Action Handlers
 public function handle_resend_activation() {
  if (!current_user_can('promote_users') || !wp_verify_nonce($_POST['_wpnonce'], 'pum_resend_' . $_POST['user_email'])) {
   wp_die('Security check failed.');
  }

  $user_email = sanitize_email($_POST['user_email']);
  $activation_key = sanitize_text_field($_POST['activation_key']);
  $result = $this->send_activation_email($user_email, $activation_key);

  $message = $result ? 'activation_sent' : 'activation_failed';
  $this->safe_redirect($message);
 }

 public function handle_activate_user() {
  if (!current_user_can('promote_users') || !wp_verify_nonce($_POST['_wpnonce'], 'pum_activate_' . $_POST['user_email'])) {
   wp_die('Security check failed.');
  }

  $user_email = sanitize_email($_POST['user_email']);
  $user_login = sanitize_text_field($_POST['user_login']);
  $activation_key = sanitize_text_field($_POST['activation_key']);
  $role = sanitize_text_field($_POST['role']);

  $available_roles = array_keys($this->get_available_roles());
  if (!in_array($role, $available_roles)) {
   $this->safe_redirect('invalid_role');
  }

  $result = $this->manually_activate_user($user_email, $user_login, $activation_key, $role);
  $message = $result ? 'user_activated' : 'activation_failed';
  $this->safe_redirect($message);
 }

 public function handle_remove_user() {
  if (!current_user_can('delete_users') || !wp_verify_nonce($_POST['_wpnonce'], 'pum_remove_' . $_POST['user_email'])) {
   wp_die('Security check failed.');
  }

  $user_email = sanitize_email($_POST['user_email']);
  $result = $this->remove_pending_user($user_email);
  $message = $result ? 'user_removed' : 'removal_failed';
  $this->safe_redirect($message);
 }

 public function handle_remove_existing_user() {
  if (!current_user_can('remove_users') || !wp_verify_nonce($_POST['_wpnonce'], 'pum_remove_existing_' . $_POST['user_id'])) {
   wp_die('Security check failed.');
  }

  $user_id = intval($_POST['user_id']);
  $current_blog_id = get_current_blog_id();

  // Don't allow removing yourself
  if ($user_id === get_current_user_id()) {
   $this->safe_redirect('cannot_remove_self');
   return;
  }

  $result = remove_user_from_blog($user_id, $current_blog_id);
  $message = $result ? 'existing_user_removed' : 'existing_user_removal_failed';
  $this->safe_redirect($message);
 }

 public function handle_change_user_role() {
  if (!current_user_can('promote_users') || !wp_verify_nonce($_POST['_wpnonce'], 'pum_change_role_' . $_POST['user_id'])) {
   wp_die('Security check failed.');
  }

  $user_id = intval($_POST['user_id']);
  $new_role = sanitize_text_field($_POST['role']);
  $current_blog_id = get_current_blog_id();

  $available_roles = array_keys($this->get_available_roles());
  if (!in_array($new_role, $available_roles)) {
   $this->safe_redirect('invalid_role');
  }

  // Check if user exists in this blog
  if (!is_user_member_of_blog($user_id, $current_blog_id)) {
   $this->safe_redirect('user_not_member');
   return;
  }

  // Update user role for this specific blog
  $result = add_user_to_blog($current_blog_id, $user_id, $new_role);

  $message = !is_wp_error($result) ? 'user_role_changed' : 'role_change_failed';
  $this->safe_redirect($message);
 }

 public function handle_bulk_action() {
  if (!current_user_can('promote_users') || !wp_verify_nonce($_POST['_wpnonce'], 'bulk-users')) {
   wp_die('Security check failed.');
  }

  $action = sanitize_text_field($_POST['action']);
  $user_emails = isset($_POST['users']) ? array_map('sanitize_email', $_POST['users']) : array();

  if (empty($user_emails)) {
   $this->safe_redirect('no_users_selected');
  }

  $success_count = 0;
  foreach ($user_emails as $user_email) {
   switch ($action) {
    case 'resend':
     if ($this->send_activation_email_by_email($user_email)) {
      $success_count++;
     }
     break;
    case 'activate':
     if ($this->manually_activate_user_by_email($user_email, 'subscriber')) {
      $success_count++;
     }
     break;
    case 'remove':
     if (current_user_can('delete_users') && $this->remove_pending_user($user_email)) {
      $success_count++;
     }
     break;
   }
  }

  $message = $action . '_bulk_' . $success_count;
  $this->safe_redirect($message);
 }

 // Helper methods
 private function send_activation_email($user_email, $activation_key) {
  global $wpdb;

  $signup = $wpdb->get_row($wpdb->prepare(
   "SELECT * FROM {$wpdb->signups} 
             WHERE user_email = %s AND activation_key = %s AND active = 0",
   $user_email, $activation_key
  ));

  if (!$signup) {
   return false;
  }

  $subject = sprintf(__('[%s] Activate %s'), get_network_option(null, 'site_name'), $signup->user_login);
  $activation_url = add_query_arg(array(
   'key' => $activation_key,
   'login' => $signup->user_login
  ), network_site_url('wp-activate.php'));

  $message = sprintf(__('To activate your account, please click the following link: %s'), $activation_url);
  return wp_mail($user_email, $subject, $message);
 }

 private function send_activation_email_by_email($user_email) {
  global $wpdb;

  $signup = $wpdb->get_row($wpdb->prepare(
   "SELECT * FROM {$wpdb->signups} 
             WHERE user_email = %s AND active = 0
             ORDER BY registered DESC LIMIT 1",
   $user_email
  ));

  if (!$signup) {
   return false;
  }

  return $this->send_activation_email($user_email, $signup->activation_key);
 }

 private function manually_activate_user($user_email, $user_login, $activation_key, $role) {
  global $wpdb;

  $signup = $wpdb->get_row($wpdb->prepare(
   "SELECT * FROM {$wpdb->signups} 
             WHERE user_email = %s AND activation_key = %s AND active = 0",
   $user_email, $activation_key
  ));

  if (!$signup) {
   return false;
  }

  $current_blog_id = get_current_blog_id();

  // Check if user already exists
  $user = get_user_by('email', $user_email);
  if (!$user) {
   $user_id = wp_create_user($user_login, wp_generate_password(), $user_email);
   if (is_wp_error($user_id)) {
    return false;
   }
   $user = get_user_by('id', $user_id);
  }

  // Add user to current blog
  $result = add_user_to_blog($current_blog_id, $user->ID, $role);

  if (!is_wp_error($result)) {
   // Mark signup as active
   $wpdb->update(
    $wpdb->signups,
    array('active' => 1, 'activated' => current_time('mysql')),
    array('user_email' => $user_email, 'activation_key' => $activation_key),
    array('%d', '%s'),
    array('%s', '%s')
   );
   return true;
  }

  return false;
 }

 private function manually_activate_user_by_email($user_email, $role) {
  global $wpdb;

  $signup = $wpdb->get_row($wpdb->prepare(
   "SELECT * FROM {$wpdb->signups} 
             WHERE user_email = %s AND active = 0
             ORDER BY registered DESC LIMIT 1",
   $user_email
  ));

  if (!$signup) {
   return false;
  }

  return $this->manually_activate_user($user_email, $signup->user_login, $signup->activation_key, $role);
 }

 private function remove_pending_user($user_email) {
  global $wpdb;

  $result = $wpdb->delete(
   $wpdb->signups,
   array('user_email' => $user_email, 'active' => 0),
   array('%s', '%d')
  );

  return $result !== false;
 }

 private function display_admin_notice($message) {
  $notices = array(
   'activation_sent' => array('success', 'Activation email sent successfully.'),
   'activation_failed' => array('error', 'Failed to send activation email.'),
   'user_activated' => array('success', 'User activated successfully.'),
   'user_removed' => array('success', 'User removed successfully.'),
   'removal_failed' => array('error', 'Failed to remove user.'),
   'invalid_role' => array('error', 'Invalid role selected.'),
   'no_users_selected' => array('warning', 'No users selected for bulk action.'),
   'existing_user_removed' => array('success', 'User removed from this site successfully.'),
   'existing_user_removal_failed' => array('error', 'Failed to remove user from this site.'),
   'user_role_changed' => array('success', 'User role changed successfully.'),
   'role_change_failed' => array('error', 'Failed to change user role.'),
   'cannot_remove_self' => array('error', 'You cannot remove yourself from this site.'),
   'user_not_member' => array('error', 'User is not a member of this site.'),
  );

  // Handle bulk action messages
  if (preg_match('/^(resend|activate|remove)_bulk_(\d+)$/', $message, $matches)) {
   $action = $matches[1];
   $count = $matches[2];
   $action_names = array('resend' => 'emails sent', 'activate' => 'users activated', 'remove' => 'users removed');
   $notices[$message] = array('success', "Bulk action completed: {$count} {$action_names[$action]}.");
  }

  if (isset($notices[$message])) {
   list($type, $text) = $notices[$message];
   echo '<div class="notice notice-' . $type . ' is-dismissible"><p>' . esc_html($text) . '</p></div>';
  }
 }

 public function display_pending_users_page() {
  // Handle messages
  if (isset($_GET['message'])) {
   $this->display_admin_notice($_GET['message']);
  }

  $pending_users = $this->get_pending_users_for_this_blog();
  $current_blog_id = get_current_blog_id();
  $available_roles = $this->get_available_roles();

  echo '<div class="wrap pum-container">';
  echo '<h1>User Management for This Site</h1>';
  echo '<p>Manage pending registrations and existing users for this site (ID: ' . $current_blog_id . ')</p>';

  // Pending Users Section
  echo '<div class="pum-section">';
  echo '<h2>Pending Users (' . count($pending_users) . ')</h2>';
  echo '<p>Users who have registered but need activation for this site.</p>';

  if (empty($pending_users)) {
   echo '<p style="margin: 16px; color: #646970; font-style: italic;">No pending users found for this site.</p>';
  } else {
   echo '<form method="post" action="' . admin_url('admin-post.php') . '">';
   wp_nonce_field('bulk-users');
   echo '<input type="hidden" name="action" value="pum_bulk_action">';

   // Bulk actions
   echo '<div class="tablenav top">';
   echo '<div class="alignleft actions bulkactions">';
   echo '<select name="action" id="bulk-action-selector-top">';
   echo '<option value="">Bulk Actions</option>';
   echo '<option value="resend">Resend Activation Email</option>';
   echo '<option value="activate">Activate as Subscriber</option>';
   if (current_user_can('delete_users')) {
    echo '<option value="remove">Remove User</option>';
   }
   echo '</select>';
   echo '<input type="submit" class="button action" value="Apply">';
   echo '</div>';
   echo '</div>';

   echo '<table class="wp-list-table widefat fixed striped pum-table">';
   echo '<thead><tr>';
   echo '<th class="check-column"><input type="checkbox" id="check-all-users"></th>';
   echo '<th>Email</th><th>Login</th><th>Registered</th><th>Actions</th>';
   echo '</tr></thead><tbody>';

   foreach ($pending_users as $user) {
    echo '<tr>';
    echo '<td class="check-column"><input type="checkbox" name="users[]" value="' . esc_attr($user->user_email) . '" class="user-checkbox"></td>';
    echo '<td><strong>' . esc_html($user->user_email) . '</strong></td>';
    echo '<td>' . esc_html($user->user_login) . '</td>';
    echo '<td>' . esc_html(mysql2date('M j, Y g:i a', $user->registered)) . '</td>';
    echo '<td>';

    echo '<div class="pum-action-forms">';

    // Resend activation email
    echo '<form method="post" action="' . admin_url('admin-post.php') . '" class="pum-action-form">';
    wp_nonce_field('pum_resend_' . $user->user_email);
    echo '<input type="hidden" name="action" value="pum_resend_activation">';
    echo '<input type="hidden" name="user_email" value="' . esc_attr($user->user_email) . '">';
    echo '<input type="hidden" name="activation_key" value="' . esc_attr($user->activation_key) . '">';
    echo '<input type="submit" class="button button-secondary" value="Resend Email">';
    echo '</form>';

    // Manual activation
    echo '<form method="post" action="' . admin_url('admin-post.php') . '" class="pum-action-form">';
    wp_nonce_field('pum_activate_' . $user->user_email);
    echo '<input type="hidden" name="action" value="pum_activate_user">';
    echo '<input type="hidden" name="user_email" value="' . esc_attr($user->user_email) . '">';
    echo '<input type="hidden" name="user_login" value="' . esc_attr($user->user_login) . '">';
    echo '<input type="hidden" name="activation_key" value="' . esc_attr($user->activation_key) . '">';
    echo $this->generate_role_selector('role', 'subscriber');
    echo '<input type="submit" class="button button-primary" value="Activate">';
    echo '</form>';

    // Remove user
    if (current_user_can('delete_users')) {
     echo '<form method="post" action="' . admin_url('admin-post.php') . '" class="pum-action-form" data-confirm="Are you sure you want to remove this pending user?">';
     wp_nonce_field('pum_remove_' . $user->user_email);
     echo '<input type="hidden" name="action" value="pum_remove_user">';
     echo '<input type="hidden" name="user_email" value="' . esc_attr($user->user_email) . '">';
     echo '<input type="submit" class="button button-link-delete" value="Remove">';
     echo '</form>';
    }

    echo '</div>';
    echo '</td>';
    echo '</tr>';
   }

   echo '</tbody></table>';
   echo '</form>';
  }
  echo '</div>';

  // Existing Users Section
  echo '<div class="pum-section">';
  echo '<h2>Current Site Members</h2>';
  echo '<p>Users who are already active members of this site.</p>';

  // Get existing users with error handling
  try {
   $existing_users = $this->get_existing_users_for_this_blog();
   echo '<h3>Total Members: ' . count($existing_users) . '</h3>';

   if (empty($existing_users)) {
    echo '<p style="margin: 16px; color: #646970; font-style: italic;">No users found for this site.</p>';
   } else {
    echo '<table class="wp-list-table widefat fixed striped pum-table">';
    echo '<thead><tr>';
    echo '<th>Username</th><th>Email</th><th>Display Name</th><th>Current Role</th><th>Actions</th>';
    echo '</tr></thead><tbody>';

    foreach ($existing_users as $user) {
     echo '<tr>';
     echo '<td><strong>' . esc_html($user->user_login) . '</strong></td>';
     echo '<td>' . esc_html($user->user_email) . '</td>';
     echo '<td>' . esc_html($user->display_name) . '</td>';

     // Display roles safely
     $role_display = 'None';
     if (!empty($user->role_names) && is_array($user->role_names)) {
      $role_display = esc_html(implode(', ', $user->role_names));
     }
     echo '<td>' . $role_display . '</td>';

     echo '<td>';
     echo '<div class="pum-action-forms">';

     // Change role
     if (current_user_can('promote_users')) {
      echo '<form method="post" action="' . admin_url('admin-post.php') . '" class="pum-action-form">';
      wp_nonce_field('pum_change_role_' . $user->ID);
      echo '<input type="hidden" name="action" value="pum_change_user_role">';
      echo '<input type="hidden" name="user_id" value="' . esc_attr($user->ID) . '">';
      echo $this->generate_role_selector('role', $user->primary_role);
      echo '<input type="submit" class="button button-secondary" value="Change Role">';
      echo '</form>';
     }

     // Remove from site (don't allow removal of yourself)
     if (current_user_can('remove_users') && get_current_user_id() != $user->ID) {
      echo '<form method="post" action="' . admin_url('admin-post.php') . '" class="pum-action-form" data-confirm="Are you sure you want to remove this user from this site?">';
      wp_nonce_field('pum_remove_existing_' . $user->ID);
      echo '<input type="hidden" name="action" value="pum_remove_existing_user">';
      echo '<input type="hidden" name="user_id" value="' . esc_attr($user->ID) . '">';
      echo '<input type="submit" class="button button-link-delete" value="Remove from Site">';
      echo '</form>';
     }

     echo '</div>';
     echo '</td>';
     echo '</tr>';
    }

    echo '</tbody></table>';
   }
  } catch (Exception $e) {
   echo '<div class="notice notice-error"><p>Error loading existing users: ' . esc_html($e->getMessage()) . '</p></div>';
  }

  echo '</div>';

  // Summary info
  echo '<div class="notice notice-info">';
  echo '<p><strong>Site ID:</strong> ' . $current_blog_id . '</p>';
  echo '<p><strong>Available Roles:</strong> ' . implode(', ', array_values($available_roles)) . '</p>';
  echo '</div>';

  echo '</div>';
 }
}

// Initialize the plugin
$pending_users_manager = new PendingUsersManager();