<?php
/**
 * Adds a meta-box to the post-editing screen
 */
//ob_implicit_flush(true);
include( plugin_dir_path( __FILE__ ) . 'sanitize/landingPage-options.php');

function register_landing_page_meta_box() {
	global $post;
	if (!empty($post)) {
		$pageTemplate = get_post_meta ($post -> ID, '_wp_page_template', true);
		$types = array('page', 'post');
		
		if ($pageTemplate == 'page-templates/landing-page.php') {
			foreach ($types as $type) {
				add_meta_box ( 'landing_page_meta', __('Landing Page Template Options', 'landing-page-textdomain' ), 'landing_page_meta_callback', $type, 'normal', 'high');
			}
		}
	}
}
add_action('add_meta_boxes', 'register_landing_page_meta_box');
/**
 * Outputs the content of the meta-box
 */
//ob_start();
function landing_page_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'landing_page_nonce' );
	$landing_page_stored_meta = get_post_meta( $post->ID );?>
	<div> <!-- ==== TFS LOGO ==== -->
		
		<label for="landing-page-logo" class="landing-page-row-title"><?php _e( '<h3>TFS Logo</h3>', 'landing-page-textdomain' );?></label>
		<input type="text" style="width:50%;" name="landing-page-logo" id="landing-page-logo" value="<?php if ( isset ( $landing_page_stored_meta['landing-page-logo'] ) ) echo $landing_page_stored_meta['landing-page-logo'][0];?>" />
		<input type="button" id="landing-page-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'landing-page-textdomain' );?>" />
	
	</div>
	
	<div> <!-- ==== FISH CAMP HERO IMAGE ==== -->
		
		<label for="landing-page-image" class="landing-page-row-title"><?php _e( '<h3>Hero Image</h3>', 'landing-page-textdomain' );?></label>
		<input type="text" style="width:50%;" name="landing-page-image" id="landing-page-image" value="<?php if ( isset ( $landing_page_stored_meta['landing-page-image'] ) ) echo $landing_page_stored_meta['landing-page-image'][0];?>" />
		<input type="button" id="landing-page-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'landing-page-textdomain' );?>" />
	
	</div>

    <div>
        <label for="landing-page-desc" class="blog-row-desc"><?php _e('<h3>Header Description</h3>','tfs-blog-textdomain')?></label>
        <input style="width: 100%;" type="text" name="landing-page-desc" id="landing-page-desc" value="<?php if (isset($landing_page_stored_meta['landing-page-desc'])) echo $landing_page_stored_meta['landing-page-desc'][0]; ?>" />
    </div>

<?php }
