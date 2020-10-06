<?php
/*
 * Guide Service Meat
 */
ob_implicit_flush(true);
include( plugin_dir_path( __FILE__ ) . '../inc/sanitize_guide_service_image.php');

/**
 * Adds a meta box to the post editing screen
 */

function guideservice_custom_meta() { global $post;
  
  if(!empty($post)) {
    $pageTemplate = get_post_meta ($post -> ID, '_wp_page_template', true);
    $types = array('guide_service');
    foreach ($types as $type) {
      if($pageTemplate == 'page-templates/guide-service-template.php') {
        add_meta_box ( 'guideservice_meta', __('Guide Service Images', 'guideservice-textdomain' ), 'guideservice_meta_callback', $type, 'normal', 'high');
      }
    }
  }
}
add_action( 'add_meta_boxes', 'guideservice_custom_meta' );

/**
 * Adds Custom Field Image Meta Box
 */
ob_start();
function guideservice_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'guideservice_nonce' );
  $guideservice_stored_meta = get_post_meta( $post->ID );?>
  
  <p> <!-- ==== TFS LOGO ==== -->
    
    <label for="guideservice-logo" class="guideservice-row-title"><?php _e( '<h3>TFS Logo</h3>', 'guideservice-textdomain' );?></label>
    <input type="text" name="guideservice-logo" id="guideservice-logo" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-logo'] ) ) echo $guideservice_stored_meta['guideservice-logo'][0];?>" />
    <input type="button" id="guideservice-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== GUIDE HERO IMAGE ==== -->
    
    <label for="guideservice-image" class="guideservice-row-title"><?php _e( '<h3>Guide Service Hero Image</h3>', 'guideservice-textdomain' );?></label>
    <input type="text" name="guideservice-image" id="guideservice-image" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-image'] ) ) echo $guideservice_stored_meta['guideservice-image'][0];?>" />
    <input type="button" id="guideservice-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  
  <p> <!-- ==== RESERVATIONS-RATES / GUIDE SERVICE / THE FISHING IMAGE ==== -->
    
    <label for="guideservice-gs1-image" class="guideservice-row-title"><?php _e( '<h3>Reservations &amp; Rates - Guide Service</h3>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-gs1-image" id="guideservice-gs1-image" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-gs1-image'] ) ) echo $guideservice_stored_meta['guideservice-gs1-image'][0];?>" />
    <input type="button" id="guideservice-gs1-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== RESERVATIONS-RATES / GUIDE SERVICE / THE FISHING VIDEO ==== -->
    
    <label for="guideservice-gs1-video" class="guideservice-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'guideservice-textdomain' )?></label>
    <input type="url" name="guideservice-gs1-video" id="guideservice-gs1-video" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-gs1-video'] ) ) echo $guideservice_stored_meta['guideservice-gs1-video'][0]; ?>" />
    
  </p>
  
  <!-- ==== RESERVATIONS-RATES / GUIDE SERVICE VIDEO/IMAGE OPTION ==== -->
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  
  <p> <!-- ==== SEASONS / GUIDE SERVICE IMAGE ==== -->
    
    <label for="feature-gs2-image" class="guideservice-row-title"><?php _e( '<h3>Seasons Imagery</h3>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="feature-gs2-image" id="feature-gs2-image" value="<?php if ( isset ( $guideservice_stored_meta['feature-gs2-image'] ) ) echo $guideservice_stored_meta['feature-gs2-image'][0];?>" />
    <input type="button" id="feature-gs2-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== SEASONS / GUIDE SERVICE TEXT/VIDEO ==== -->
    
    <label for="feature-gs2-video" class="guideservice-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'guideservice-textdomain' )?></label>
    <input type="url" name="feature-gs2-video" id="feature-gs2-video" value="<?php if ( isset ( $guideservice_stored_meta['feature-gs2-video'] ) ) echo $guideservice_stored_meta['feature-gs2-video'][0]; ?>" />
  </p>
 
   <!-- ==== SEASONS / GUIDE SERVICE VIDEO/IMAGE OPTION ==== -->
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  
  <p> <!-- ==== FISHING / GETTING TO IMAGE ==== -->
    
    <label for="feature-gs3-image" class="guideservice-row-title"><?php _e( '<h3>Fishing Imagery</h3>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="feature-gs3-image" id="feature-gs3-image" value="<?php if ( isset ( $guideservice_stored_meta['feature-gs3-image'] ) ) echo $guideservice_stored_meta['feature-gs3-image'][0];?>" />
    <input type="button" id="feature-gs3-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== FISHING / GETTING TO TEXT/VIDEO ==== -->
    
    <label for="feature-gs3-video" class="guideservice-row-title"><?php _e( '<strong>Paste implicit video URL here. You can also paste the embed Google Map URL here. No shortened versions:</strong>', 'guideservice-textdomain' )?></label>
    <input type="url" name="feature-gs3-video" id="feature-gs3-video" value="<?php if ( isset ( $guideservice_stored_meta['feature-gs3-video'] ) ) echo $guideservice_stored_meta['feature-gs3-video'][0]; ?>" />
    
  </p>
  
   <!-- ==== FISHING / GETTING TO VIDEO/IMAGE OPTION ==== -->
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  
  <p> <!-- ==== LODGING / LODGING IMAGE ==== -->
    
    <label for="feature-gs4-image" class="guideservice-row-title"><?php _e( '<h3>Lodging Imagery</h3>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="feature-gs4-image" id="feature-gs4-image" value="<?php if ( isset ( $guideservice_stored_meta['feature-gs4-image'] ) ) echo $guideservice_stored_meta['feature-gs4-image'][0];?>" />
    <input type="button" id="feature-gs4-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== LODGING / LODGING TEXT/VIDEO ==== -->
    
    <label for="feature-gs4-video" class="guideservice-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'guideservice-textdomain' )?></label>
    <input type="url" name="feature-gs4-video" id="feature-gs4-video" value="<?php if ( isset ( $guideservice_stored_meta['feature-gs4-video'] ) ) echo $guideservice_stored_meta['feature-gs4-video'][0]; ?>" />
    
  </p>
  
  <!-- ==== LODGING / LODGING VIDEO/IMAGE OPTION ==== -->
  
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <p> <!-- ==== GETTING THERE / FISHING IMAGE ==== -->
    
    <label for="feature-gs5-image" class="guideservice-row-title"><?php _e( '<h3>Getting There Imagery</h3>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="feature-gs5-image" id="feature-gs5-image" value="<?php if ( isset ( $guideservice_stored_meta['feature-gs5-image'] ) ) echo $guideservice_stored_meta['feature-gs5-image'][0];?>" />
    <input type="button" id="feature-gs5-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- ==== GETTING THERE / FISHING TEXT/VIDEO ==== -->
    
    <label for="feature-gs5-video" class="guideservice-row-title"><?php _e( '<strong>Paste implicit video URL here. No shortened versions:</strong>', 'guideservice-textdomain' )?></label>
    <input type="url" name="feature-gs5-video" id="feature-gs5-video" value="<?php if ( isset ( $guideservice_stored_meta['feature-gs5-video'] ) ) echo $guideservice_stored_meta['feature-gs5-video'][0]; ?>" />
    
  </p>
  
  <!-- ==== GETTING THERE / FISHING VIDEO/IMAGE OPTION ==== -->
  
  <!-- ====== ADDITIONAL INFORMATION SECTION ====== -->
  <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
  <h3><?php echo 'Additional Photos'?></h3>
  
  <p> <!-- Additional Photo #1 -->
    
    <label for="guideservice-additional-info-image1" class="travel-row-title"><?php _e( '<strong>Additional Photo &#35;1</strong>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-additional-info-image1" id="guideservice-additional-info-image1" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-additional-info-image1'] ) ) echo $guideservice_stored_meta['guideservice-additional-info-image1'][0];?>" />
    <input type="button" id="guideservice-additional-info-image1-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Photo #2 -->
    
    <label for="guideservice-additional-info-image2" class="travel-row-title"><?php _e( '<strong>Additional Photo &#35;2</strong>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-additional-info-image2" id="guideservice-additional-info-image2" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-additional-info-image2'] ) ) echo $guideservice_stored_meta['guideservice-additional-info-image2'][0];?>" />
    <input type="button" id="guideservice-additional-info-image2-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Photo #3 -->
    
    <label for="guideservice-additional-info-image3" class="travel-row-title"><?php _e( '<strong>Additional Photo &#35;3</strong>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-additional-info-image3" id="guideservice-additional-info-image3" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-additional-info-image3'] ) ) echo $guideservice_stored_meta['guideservice-additional-info-image3'][0];?>" />
    <input type="button" id="guideservice-additional-info-image3-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Photo #4 -->
    
    <label for="guideservice-additional-info-image4" class="travel-row-title"><?php _e( '<strong>Additional Photo &#35;4</strong>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-additional-info-image4" id="guideservice-additional-info-image4" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-additional-info-image4'] ) ) echo $guideservice_stored_meta['guideservice-additional-info-image4'][0];?>" />
    <input type="button" id="guideservice-additional-info-image4-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Photo #5 -->
    
    <label for="guideservice-additional-info-image5" class="travel-row-title"><?php _e( '<strong>Additional Photo &#35;5</strong>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-additional-info-image5" id="guideservice-additional-info-image5" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-additional-info-image5'] ) ) echo $guideservice_stored_meta['guideservice-additional-info-image5'][0];?>" />
    <input type="button" id="guideservice-additional-info-image5-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Photo #6 -->
    
    <label for="guideservice-additional-info-image6" class="travel-row-title"><?php _e( '<strong>Additional Photo &#35;6</strong>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-additional-info-image6" id="guideservice-additional-info-image6" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-additional-info-image6'] ) ) echo $guideservice_stored_meta['guideservice-additional-info-image6'][0];?>" />
    <input type="button" id="guideservice-additional-info-image6-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Photo #7 -->
    
    <label for="guideservice-additional-info-image7" class="travel-row-title"><?php _e( '<strong>Additional Photo &#35;7</strong>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-additional-info-image7" id="guideservice-additional-info-image7" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-additional-info-image7'] ) ) echo $guideservice_stored_meta['guideservice-additional-info-image7'][0];?>" />
    <input type="button" id="guideservice-additional-info-image7-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>
  
  <p> <!-- Additional Photo #8 -->
    
    <label for="guideservice-additional-info-image8" class="travel-row-title"><?php _e( '<strong>Additional Photo &#35;8</strong>', 'guideservice-textdomain' );?></label><br>
    <input type="text" name="guideservice-additional-info-image8" id="guideservice-additional-info-image8" value="<?php if ( isset ( $guideservice_stored_meta['guideservice-additional-info-image8'] ) ) echo $guideservice_stored_meta['guideservice-additional-info-image8'][0];?>" />
    <input type="button" id="guideservice-additional-info-image8-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'guideservice-textdomain' );?>" />
  
  </p>

<?php }
