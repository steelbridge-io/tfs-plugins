<?php
/**
 * Adds a meta box to the post editing screen
 */

// Prevents direct access to files
if (!defined('ABSPATH')) {
  exit('Cheatin&#8217; uh?');
}

include( plugin_dir_path( __FILE__ ) . '../inc/sanitize_private_image.php');

function private_custom_meta() { global $post;
  
  if(!empty($post)) {
    $pageTemplate = get_post_meta ($post -> ID, '_wp_page_template', true);
    $types = array('post', 'page', 'adventures');
    foreach ($types as $type) {
      if($pageTemplate == 'page-templates/private-video-template.php' or $pageTemplate == 'page-templates/private-template.php') {
        add_meta_box ( 'private_meta', __('Private Water Images', 'private-textdomain' ), 'private_meta_callback', $type, 'normal', 'high');
      }
    }
  }
}
add_action( 'add_meta_boxes', 'private_custom_meta' );
/**
 * Outputs the content of the meta box
 */

function private_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'private_nonce' );
  $private_stored_meta = get_post_meta( $post->ID );?>
  <p> <!-- ==== TFS LOGO ==== -->
    
    <label for="private-logo" class="private-row-title"><?php _e( '<h3>TFS Logo</h3>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-logo" id="private-logo" value="<?php if ( isset ( $private_stored_meta['private-logo'] ) ) echo $private_stored_meta['private-logo'][0];?>" />
    <input type="button" id="private-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== PRIVATE HERO IMAGE ==== -->
    
    <label for="private-image" class="private-row-title"><?php _e( '<h3>Private Water Hero Image</h3>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-image" id="private-image" value="<?php if ( isset ( $private_stored_meta['private-image'] ) ) echo $private_stored_meta['private-image'][0];?>" />
    <input type="button" id="private-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  
  <p> <!-- ==== FEATURE #1 / PRIVATE WATERS DETAILS IMAGE ==== -->
    
    <label for="feature-pw1-image" class="private-row-title"><?php _e( '<h3>Feature &#35;1 Imagery</h3>', 'private-textdomain' );?></label><br>
    <input type="text" name="feature-pw1-image" id="feature-pw1-image" value="<?php if ( isset ( $private_stored_meta['feature-pw1-image'] ) ) echo $private_stored_meta['feature-pw1-image'][0];?>" />
    <input type="button" id="feature-pw1-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== FEATURE #1 / PRIVATE WATERS TEXT/VIDEO ==== -->
    
    <label for="feature-pw1-video" class="private-row-title"><?php _e( '<strong>Add Video URL:</strong>', 'private-textdomain' )?></label>
    <input type="url" name="feature-pw1-video" id="feature-pw1-video" value="<?php if ( isset ( $private_stored_meta['feature-pw1-video'] ) ) echo $private_stored_meta['feature-pw1-video'][0]; ?>" />
  </p>
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== FEATURE #2 / SEASONS IMAGE ==== -->
    
    <label for="feature-pw2-image" class="private-row-title"><?php _e( '<h3>Feature &#35;2 Imagery</h3>', 'private-textdomain' );?></label><br>
    <input type="text" name="feature-pw2-image" id="feature-pw2-image" value="<?php if ( isset ( $private_stored_meta['feature-pw2-image'] ) ) echo $private_stored_meta['feature-pw2-image'][0];?>" />
    <input type="button" id="feature-pw2-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== FEATURE #2 / TRAVEL TEXT/VIDEO ==== -->
    
    <label for="feature-pw2-video" class="private-row-title"><?php _e( '<strong>Add Video URL:</strong>', 'private-textdomain' )?></label>
    <input type="url" name="feature-pw2-video" id="feature-pw2-video" value="<?php if ( isset ( $private_stored_meta['feature-pw2-video'] ) ) echo $private_stored_meta['feature-pw2-video'][0]; ?>" />
    
  </p>
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== FEATURE #3 / GETTING TO IMAGE ==== -->
    
    <label for="feature-pw3-image" class="private-row-title"><?php _e( '<h3>Feature &#35;3 Imagery</h3>', 'private-textdomain' );?></label><br>
    <input type="text" name="feature-pw3-image" id="feature-pw3-image" value="<?php if ( isset ( $private_stored_meta['feature-pw3-image'] ) ) echo $private_stored_meta['feature-pw3-image'][0];?>" />
    <input type="button" id="feature-pw3-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== FEATURE #3 / GETTING TO TEXT/VIDEO ==== -->
    
    <label for="feature-pw3-video" class="private-row-title"><?php _e( '<strong>Add Video URL:</strong>', 'private-textdomain' )?></label>
    <input type="url" name="feature-pw3-video" id="feature-pw3-video" value="<?php if ( isset ( $private_stored_meta['feature-pw3-video'] ) ) echo $private_stored_meta['feature-pw3-video'][0]; ?>" />
    
  </p>
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== FEATURE #4 / LODGING IMAGE ==== -->
    
    <label for="feature-pw4-image" class="private-row-title"><?php _e( '<h3>Feature &#35;4 Imagery</h3>', 'private-textdomain' );?></label><br>
    <input type="text" name="feature-pw4-image" id="feature-pw4-image" value="<?php if ( isset ( $private_stored_meta['feature-pw4-image'] ) ) echo $private_stored_meta['feature-pw4-image'][0];?>" />
    <input type="button" id="feature-pw4-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== FEATURE #4 / LODGING TEXT/VIDEO ==== -->
    
    <label for="feature-pw4-video" class="private-row-title"><?php _e( '<strong>Add Video URL:</strong>', 'private-textdomain' )?></label>
    <input type="url" name="feature-pw4-video" id="feature-pw4-video" value="<?php if ( isset ( $private_stored_meta['feature-pw4-video'] ) ) echo $private_stored_meta['feature-pw4-video'][0]; ?>" />
    
  </p>
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== FEATURE #5 / FISHING IMAGE ==== -->
    
    <label for="feature-pw5-image" class="private-row-title"><?php _e( '<h3>Feature &#35;5 Imagery</h3>', 'private-textdomain' );?></label><br>
    <input type="text" name="feature-pw5-image" id="feature-pw5-image" value="<?php if ( isset ( $private_stored_meta['feature-pw5-image'] ) ) echo $private_stored_meta['feature-pw5-image'][0];?>" />
    <input type="button" id="feature-pw5-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== FEATURE #5 / FISHING TEXT/VIDEO ==== -->
    
    <label for="feature-pw5-video" class="private-row-title"><?php _e( '<strong>Add Video URL:</strong>', 'private-textdomain' )?></label>
    <input type="url" name="feature-pw5-video" id="feature-pw5-video" value="<?php if ( isset ( $private_stored_meta['feature-pw5-video'] ) ) echo $private_stored_meta['feature-pw5-video'][0]; ?>" />
    
  </p>
  
  <!-- ====== ADDITIONAL INFORMATION SECTION ====== -->
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <h3><?php echo 'Additional Info Section Images'?></h3>
  
  <p> <!-- Additional Information Image #1 -->
    
    <label for="private-additional-info-image1" class="travel-row-title"><?php _e( '<strong>Additional image &#35;1</strong>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-additional-info-image1" id="private-additional-info-image1" value="<?php if ( isset ( $private_stored_meta['private-additional-info-image1'] ) ) echo $private_stored_meta['private-additional-info-image1'][0];?>" />
    <input type="button" id="private-additional-info-image1-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Information Image #2 -->
    
    <label for="private-additional-info-image2" class="travel-row-title"><?php _e( '<strong>Additional image &#35;2</strong>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-additional-info-image2" id="private-additional-info-image2" value="<?php if ( isset ( $private_stored_meta['private-additional-info-image2'] ) ) echo $private_stored_meta['private-additional-info-image2'][0];?>" />
    <input type="button" id="private-additional-info-image2-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Information Image #3 -->
    
    <label for="private-additional-info-image3" class="travel-row-title"><?php _e( '<strong>Additional image &#35;3</strong>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-additional-info-image3" id="private-additional-info-image3" value="<?php if ( isset ( $private_stored_meta['private-additional-info-image3'] ) ) echo $private_stored_meta['private-additional-info-image3'][0];?>" />
    <input type="button" id="private-additional-info-image3-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Information Image #4 -->
    
    <label for="private-additional-info-image4" class="travel-row-title"><?php _e( '<strong>Additional image &#35;4</strong>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-additional-info-image4" id="private-additional-info-image4" value="<?php if ( isset ( $private_stored_meta['private-additional-info-image4'] ) ) echo $private_stored_meta['private-additional-info-image4'][0];?>" />
    <input type="button" id="private-additional-info-image4-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Information Image #5 -->
    
    <label for="private-additional-info-image5" class="travel-row-title"><?php _e( '<strong>Additional image &#35;5</strong>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-additional-info-image5" id="private-additional-info-image5" value="<?php if ( isset ( $private_stored_meta['private-additional-info-image5'] ) ) echo $private_stored_meta['private-additional-info-image5'][0];?>" />
    <input type="button" id="private-additional-info-image5-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Information Image #6 -->
    
    <label for="private-additional-info-image6" class="travel-row-title"><?php _e( '<strong>Additional image &#35;6</strong>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-additional-info-image6" id="private-additional-info-image6" value="<?php if ( isset ( $private_stored_meta['private-additional-info-image6'] ) ) echo $private_stored_meta['private-additional-info-image6'][0];?>" />
    <input type="button" id="private-additional-info-image6-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Information Image #7 -->
    
    <label for="private-additional-info-image7" class="travel-row-title"><?php _e( '<strong>Additional image &#35;7</strong>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-additional-info-image7" id="private-additional-info-image7" value="<?php if ( isset ( $private_stored_meta['private-additional-info-image7'] ) ) echo $private_stored_meta['private-additional-info-image7'][0];?>" />
    <input type="button" id="private-additional-info-image7-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Information Image #8 -->
    
    <label for="private-additional-info-image8" class="travel-row-title"><?php _e( '<strong>Additional image &#35;8</strong>', 'private-textdomain' );?></label><br>
    <input type="text" name="private-additional-info-image8" id="private-additional-info-image8" value="<?php if ( isset ( $private_stored_meta['private-additional-info-image8'] ) ) echo $private_stored_meta['private-additional-info-image8'][0];?>" />
    <input type="button" id="private-additional-info-image8-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'private-textdomain' );?>" />
  
  </p>

<?php }
