<?php
// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function add_destination_client_role() {
	// Debug log to check if the function is called.
	if ( WP_DEBUG ) {
		error_log( 'add_destination_client_role function is called' );
	}
	
	// Add the new role with specific capabilities.
	add_role(
		'destination_client',
		'Destination Client',
		array(
			'read'                   => true,
			'read_private_posts'     => true,
			'read_private_travel-forms' => true  // Capability to read private travel-form posts.
		)
	);
	
	// Debug log to check role existence after adding.
	if ( WP_DEBUG ) {
		$role = get_role( 'destination_client' );
		if ( $role ) {
			error_log( 'Role successfully created: ' . print_r( $role, true ) );
		} else {
			error_log( 'Failed to create role.' );
		}
	}
	
	// Add the custom capability to Administrator as well (optional).
	$admin_role = get_role('administrator');
	if ( $admin_role ) {
		$admin_role->add_cap('read_private_travel-forms');
	}
}

// Hook into WordPress to run the function when the plugin is activated
register_activation_hook( __FILE__, 'add_destination_client_role' );

function remove_destination_client_role() {
	// Debug log to check if the function is called
	if ( WP_DEBUG ) {
		error_log( 'remove_destination_client_role function is called' );
	}
	
	// Remove the role on plugin deactivation
	remove_role('destination_client');
}

// Hook into WordPress to run the function when the plugin is deactivated
register_deactivation_hook( __FILE__, 'remove_destination_client_role' );