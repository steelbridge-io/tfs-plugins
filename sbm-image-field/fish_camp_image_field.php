<?php
/**
 * Adds a meta box to the post editing screen
*/
ob_implicit_flush(true);
include( plugin_dir_path( __FILE__ ) . 'inc/sanitize_fish_camp_image.php');

function fish_camp_custom_meta() { global $post;
	
	if(!empty($post)) {
		$pageTemplate = get_post_meta ($post -> ID, '_wp_page_template', true);
		$types = array('fishcamp_cpt');
		foreach ($types as $type) {
		if($pageTemplate == 'page-templates/fish-camp-template.php') {
			add_meta_box ( 'fish_camp_meta', __('Fish Camp Images', 'fish-camp-textdomain' ), 'fish_camp_meta_callback', $type, 'normal', 'high');
			}
		}
	}
}
add_action( 'add_meta_boxes', 'fish_camp_custom_meta' );
/**
 * Outputs the content of the meta box
 */
ob_start();
function fish_camp_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'fish_camp_nonce' );
    $fish_camp_stored_meta = get_post_meta( $post->ID );?>
		<p> <!-- ==== TFS LOGO ==== -->
    
    <label for="fish-camp-logo" class="fish-camp-row-title"><?php _e( '<h3>TFS Logo</h3>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="fish-camp-logo" id="fish-camp-logo" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-logo'] ) ) echo $fish_camp_stored_meta['fish-camp-logo'][0];?>" />
    <input type="button" id="fish-camp-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
		<p> <!-- ==== FISH CAMP HERO IMAGE ==== -->
    
    <label for="fish-camp-image" class="fish-camp-row-title"><?php _e( '<h3>Fish Camp Hero Image</h3>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="fish-camp-image" id="fish-camp-image" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-image'] ) ) echo $fish_camp_stored_meta['fish-camp-image'][0];?>" />
    <input type="button" id="fish-camp-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
		<hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
		
		<p> <!-- ==== FISH CAMP COSTS ==== -->
    
    <label for="feature-fc1-image" class="fish-camp-row-title"><?php _e( '<h3>Fish Camp Costs Imagery</h3>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="feature-fc1-image" id="feature-fc1-image" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc1-image'] ) ) echo $fish_camp_stored_meta['feature-fc1-image'][0];?>" />
    <input type="button" id="feature-fc1-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
		<p> <!-- ==== FISH CAMP COSTS WATERS TEXT/VIDEO ==== -->
		
		<label for="feature-fc1-video" class="fish-camp-row-title"><?php _e( '<strong>Paste implicit video URL here. You can also paste the embed Google Map URL here:</strong>', 'fish-camp-textdomain' )?></label>
		<input type="url" style="width:50%;" name="feature-fc1-video" id="feature-fc1-video" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc1-video'] ) ) echo $fish_camp_stored_meta['feature-fc1-video'][0]; ?>" />
		  
    </p>
    
    <p> <!-- ==== FISH CAMP VIDEO/IMAGE OPTION ==== -->

		<span class="fish-camp-row-title"><?php _e( '<strong>Image or Video?</strong>', 'fish-camp-textdomain' )?></span>
		<div class="fish-camp-row-content">
		<label for="feature-fc1-checkbox">
		<input type="checkbox" name="feature-fc1-checkbox" id="feature-fc1-checkbox" value="yes" <?php if ( isset ( $fish_camp_stored_meta['feature-fc1-checkbox'] ) ) checked( $fish_camp_stored_meta['feature-fc1-checkbox'][0], 'yes' ); ?> />
		<?php _e( 'Check box if you are importing video. Leave unchecked for image.', 'fish-camp-textdomain' )?>
		</label>
		</div>
		
		</p>
		<hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
		<p> <!-- ==== FISH CAMP DATES ==== -->
    
    <label for="feature-fc2-image" class="fish-camp-row-title"><?php _e( '<h3>Fish Camp Dates Imagery</h3>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="feature-fc2-image" id="feature-fc2-image" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc2-image'] ) ) echo $fish_camp_stored_meta['feature-fc2-image'][0];?>" />
    <input type="button" id="feature-fc2-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />

		</p>
		
		<p> <!-- ==== FISH CAMP DATES TEXT/VIDEO ==== -->
		
		<label for="feature-fc2-video" class="fish-camp-row-title"><?php _e( '<strong>Paste implicit video URL here. You can also paste the embed Google Map URL here:</strong>', 'fish-camp-textdomain' )?></label>
		<input type="url" style="width:50%;" name="feature-fc2-video" id="feature-fc2-video" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc2-video'] ) ) echo $fish_camp_stored_meta['feature-fc2-video'][0]; ?>" />
        
    </p>
	
		<p> <!-- ==== FISH CAMP DATES VIDEO/IMAGE OPTION ==== -->

		<span class="fish-camp-row-title"><?php _e( '<strong>Image or Video?</strong>', 'fish-camp-textdomain' )?></span>
		<div class="fish-camp-row-content">
		<label for="feature-fc2-checkbox">
		<input type="checkbox" name="feature-fc2-checkbox" id="feature-fc2-checkbox" value="yes" <?php if ( isset ( $fish_camp_stored_meta['feature-fc2-checkbox'] ) ) checked( $fish_camp_stored_meta['feature-fc2-checkbox'][0], 'yes' ); ?> />
		<?php _e( 'Check box if you are importing video.', 'fish-camp-textdomain' )?>
		</label>
		</label>
		</div>
		
		</p>
		
		<hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
		
		<p> <!-- ==== FISH CAMP LODGING IMAGE ==== -->
    
    <label for="feature-fc3-image" class="fish-camp-row-title"><?php _e( '<h3>Fish Camp Lodging Imagery</h3>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="feature-fc3-image" id="feature-fc3-image" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc3-image'] ) ) echo $fish_camp_stored_meta['feature-fc3-image'][0];?>" />
    <input type="button" id="feature-fc3-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />

		</p>
		
		<p> <!-- ==== FISH CAMP LODGING TO TEXT/VIDEO ==== -->
		
		<label for="feature-fc3-video" class="fish-camp-row-title"><?php _e( '<strong>Paste implicit video URL here. You can also paste the embed Google Map URL here:</strong>', 'fish-camp-textdomain' )?></label>
		<input type="url" style="width:50%;" name="feature-fc3-video" id="feature-fc3-video" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc3-video'] ) ) echo $fish_camp_stored_meta['feature-fc3-video'][0]; ?>" />
        
    </p>
    
		<p> <!-- ==== FISH CAMP LODGING VIDEO/IMAGE OPTION ==== -->

		<span class="fish-camp-row-title"><?php _e( '<strong>Image or Video?</strong>', 'fish-camp-textdomain' )?></span>
		<div class="fish-camp-row-content">
		<label for="feature-fc3-checkbox">
		<input type="checkbox" name="feature-fc3-checkbox" id="feature-fc3-checkbox" value="yes" <?php if ( isset ( $fish_camp_stored_meta['feature-fc3-checkbox'] ) ) checked( $fish_camp_stored_meta['feature-fc3-checkbox'][0], 'yes' ); ?> />
		<?php _e( 'Check box if you are importing video.', 'fish-camp-textdomain' )?>
		</label>
		</label>
		</div>
		
		</p>
		<hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
		<p> <!-- ==== FISH CAMP GETTING THERE ==== -->
    
    <label for="feature-fc4-image" class="fish-camp-row-title"><?php _e( '<h3>Fish Camp Getting There Imagery</h3>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="feature-fc4-image" id="feature-fc4-image" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc4-image'] ) ) echo $fish_camp_stored_meta['feature-fc4-image'][0];?>" />
    <input type="button" id="feature-fc4-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />

		</p>
		
		<p> <!-- ==== FISH CAMP GETTING THERE TEXT/VIDEO ==== -->
		
		<label for="feature-fc4-video" class="fish-camp-row-title"><?php _e( '<strong>Paste implicit video URL here. You can also paste the embed Google Map URL here:</strong>', 'fish-camp-textdomain' )?></label>
		<input type="url" style="width:50%;" name="feature-fc4-video" id="feature-fc4-video" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc4-video'] ) ) echo $fish_camp_stored_meta['feature-fc4-video'][0]; ?>" />
        
    </p>
    
		<p> <!-- ==== FISH CAMP GETTING THERE VIDEO/IMAGE OPTION ==== -->

		<span class="fish-camp-row-title"><?php _e( '<strong>Image or Video?</strong>', 'fish-camp-textdomain' )?></span>
		<div class="fish-camp-row-content">
		<label for="feature-fc4-checkbox">
		<input type="checkbox" name="feature-fc4-checkbox" id="feature-fc4-checkbox" value="yes" <?php if ( isset ( $fish_camp_stored_meta['feature-fc4-checkbox'] ) ) checked( $fish_camp_stored_meta['feature-fc4-checkbox'][0], 'yes' ); ?> />
		<?php _e( 'Check box if you are importing video.', 'fish-camp-textdomain' )?>
		</label>
		</label>
		</div>
		
		</p>
		
		<hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
		<p> <!-- ==== FISH CAMP ITINERARY IMAGE ==== -->
    
    <label for="feature-fc5-image" class="fish-camp-row-title"><?php _e( '<h3>Fish Camp Itinerary Imagery</h3>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="feature-fc5-image" id="feature-fc5-image" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc5-image'] ) ) echo $fish_camp_stored_meta['feature-fc5-image'][0];?>" />
    <input type="button" id="feature-fc5-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />

		</p>
		
		<p> <!-- ==== FISH CAMP ITINERARY TEXT/VIDEO ==== -->
		
		<label for="feature-fc5-video" class="fish-camp-row-title"><?php _e( '<strong>Paste implicit video URL here. You can also paste the embed Google Map URL here:</strong>', 'fish-camp-textdomain' )?></label>
		<input type="url" style="width:50%;" name="feature-fc5-video" id="feature-fc5-video" value="<?php if ( isset ( $fish_camp_stored_meta['feature-fc5-video'] ) ) echo $fish_camp_stored_meta['feature-fc5-video'][0]; ?>" />
        
    </p>
    
		<p> <!-- ==== FISH CAMP ITINERARY VIDEO/IMAGE OPTION ==== -->

		<span class="fish-camp-row-title"><?php _e( '<strong>Image or Video?</strong>', 'fish-camp-textdomain' )?></span>
		<div class="fish-camp-row-content">
		<label for="feature-fc5-checkbox">
		<input type="checkbox" name="feature-fc5-checkbox" id="feature-fc5-checkbox" value="yes" <?php if ( isset ( $fish_camp_stored_meta['feature-fc5-checkbox'] ) ) checked( $fish_camp_stored_meta['feature-fc5-checkbox'][0], 'yes' ); ?> />
		<?php _e( 'Check box if you are importing video.', 'fish-camp-textdomain' )?>
		</label>
		</label>
		</div>
		
		</p>
		
				<!-- ====== ADDITIONAL INFORMATION SECTION ====== -->
    <hr style="margin-top: 1.618em; border-top: 3px double #8c8b8b;">
    <h3><?php echo 'Additional Info Section Images'?></h3>
    
    <p> <!-- Additional Information Image #1 -->
    
    <label for="fish-camp-additional-info-image1" class="travel-row-title"><?php _e( '<strong>Additional Information Image &#35;1</strong>', 'fish-camp-textdomain' );?></label>
    
    <input type="text" style="width:50%;" name="fish-camp-additional-info-image1" id="fish-camp-additional-info-image1" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-additional-info-image1'] ) ) echo $fish_camp_stored_meta['fish-camp-additional-info-image1'][0];?>" />
    <input type="button" id="fish-camp-additional-info-image1-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
		<p> <!-- Additional Information Image #2 -->
    
    <label for="fish-camp-additional-info-image2" class="travel-row-title"><?php _e( '<strong>Additional Information Image &#35;2</strong>', 'fish-camp-textdomain' );?></label>
    
    <input type="text" style="width:50%;" name="fish-camp-additional-info-image2" id="fish-camp-additional-info-image2" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-additional-info-image2'] ) ) echo $fish_camp_stored_meta['fish-camp-additional-info-image2'][0];?>" />
    <input type="button" id="fish-camp-additional-info-image2-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
		<p> <!-- Additional Information Image #3 -->
    
    <label for="fish-camp-additional-info-image3" class="travel-row-title"><?php _e( '<strong>Additional Information Image &#35;3</strong>', 'fish-camp-textdomain' );?></label>
    
    <input type="text" style="width:50%;" name="fish-camp-additional-info-image3" id="fish-camp-additional-info-image3" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-additional-info-image3'] ) ) echo $fish_camp_stored_meta['fish-camp-additional-info-image3'][0];?>" />
    <input type="button" id="fish-camp-additional-info-image3-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
    <p> <!-- Additional Information Image #4 -->
    
    <label for="fish-camp-additional-info-image4" class="travel-row-title"><?php _e( '<strong>Additional Information Image &#35;4</strong>', 'fish-camp-textdomain' );?></label>
    
    <input type="text" style="width:50%;" name="fish-camp-additional-info-image4" id="fish-camp-additional-info-image4" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-additional-info-image4'] ) ) echo $fish_camp_stored_meta['fish-camp-additional-info-image4'][0];?>" />
    <input type="button" id="fish-camp-additional-info-image4-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
    <p> <!-- Additional Information Image #5 -->
    
    <label for="fish-camp-additional-info-image5" class="travel-row-title"><?php _e( '<strong>Additional Information Image &#35;5</strong>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="fish-camp-additional-info-image5" id="fish-camp-additional-info-image5" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-additional-info-image5'] ) ) echo $fish_camp_stored_meta['fish-camp-additional-info-image5'][0];?>" />
    <input type="button" id="fish-camp-additional-info-image5-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
    
    <p> <!-- Additional Information Image #6 -->
    
    <label for="fish-camp-additional-info-image6" class="travel-row-title"><?php _e( '<strong>Additional Information Image &#35;6</strong>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="fish-camp-additional-info-image6" id="fish-camp-additional-info-image6" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-additional-info-image6'] ) ) echo $fish_camp_stored_meta['fish-camp-additional-info-image6'][0];?>" />
    <input type="button" id="fish-camp-additional-info-image6-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
    <p> <!-- Additional Information Image #7 -->
    
    <label for="fish-camp-additional-info-image7" class="travel-row-title"><?php _e( '<strong>Additional Information Image &#35;7</strong>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="fish-camp-additional-info-image7" id="fish-camp-additional-info-image7" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-additional-info-image7'] ) ) echo $fish_camp_stored_meta['fish-camp-additional-info-image7'][0];?>" />
    <input type="button" id="fish-camp-additional-info-image7-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>
		
    <p> <!-- Additional Information Image #8 -->
    
    <label for="fish-camp-additional-info-image8" class="travel-row-title"><?php _e( '<strong>Additional Information Image &#35;8</strong>', 'fish-camp-textdomain' );?></label>
    <input type="text" style="width:50%;" name="fish-camp-additional-info-image8" id="fish-camp-additional-info-image8" value="<?php if ( isset ( $fish_camp_stored_meta['fish-camp-additional-info-image8'] ) ) echo $fish_camp_stored_meta['fish-camp-additional-info-image8'][0];?>" />
    <input type="button" id="fish-camp-additional-info-image8-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'fish-camp-textdomain' );?>" />
    
		</p>

   <?php }
/* ==== Loads the image management javascript using wp enqueue media ==== */
 function fish_camp_image_enqueue() {
    global $typenow;
    if( $typenow == 'post' or 'page' or 'fish_camp_posts' ) {
        wp_enqueue_media();
 
        // Registers and enqueues the required javascript for image management within wp dashboard/stream report.
        wp_register_script( 'meta-box-image', plugin_dir_url( __FILE__ ) . 'meta-box-image.js', array( 'jquery' ) );
        wp_localize_script( 'meta-box-image', 'meta_image', 
            array(
                'title' => __( 'Choose or Upload an Image', 'fish-camp-textdomain' ),
                'button' => __( 'Use this image', 'fish-camp-textdomain' ),
            )
        );
        wp_enqueue_script( 'meta-box-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'fish_camp_image_enqueue' );
