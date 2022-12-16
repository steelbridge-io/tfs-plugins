<?php
/**
 * Adds a meta box to the post editing screen
 */
ob_implicit_flush(true);
include( plugin_dir_path( __FILE__ ) . '../inc/sanitize_travel_image.php');

function travel_custom_meta() { global $post;
  
  if(!empty($post)) {
    $pageTemplate = get_post_meta ($post -> ID, '_wp_page_template', true);
    $types = array('post', 'page', 'travel_cpt', 'lower48', 'esb_lodge');
    if($pageTemplate == 'page-templates/travel-template.php') {
      add_meta_box ( 'travel_meta', __('Travel Images', 'travel-textdomain' ), 'travel_meta_callback', $types, 'normal', 'high');
    }
  }
}
add_action( 'add_meta_boxes', 'travel_custom_meta' );
/**
 * Outputs the content of the meta box
 */
ob_start();
function travel_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'travel_nonce' );
  $travel_stored_meta = get_post_meta( $post->ID );?>
  
  <p> <!-- ==== TFS LOGO ==== -->
    <label for="travel-logo" class="travel-row-title"><?php _e( '<h3>TFS Logo</h3>', 'travel-textdomain' );?></label>
    
    <input type="text" name="travel-logo" id="travel-logo" value="<?php if ( isset ( $travel_stored_meta['travel-logo'] ) ) echo $travel_stored_meta['travel-logo'][0];?>" />
    <input type="button" id="travel-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>
  
  <p> <!-- ==== TRAVEL HERO IMAGE ==== -->
    <label for="travel-image" class="travel-row-title"><?php _e( '<h3>Travel Hero Image</h3>', 'travel-textdomain' );?></label>
    
    <input type="text" name="travel-image" id="travel-image" value="<?php if ( isset ( $travel_stored_meta['travel-image'] ) ) echo $travel_stored_meta['travel-image'][0];?>" />
    <input type="button" id="travel-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== COST / TRAVEL DETAILS IMAGE ==== -->
    <label for="feature-1-image" class="travel-row-title"><?php _e( '<h3>Costs Imagery</h3>', 'travel-textdomain' );?></label>
    
    <input type="text" name="feature-1-image" id="feature-1-image" value="<?php if ( isset ( $travel_stored_meta['feature-1-image'] ) ) echo $travel_stored_meta['feature-1-image'][0];?>" />
    <input type="button" id="feature-1-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>
  
  <p> <!-- ==== COST / TRAVEL TEXT/VIDEO ==== -->
    <label for="feature-1-video" class="travel-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'travel-textdomain' )?></label>
    <input type="url" name="feature-1-video" id="feature-1-video" value="<?php if ( isset ( $travel_stored_meta['feature-1-video'] ) ) echo $travel_stored_meta['feature-1-video'][0]; ?>" />
  </p>
  
  <p> <!-- ==== COST / TAVEL VIDEO/IMAGE OPTION ==== -->
    <span class="travel-row-title"><?php _e( '<strong>Image or Video?</strong>', 'travel-textdomain' )?></span>
    <div class="travel-row-content">
      <label for="feature-1-checkbox">
        <input type="checkbox" name="feature-1-checkbox" id="feature-1-checkbox" value="yes" <?php if ( isset ( $travel_stored_meta['feature-1-checkbox'] ) ) checked( $travel_stored_meta['feature-1-checkbox'][0], 'yes' ); ?> />
        <?php _e( 'Check box if you are importing video. Leave unchecked for image.', 'travel-textdomain' )?>
      </label>
      </label>
    </div>
  </p>
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== SEASONS IMAGE ==== -->
    <label for="feature-2-image" class="travel-row-title"><?php _e( '<h3>Seasons Imagery</h3>', 'travel-textdomain' );?></label>
    
    <input type="text" name="feature-2-image" id="feature-2-image" value="<?php if ( isset ( $travel_stored_meta['feature-2-image'] ) ) echo $travel_stored_meta['feature-2-image'][0];?>" />
    <input type="button" id="feature-2-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>
  
  <p> <!-- ==== SEASONS / TRAVEL TEXT/VIDEO ==== -->
    <label for="feature-2-video" class="travel-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'travel-textdomain' )?></label>
    <input type="url" name="feature-2-video" id="feature-2-video" value="<?php if ( isset ( $travel_stored_meta['feature-2-video'] ) ) echo $travel_stored_meta['feature-2-video'][0]; ?>" />
  </p>
  
  <p> <!-- ==== SEASONS / TAVEL VIDEO/IMAGE OPTION ==== -->
    <span class="travel-row-title"><?php _e( '<strong>Image or Video?</strong>', 'travel-textdomain' )?></span>
    <div class="travel-row-content">
      <label for="feature-2-checkbox">
        <input type="checkbox" name="feature-2-checkbox" id="feature-2-checkbox" value="yes" <?php if ( isset ( $travel_stored_meta['feature-2-checkbox'] ) ) checked( $travel_stored_meta['feature-2-checkbox'][0], 'yes' ); ?> />
        <?php _e( 'Check box if you are importing video.', 'travel-textdomain' )?>
      </label>
      </label>
    </div>
  </p>
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== GETTING TO THE DESTINATION ==== -->
    <label for="feature-3-gettingto-image" class="travel-row-title"><?php _e( '<h3>Getting To Destination Imagery</h3>', 'travel-textdomain' );?></label>
    
    <input type="text" name="feature-3-gettingto-image" id="feature-3-gettingto-image" value="<?php if ( isset ( $travel_stored_meta['feature-3-gettingto-image'] ) ) echo $travel_stored_meta['feature-3-gettingto-image'][0];?>" />
    <input type="button" id="feature-3-gettingto-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>
  
  <p> <!-- ==== GETTING TO / TRAVEL TEXT/VIDEO ==== -->
    <label for="feature-3-video" class="travel-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'travel-textdomain' )?></label>
    <input type="url" name="feature-3-video" id="feature-3-video" value="<?php if ( isset ( $travel_stored_meta['feature-3-video'] ) ) echo $travel_stored_meta['feature-3-video'][0]; ?>" />
  </p>
  
  <p> <!-- ==== GETTING TO / TAVEL VIDEO/IMAGE OPTION ==== -->
    <span class="travel-row-title"><?php _e( '<strong>Image or Video?</strong>', 'travel-textdomain' )?></span>
    <div class="travel-row-content">
      <label for="feature-3-checkbox">
        <input type="checkbox" name="feature-3-checkbox" id="feature-3-checkbox" value="yes" <?php if ( isset ( $travel_stored_meta['feature-3-checkbox'] ) ) checked( $travel_stored_meta['feature-3-checkbox'][0], 'yes' ); ?> />
        <?php _e( 'Check box if you are importing video.', 'travel-textdomain' )?>
      </label>
      </label>
    </div>
  </p>
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== LODGING ==== -->
    <label for="feature-4-lodging-image" class="travel-row-title"><?php _e( '<h3>Lodging Imagery</h3>', 'travel-textdomain' );?></label>
    
    <input type="text" name="feature-4-lodging-image" id="feature-4-lodging-image" value="<?php if ( isset ( $travel_stored_meta['feature-4-lodging-image'] ) ) echo $travel_stored_meta['feature-4-lodging-image'][0];?>" />
    <input type="button" id="feature-4-lodging-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>
  
  <p> <!-- ==== LODGING / TRAVEL TEXT/VIDEO ==== -->
    <label for="feature-4-video" class="travel-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'travel-textdomain' )?></label>
    <input type="url" name="feature-4-video" id="feature-4-video" value="<?php if ( isset ( $travel_stored_meta['feature-4-video'] ) ) echo $travel_stored_meta['feature-4-video'][0]; ?>" />
  </p>
  
  <p> <!-- ==== LODGING / TAVEL VIDEO/IMAGE OPTION ==== -->
    <span class="travel-row-title"><?php _e( '<strong>Image or Video?</strong>', 'travel-textdomain' )?></span>
    <div class="travel-row-content">
      <label for="feature-4-checkbox">
        <input type="checkbox" name="feature-4-checkbox" id="feature-4-checkbox" value="yes" <?php if ( isset ( $travel_stored_meta['feature-4-checkbox'] ) ) checked( $travel_stored_meta['feature-4-checkbox'][0], 'yes' ); ?> />
        <?php _e( 'Check box if you are importing video.', 'travel-textdomain' )?>
      </label>
      </label>
    </div>
  </p>
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== FISHING / ANGLING ==== -->
    <label for="feature-5-angling-image" class="travel-row-title"><?php _e( '<h3>Fishing Imagery</h3>', 'travel-textdomain' );?></label>
    <input type="text" name="feature-5-angling-image" id="feature-5-angling-image" value="<?php if ( isset ( $travel_stored_meta['feature-5-angling-image'] ) ) echo $travel_stored_meta['feature-5-angling-image'][0];?>" />
    <input type="button" id="feature-5-angling-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  </p>
  
  <p> <!-- ==== FISHING / TRAVEL TEXT/VIDEO ==== -->
    <label for="feature-5-video" class="travel-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'travel-textdomain' )?></label>
    <input type="url" name="feature-5-video" id="feature-5-video" value="<?php if ( isset ( $travel_stored_meta['feature-5-video'] ) ) echo $travel_stored_meta['feature-5-video'][0]; ?>" />
  </p>
  
  <p> <!-- ==== FISHING / TAVEL VIDEO/IMAGE OPTION ==== -->
    
    <span class="travel-row-title"><?php _e( '<strong>Image or Video?</strong>', 'travel-textdomain' )?></span>
    <div class="travel-row-content">
      <label for="feature-5-checkbox">
        <input type="checkbox" name="feature-5-checkbox" id="feature-5-checkbox" value="yes" <?php if ( isset ( $travel_stored_meta['feature-5-checkbox'] ) ) checked( $travel_stored_meta['feature-5-checkbox'][0], 'yes' ); ?> />
        <?php _e( 'Check box if you are importing video.', 'travel-textdomain' )?>
      </label>
      </label>
    </div>
  
  </p>
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  
  <!-- ===== SET THE HOOK ====== -->
  
  <div class="panel">
    <!-- Set The Hook Section -->
    
    <label for="sth-section" class="travel-row-title"><?php _e( '<h3>Set The Hook Section</h3>', 'travel-textdomain' );?></label>
    
    <div class="mt-1618 mb-1618"> <!-- ==== SET THE OPTION ==== -->
      
      <div class="setthehook-1-option">
        <label for="setthehook-1-option" style="padding-left: 1.618em;">
          <input type="checkbox" name="setthehook-option-checkbox" id="setthehook-option-checkbox" value="yes" <?php if ( isset ( $travel_stored_meta['setthehook-option-checkbox'] ) ) checked( $travel_stored_meta['setthehook-option-checkbox'][0], 'yes' ); ?> />
          <?php _e( 'Check box to activate this section.', 'travel-textdomain' )?>
        </label>
      </div>
    </div>
    
    <div class="set-the-hook-container">
      
      <div>
        
        <div class="travel-row-content">
          <label for="sth-textarea-1" class="sth-textarea-1"><?php _e( '<strong>Set The Hook Section</strong>', 'travel-textdomain' )?></label>
          
          <textarea style="width: 100%;" rows="10" name="sth-textarea-1" id="sth-textarea-1"><?php if ( isset ( $travel_stored_meta['sth-textarea-1'] ) ) echo $travel_stored_meta['sth-textarea-1'][0]; ?></textarea>
        </div>
      
      </div>
    </div>
  </div>
  
  <!-- ====== ADDITIONAL PHOTOS SECTION ====== -->
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <h3><?php echo 'Additional Images'?></h3>
  
  <p> <!-- Additional Image #1 -->
    
    <label for="additional-info-image1" class="travel-row-title"><?php _e( '<strong>Additional Image &#35;1</strong>', 'travel-textdomain' );?></label>
    
    <input type="text" name="additional-info-image1" id="additional-info-image1" value="<?php if ( isset ( $travel_stored_meta['additional-info-image1'] ) ) echo $travel_stored_meta['additional-info-image1'][0];?>" />
    <input type="button" id="additional-info-image1-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Image #2 -->
    
    <label for="additional-info-image2" class="travel-row-title"><?php _e( '<strong>Additional Image &#35;2</strong>', 'travel-textdomain' );?></label>
    
    <input type="text" name="additional-info-image2" id="additional-info-image2" value="<?php if ( isset ( $travel_stored_meta['additional-info-image2'] ) ) echo $travel_stored_meta['additional-info-image2'][0];?>" />
    <input type="button" id="additional-info-image2-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Image #3 -->
    
    <label for="additional-info-image3" class="travel-row-title"><?php _e( '<strong>Additional Image &#35;3</strong>', 'travel-textdomain' );?></label>
    
    <input type="text" name="additional-info-image3" id="additional-info-image3" value="<?php if ( isset ( $travel_stored_meta['additional-info-image3'] ) ) echo $travel_stored_meta['additional-info-image3'][0];?>" />
    <input type="button" id="additional-info-image3-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Image #4 -->
    
    <label for="additional-info-image4" class="travel-row-title"><?php _e( '<strong>Additional Image &#35;4</strong>', 'travel-textdomain' );?></label>
    
    <input type="text" name="additional-info-image4" id="additional-info-image4" value="<?php if ( isset ( $travel_stored_meta['additional-info-image4'] ) ) echo $travel_stored_meta['additional-info-image4'][0];?>" />
    <input type="button" id="additional-info-image4-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Image #5 -->
    
    <label for="additional-info-image5" class="travel-row-title"><?php _e( '<strong>Additional Image &#35;5</strong>', 'travel-textdomain' );?></label>
    
    <input type="text" name="additional-info-image5" id="additional-info-image5" value="<?php if ( isset ( $travel_stored_meta['additional-info-image5'] ) ) echo $travel_stored_meta['additional-info-image5'][0];?>" />
    <input type="button" id="additional-info-image5-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Image #6 -->
    
    <label for="additional-info-image6" class="travel-row-title"><?php _e( '<strong>Additional Image &#35;6</strong>', 'travel-textdomain' );?></label>
    
    <input type="text" name="additional-info-image6" id="additional-info-image6" value="<?php if ( isset ( $travel_stored_meta['additional-info-image6'] ) ) echo $travel_stored_meta['additional-info-image6'][0];?>" />
    <input type="button" id="additional-info-image6-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Image #7 -->
    
    <label for="additional-info-image7" class="travel-row-title"><?php _e( '<strong>Additional Image &#35;7</strong>', 'travel-textdomain' );?></label>
    
    <input type="text" name="additional-info-image7" id="additional-info-image7" value="<?php if ( isset ( $travel_stored_meta['additional-info-image7'] ) ) echo $travel_stored_meta['additional-info-image7'][0];?>" />
    <input type="button" id="additional-info-image7-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Image #8 -->
    
    <label for="additional-info-image8" class="travel-row-title"><?php _e( '<strong>Additional Image &#35;8</strong>', 'travel-textdomain' );?></label>
    
    <input type="text" name="additional-info-image8" id="additional-info-image8" value="<?php if ( isset ( $travel_stored_meta['additional-info-image8'] ) ) echo $travel_stored_meta['additional-info-image8'][0];?>" />
    <input type="button" id="additional-info-image8-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'travel-textdomain' );?>" />
  
  </p>

<?php }
