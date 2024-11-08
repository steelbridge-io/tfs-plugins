<?php
/*
Plugin Name: Add Destination Role and Redirect
Description: Adds a custom user role called "Destination" and redirects users with this role to a specific customizable post upon login. Adds a custom dashboard widget with the link and title of the assigned private page.
Version: 1.9
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
      'read_private_posts'       => true, // Capability to read private posts
    )
  );
}

register_activation_hook(__FILE__, 'add_destination_role');
register_deactivation_hook(__FILE__, 'remove_destination_role');

// Hook to remove the role when the plugin is deactivated
function remove_destination_role() {
  remove_role('destination');
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

// Grant the 'destination' role access to private travel forms and specific private pages
function grant_destination_role_private_access() {
  $role = get_role('destination');
  if ($role) {
    $role->add_cap('read_private_posts');
  }
}
add_action('init', 'grant_destination_role_private_access');

// Add a custom user meta field to the user profile page
function add_custom_user_meta_field($user) {
  if (in_array('destination', (array) $user->roles)) { ?>
    <h3><?php _e('Custom Redirect URL for Destination Role', 'custom-user-meta'); ?></h3>
    <table class="form-table">
      <tr>
        <th><label for="custom_redirect_url"><?php _e('Redirect URL'); ?></label></th>
        <td>
          <input type="text" name="custom_redirect_url" id="custom_redirect_url" value="<?php echo esc_attr(get_user_meta($user->ID, 'custom_redirect_url', true)); ?>" class="regular-text" /><br />
          <span class="description"><?php _e('Enter the URL to which you want to redirect this user upon login.'); ?></span>
        </td>
      </tr>
    </table>
  <?php }
}

add_action('show_user_profile', 'add_custom_user_meta_field');
add_action('edit_user_profile', 'add_custom_user_meta_field');

// Save the custom user meta field value
function save_custom_user_meta_field($user_id) {
  if (!current_user_can('edit_user', $user_id)) return false;
  update_user_meta($user_id, 'custom_redirect_url', $_POST['custom_redirect_url']);
}

add_action('personal_options_update', 'save_custom_user_meta_field');
add_action('edit_user_profile_update', 'save_custom_user_meta_field');

// Redirect 'destination' users to a specific page upon login based on the user meta field
function redirect_destination_user_on_login($redirect_to, $request, $user) {
  if (isset($user->roles) && is_array($user->roles) && in_array('destination', $user->roles)) {
    $custom_redirect_url = get_user_meta($user->ID, 'custom_redirect_url', true);
    if ($custom_redirect_url) {
      $redirect_to = $custom_redirect_url;
    }
  }
  return $redirect_to;
}

add_filter('login_redirect', 'redirect_destination_user_on_login', 10, 3);

// Add a custom dashboard widget for 'destination' users
function add_destination_dashboard_widget() {
  if (current_user_can('read_private_posts')) {
    wp_add_dashboard_widget(
      'destination_dashboard_widget',
      'Your Private Page',
      'display_destination_dashboard_widget_content'
    );
  }
}
add_action('wp_dashboard_setup', 'add_destination_dashboard_widget');

// Display the content of the custom dashboard widget
function display_destination_dashboard_widget_content() {
  $user_id = get_current_user_id();
  $custom_redirect_url = get_user_meta($user_id, 'custom_redirect_url', true);

  if ($custom_redirect_url) {
    $page_id = url_to_postid($custom_redirect_url);
    $page_title = get_the_title($page_id);
    echo '<p>You have access to the following private page:</p>';
    echo '<p><strong>Title:</strong> ' . esc_html($page_title) . '</p>';
    echo '<p><strong>Link:</strong> <a href="' . esc_url($custom_redirect_url) . '">' . esc_html($custom_redirect_url) . '</a></p>';
  } else {
    echo '<p>No private page assigned yet.</p>';
  }
}

// Remove default dashboard widgets for 'destination' role
function remove_default_dashboard_widgets() {
  if (current_user_can('destination')) {
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Activity
    remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress Events and News
  }
}
add_action('wp_dashboard_setup', 'remove_default_dashboard_widgets', 20);

// Remove the toolbar option for 'destination' users
function remove_toolbar_option() {
  if (current_user_can('destination')) {
    //echo '<style>.show-admin-bar { display: none; }</style>';
   /* echo '<script type="text/javascript">
            jQuery(document).ready(function($) {
              $("#your-profile .show-admin-bar").remove();
            });
          </script>';*/
    wp_enqueue_style('remove-admin-bar-style', plugins_url('assets/css/admin-styles.css', __FILE__));
    wp_enqueue_script('remove-admin-bar-script', plugins_url('assets/js/admin-js.js', __FILE__), array('jquery'),
      '1.0.0', true);
  }
}
add_action('admin_enqueue_scripts', 'remove_toolbar_option');

function redirect_travel_form_to_login_wp_hook() {
  if (!is_user_logged_in() &&
    (strpos($_SERVER['REQUEST_URI'], '/travel-form/') === 0 || $_SERVER['REQUEST_URI'] === '/travel-form')) {
    // Redirect to the wp-admin login page
    wp_redirect(wp_login_url());
    exit;
  }
}
add_action('template_redirect', 'redirect_travel_form_to_login_wp_hook');