<?php

/*
 * News Template Meta
 */

//ob_implicit_flush(true);
include( plugin_dir_path( __FILE__ ) . '../inc/sanitize_news_template_blog.php');

function newstemplate_custom_meta() { global $post;
  
  if(!empty($post)) {
    $pageTemplate = get_post_meta ($post -> ID, '_wp_page_template', true);
	  $types = array( 'post', 'page', 'lower48', 'lower48blog', 'travel-blog' );
    foreach ($types as $type) {
      if($pageTemplate == 'page-templates/news-blog-template.php') {
        add_meta_box ( 'news_blog_template_meta', __('News Template Options', 'the-fly-shop' ), 'newstemplate_meta_calback', $type, 'normal', 'high');
      }
    }
  }
}
add_action( 'add_meta_boxes', 'newstemplate_custom_meta' );

/**
 * Adds Custom Field Image Meta Box
 */
//ob_start();
function newstemplate_meta_calback( $post ) {
wp_nonce_field( basename( __FILE__ ), 'newsTemplate_nonce' );
$news_template_stored_meta = get_post_meta( $post->ID );?>
  
  <p>
    <label for="news-template-select-sidebar" class="prfx-row-title"><h3><?php _e( 'Sidebar Select', 'The_Fly_Shop' )?></h3></label>
    <select name="news-template-select-sidebar" id="news-template-select-sidebar">
      <option value="" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], '' ); ?>><?php _e( 'Default', 'The_Fly_Shop' )?></option>';
      <option value="esblodge" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'esblodge' ); ?>><?php _e( 'ESB Lodge', 'The_Fly_Shop' )?></option>';
      <option value="lavacreeklodge" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'lavacreeklodge' ); ?>><?php _e( 'Lava Creek Lodge', 'The_Fly_Shop' )?></option>';
      <option value="lower48" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'lower48' ); ?>><?php _e( 'Lower 48', 'The_Fly_Shop' )?></option>';
      <option value="news" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'news' ); ?>><?php _e( 'News', 'The_Fly_Shop' )?></option>';
      <option value="outfitter" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'outfitter' ); ?>><?php _e( 'Outfitters', 'The_Fly_Shop' )?></option>';
      <option value="retail" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'retail' ); ?>><?php _e( 'Retail', 'The_Fly_Shop' )?></option>';
      <option value="survey" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'survey' ); ?>><?php _e( 'Survey', 'The_Fly_Shop' )?></option>';
      <option value="travel" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'travel' ); ?>><?php _e( 'Travel', 'The_Fly_Shop' )?></option>';
      <option value="blogarchive" <?php if ( isset ( $news_template_stored_meta['news-template-select-sidebar'] ) ) selected( $news_template_stored_meta['news-template-select-sidebar'][0], 'blogarchive' ); ?>><?php _e( 'Blog Archive', 'The_Fly_Shop' )?></option>';
    </select>
  </p>
  
  <p> <!-- ==== Blog Logo ==== -->
    <label for="news-template-logo" class="travel-row-title"><?php _e( '<h3>TFS Logo</h3>', 'the-fly-shop' );?></label>
    
    <input type="text" name="news-template-logo" id="news-template-logo" value="<?php if ( isset ( $news_template_stored_meta['news-template-logo'] ) ) echo $news_template_stored_meta['news-template-logo'][0];?>" />
    <input type="button" id="news-template-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>


<?php  }
