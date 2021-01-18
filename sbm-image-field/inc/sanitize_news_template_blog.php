<?php

/* ================= Sanitze Outfitters Blog ==================== */
add_action( 'save_post', 'news_template_meta_save' );
function news_template_meta_save( $post_id ) {
  
  // Checks save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST[ 'newsTemplate_nonce' ] ) && wp_verify_nonce( $_POST[ 'newsTemplate_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
  
  // Exits script depending on save status
  if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
    return;
  }
  
  // Checks for input and saves if needed
  if( isset( $_POST[ 'news-template-logo' ] ) ) {
    update_post_meta( $post_id, 'news-template-logo', $_POST[ 'news-template-logo' ] );
  }
  
  if( isset( $_POST[ 'news-template-select-sidebar' ] ) ) {
    update_post_meta( $post_id, 'news-template-select-sidebar', $_POST[ 'news-template-select-sidebar' ] );
  }
  
  if( isset( $_POST[ 'news-template-description' ] ) ) {
    update_post_meta( $post_id, 'news-template-description', $_POST[ 'news-template-description' ] );
  }
  
  if( isset( $_POST[ 'news-template-select-post' ] ) ) {
    update_post_meta( $post_id, 'news-template-select-post', $_POST[ 'news-template-select-post' ] );
  }
}
