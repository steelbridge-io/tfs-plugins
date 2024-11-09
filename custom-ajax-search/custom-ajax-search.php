<?php
/*
Plugin Name: Custom AJAX Search for Travel Form
Description: Adds a search field via shortcode to search "travel-form" custom post type and includes private pages in search results for logged-in users.
Version: 1.1
Author: Your Name
*/

// Register the shortcode
function custom_search_shortcode() {
  // Enqueue necessary scripts and styles
  wp_enqueue_script('jquery');
  wp_enqueue_script('custom-ajax-search', plugin_dir_url(__FILE__) . 'custom-ajax-search.js', array('jquery'), null, true);
  wp_localize_script('custom-ajax-search', 'cas_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
  wp_enqueue_style('custom-ajax-search-style', plugin_dir_url(__FILE__) . 'custom-ajax-search.css');

  // HTML for the search field
  return '<div class="custom-search-wrapper">
                <input type="text" id="custom-search-field" placeholder="Search Guest Data Destination Table...">
                <div id="custom-search-results"></div>
            </div>';
}
add_shortcode('custom_search', 'custom_search_shortcode');

// Handle the AJAX search
function custom_ajax_search() {
  // Ensure there's a search term and it's at least three characters long
  $search_term = isset($_POST['search_term']) ? sanitize_text_field($_POST['search_term']) : '';
  if (strlen($search_term) < 3) {
    wp_send_json(array());
    wp_die();
  }

  // Build the query args
  $args = array(
    'post_type' => 'travel-form',
    's' => $search_term,
    'post_status' => is_user_logged_in() ? array('publish', 'private') : 'publish',
    'posts_per_page' => 10,
  );

  // Execute the query
  $query = new WP_Query($args);
  $results = array();

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $results[] = array(
        'title' => get_the_title(),
        'link' => get_permalink(),
      );
    }
  }

  // Send the results
  wp_send_json($results);
  wp_die();
}
add_action('wp_ajax_custom_ajax_search', 'custom_ajax_search');
add_action('wp_ajax_nopriv_custom_ajax_search', 'custom_ajax_search');
?>