<?php
/* ========== Saves/Sanitizes ========== */

function update_landing_page_meta(
	$post_id,
	$meta_key,
	$request_key,
	$sanitize_callback
) {
	if ( isset( $_POST[ $request_key ] ) ) {
		$sanitized_value = call_user_func( $sanitize_callback,
			$_POST[ $request_key ] );
		if ( $sanitized_value || $sanitized_value === '0' ) {
			update_post_meta( $post_id, $meta_key, $sanitized_value );
		} else {
			echo '<h2>Not Okay</h2>';
		}
	}
}

function landing_page_meta_save( $post_id ) {
	
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['landing_page_nonce'] )
	                    && wp_verify_nonce( $_POST['landing_page_nonce'],
			basename( __FILE__ ) ) ) ? 'true' : 'false';
	
	// Exits script depending on save status
	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}
	
	update_landing_page_meta( $post_id,
		'landing-page-logo',
		'landing-page-logo',
		'sanitize_text_field' );
	update_landing_page_meta( $post_id,
		'landing-page-image',
		'landing-page-image',
		'esc_url_raw' );
	update_landing_page_meta( $post_id,
		'landing-page-desc',
		'landing-page-desc',
		'sanitize_text_field' );
}

add_action( 'save_post', 'landing_page_meta_save' );
