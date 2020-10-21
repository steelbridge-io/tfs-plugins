<?php

/*
 * Outfitters Meta
 */

//ob_implicit_flush(true);
include( plugin_dir_path( __FILE__ ) . '../inc/sanitize_outfitters_blog.php');

function outfitters_blog_custom_meta() { global $post;
  
  if(!empty($post)) {
    $pageTemplate = get_post_meta ($post -> ID, '_wp_page_template', true);
    $types = array('flyfishing-news');
    foreach ($types as $type) {
      if($pageTemplate == 'page-templates/blog-template-outfitters.php') {
        add_meta_box ( 'outfitters_meta', __('Outfitters Blog Template Options', 'the-fly-shop' ), 'outfittersblog_meta_callback', $type, 'normal', 'high');
      }
    }
  }
}
add_action( 'add_meta_boxes', 'outfitters_blog_custom_meta' );

/**
 * Adds Custom Field Image Meta Box
 */
//ob_start();
function outfittersblog_meta_callback( $post ) {
wp_nonce_field( basename( __FILE__ ), 'outfittersblog_nonce' );
$outfittersblog_stored_meta = get_post_meta( $post->ID );?>
  
  <p>
    <label for="outfitters-select-sidebar" class="prfx-row-title"><h3><?php _e( 'Sidebar Select', 'The_Fly_Shop' )?></h3></label>
    <select name="outfitters-select-sidebar" id="outfitters-select-sidebar">
      <option value="" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], '' ); ?>><?php _e( 'Default', 'The_Fly_Shop' )?></option>';
      <option value="esblodge" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], 'esblodge' ); ?>><?php _e( 'ESB Lodge', 'The_Fly_Shop' )?></option>';
      <option value="lavacreeklodge" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], 'lavacreeklodge' ); ?>><?php _e( 'Lava Creek Lodge', 'The_Fly_Shop' )?></option>';
      <option value="lower48" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], 'lower48' ); ?>><?php _e( 'Lower 48', 'The_Fly_Shop' )?></option>';
      <option value="news" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], 'news' ); ?>><?php _e( 'News', 'The_Fly_Shop' )?></option>';
      <option value="outfitter" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], 'outfitter' ); ?>><?php _e( 'Outfitters', 'The_Fly_Shop' )?></option>';
      <option value="retail" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], 'retail' ); ?>><?php _e( 'Retail', 'The_Fly_Shop' )?></option>';
      <option value="survey" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], 'survey' ); ?>><?php _e( 'Survey', 'The_Fly_Shop' )?></option>';
      <option value="travel" <?php if ( isset ( $outfittersblog_stored_meta['outfitters-select-sidebar'] ) ) selected( $outfittersblog_stored_meta['outfitters-select-sidebar'][0], 'travel' ); ?>><?php _e( 'Travel', 'The_Fly_Shop' )?></option>';
    </select>
  </p>
  
  <p> <!-- ==== Blog Logo ==== -->
    <label for="outfitters-logo" class="travel-row-title"><?php _e( '<h3>TFS Logo</h3>', 'the-fly-shop' );?></label>
    
    <input type="text" name="outfitters-logo" id="outfitters-logo" value="<?php if ( isset ( $outfittersblog_stored_meta['outfitters-logo'] ) ) echo $outfittersblog_stored_meta['outfitters-logo'][0];?>" />
    <input type="button" id="outfitters-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>


<?php  }
