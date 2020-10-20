<?php
/**
 * Description: New Blog Template Custom Meta Fields
 *
 * @package		tfsBlog
 * @since			1.3.0
 * @author			Chris Parsons
 * @link				http://steelbridge.io
 * @license		GNU General Public License
 */

include( plugin_dir_path( __FILE__ ) . 'inc/sanitize_fields_new_blog.php');

// Adds a meta box to the post editing screen on the template named basic-page-template
function tfs_cust_blog_new() {
  global $post;
  if(!empty($post)){
    $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
    if($pageTemplate == 'page-templates/blog-template-new.php' || 'page-templates/blog-template-travel.php') {
      $types = array('post', 'page', 'lower48', 'lower48blog', 'travel-blog' );
      foreach($types as $type) {
        add_meta_box( 'blog_meta', __( 'Blog Template Options &amp; Content', 'tfs-blog-textdomain' ), 'tfs_newblog_callback', $type, 'normal', 'high' );
      }
    }
  }
}
add_action( 'add_meta_boxes', 'tfs_cust_blog_new' );

// Outputs the content of the meta box
function tfs_newblog_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'new_blog_nonce' );
  $sbm_stored_blog_meta = get_post_meta( $post->ID );
  ?>
  
  <div style="margin-top: 1.618em;">
    <h1>Blog Template Custom Content</h1>
  </div>
  
  <p> <!-- ==== TFS LOGO ==== -->
    
    <label for="blog-template-logo" class="fish-camp-row-title"><?php _e( '<h3>TFS Logo</h3>', 'the-fly-shop' );?></label>
    <input type="text" style="width:50%;" name="blog-template-logo" id="blog-template-logo" value="<?php if ( isset ( $sbm_stored_blog_meta['blog-template-logo'] ) ) echo $sbm_stored_blog_meta['blog-template-logo'][0];?>" />
    <input type="button" id="blog-template-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'the-fly-shop' );?>" />
  
  </p>
  
  <!-- description -->
  <p>
    
    <strong><label for="blog-description-new" class="blog-row-title"><?php _e('Blog Description','tfs-blog-textdomain')?></label></strong>
    <input style="width: 100%;" type="text" name="blog-description-new" id="blog-description-new" value="<?php if (isset($sbm_stored_blog_meta['blog-description-new'])) echo $sbm_stored_blog_meta['blog-description-new'][0]; ?>" />
  </p>
  
  <p>
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  
  <!-- Blog CTA title -->
  <p>
    
    <strong><label for="blog-cta-title-new" class="blog-row-title"><?php _e('Call To Action Tilte','tfs-blog-textdomain')?></label></strong>
    <input style="width: 100%;" type="text" name="blog-cta-title-new" id="blog-cta-title-new" value="<?php if (isset($sbm_stored_blog_meta['blog-cta-title-new'])) echo $sbm_stored_blog_meta['blog-cta-title-new'][0]; ?>" />
  </p>
  
  <p>
    
    <!-- CTA content -->
    <strong><label for="blog-cta-content-new" class="basic-row-title"><?php _e( 'Blog CTA Content', 'tfs-blog-textdomain' )?></label></strong>
    <textarea style="width: 100%;" rows="4" name="blog-cta-content-new" id="blog-cta-content-new"><?php if ( isset ( $sbm_stored_blog_meta['blog-cta-content-new'] ) ) echo $sbm_stored_blog_meta['blog-cta-content-new'][0]; ?></textarea>
  
  </p>

<?php }
