<?php
/**
 * Description: Basic Blog Template Custom Meta Fields
 *
 * @package		tfsBasic
 * @since			1.3.0
 * @author			Chris Parsons
 * @link				http://steelbridge.io
 * @license		GNU General Public License
 */

include( plugin_dir_path( __FILE__ ) . 'inc/sanitize_fields_blog_basic.php');

// Adds a meta box to the post editing screen on the template named basic-page-template
function tfs_basic_blog_template_meta() {
  global $post;
  if(!empty($post)){
    $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
    if($pageTemplate == 'page-templates/blog-template-basic.php') {
      $types = array( 'post', 'page', 'travel_blog', 'lower48blog', 'esb_lodge');
      foreach($types as $type) {
        add_meta_box( 'basic_meta', __( 'Basic Blog Template Options', 'the-fly-shop' ), 'tfs_basic_blog_meta_callback', $type, 'normal', 'high' );
      }
    }
  }
}
add_action( 'add_meta_boxes', 'tfs_basic_blog_template_meta' );

// Outputs the content of the meta box
function tfs_basic_blog_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'basicblog_nonce' );
  $tfs_basic_blog_template_meta = get_post_meta( $post->ID );
  ?>
  
  <div style="margin-top: 1.618em;">
    <h1>Basic Blog Template Color Options</h1>
  </div>
  
  <div class="container">
    <div class="row">
      <div class="col-md-2">
      <p>
        <label for="basic-blog-template-bg-color" class="basic-blog-template-bg-color"><?php _e( 'Main Content Background', 'the-fly-shop' )?></label>
        <input name="basic-blog-template-bg-color" type="text" value="<?php if ( isset ( $tfs_basic_blog_template_meta['basic-blog-template-bg-color'] ) ) echo $tfs_basic_blog_template_meta['basic-blog-template-bg-color'][0]; ?>" class="basicblog-template-bg-color" />
      </p>
      </div>
      <div class="col-md-2">
      <p>
        <label for=" basic-blog-text-color" class=" basic-blog-text-color"><?php _e( 'Main Content Text Color', 'the-fly-shop' )?></label>
        <input name=" basic-blog-text-color" type="text" value="<?php if ( isset ( $tfs_basic_blog_template_meta['basic-blog-text-color'] ) ) echo $tfs_basic_blog_template_meta['basic-blog-text-color'][0]; ?>" class="basic-blog-text-color-button" />
      </p>
      </div>
      <div class="col-md-2">
        <p>
          <label for="basic-blog-fullpage-bg-color" class="basic-blog-fullpage-bg-color"><?php _e( 'Full Page Background', 'the-fly-shop' )?></label>
          <input name="basic-blog-fullpage-bg-color" type="text" value="<?php if ( isset ( $tfs_basic_blog_template_meta['basic-blog-fullpage-bg-color'] ) ) echo $tfs_basic_blog_template_meta['basic-blog-fullpage-bg-color'][0]; ?>" class="basicblog-fullpage-bg-color" />
        </p>
      </div>
      <div class="col-md-2">
        <p>
          <label for="basic-blog-fullpage-txt-color" class="basic-blog-fullpage-txt-color"><?php _e( 'Full Page Text Color', 'the-fly-shop' )?></label>
          <input name="basic-blog-fullpage-txt-color" type="text" value="<?php if ( isset ( $tfs_basic_blog_template_meta['basic-blog-fullpage-txt-color'] ) ) echo $tfs_basic_blog_template_meta['basic-blog-fullpage-txt-color'][0]; ?>" class="basicblog-fullpage-txt-color" />
        </p>
      </div>
      <div class="col-md-2">
        <p>
          <label for="basic-blog-sidebar-bg-color" class="basic-blog-sidebar-bg-color"><?php _e( 'Sidebar Background Color', 'the-fly-shop' )?></label>
          <input name="basic-blog-sidebar-bg-color" type="text" value="<?php if ( isset ( $tfs_basic_blog_template_meta['basic-blog-sidebar-bg-color'] ) ) echo $tfs_basic_blog_template_meta['basic-blog-sidebar-bg-color'][0]; ?>" class="basicblog-sidebar-bg-color" />
        </p>
      </div>
    </div>
  </div>

<?php }

