<?php

/* ================= Sanitze Outfitters Blog ==================== */
add_action( 'save_post', 'outfitters_meta_save' );
function outfitters_meta_save( $post_id ) {
  
  // Checks save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST[ 'outfittersblog_nonce' ] ) && wp_verify_nonce( $_POST[ 'outfittersblog_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
  
  // Exits script depending on save status
  if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
    return;
  }
  
  // Checks for input and saves if needed
  if( isset( $_POST[ 'outfitters-logo' ] ) ) {
    update_post_meta( $post_id, 'outfitters-logo', $_POST[ 'outfitters-logo' ] );
  }
  
  if( isset( $_POST[ 'outfitters-select-sidebar' ] ) ) {
    update_post_meta( $post_id, 'outfitters-select-sidebar', $_POST[ 'outfitters-select-sidebar' ] );
  }
}
