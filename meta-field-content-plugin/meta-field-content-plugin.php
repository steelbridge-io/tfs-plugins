<?php
/*
Plugin Name: Meta Field Content Plugin
Plugin URI: https://steelbridge.io
Description: A plugin for The Fly Shop that contains all the custom meta
field code.
Version: 1.0
Requires at least: 6.5.2
Requires PHP: 8.0
Author: Chris Parsons
Author URI: https://steelbridge.io
License: GPLv2
Text Domain: meta-field-content-plugin
*/

include_once 'includes/load-scripts-styles.php';
include_once 'includes/shortcode.php';
function get_custom_fields($post_id) {
	$meta_elements = [
            'title1', 'subtitle1', 'link1', 'description1', 'image1',
            'title2', 'subtitle2', 'link2', 'description2', 'image2',
            'title3', 'subtitle3', 'link3', 'description3', 'image3',
            'title4', 'subtitle4', 'link4', 'description4', 'image4',
            'title5', 'subtitle5', 'link5', 'description5', 'image5',
            'title6', 'subtitle6', 'link6', 'description6', 'image6',
            'title7', 'subtitle7', 'link7', 'description7', 'image7',
            'title8', 'subtitle8', 'link8', 'description8', 'image8',
    ];
	$post_meta_data = [];

	foreach ($meta_elements as $meta) {
		$post_meta_data[$meta] = get_post_meta($post_id, $meta, true);
	}
	return $post_meta_data;
}
add_action('admin_menu', 'meta_field_content_menu');

function meta_field_content_menu() {
	add_menu_page('Meta Field Content Settings', 'Meta Fields', 'manage_options', 'meta-field-content-setting', 'meta_content_settings_page');
}

function meta_content_settings_page() { ?>
    <div class="wrap">
        <h2>Publications - Meta Field Content</h2>
        <form method="post" action="options.php" id="editor-publication-form-grid">
        <!-- Row #1 -->
        <div class="form-row">
            
            <label class="form-label" for="title1">Title 1</label>
            <input name="title1" type="text" id="title1" class="regular-text form-input" value="<?php echo esc_attr( get_option('title1') ); ?>">
            
            <label class="form-label" for="subtitle1">Sub Title 1</label>
            <input name="subtitle1" type="text" id="subtitle1" class="regular-text form-input" value="<?php echo esc_attr( get_option('subtitle1') ); ?>">
        
            <label class="form-label" for="link1">Link 1</label>
            <input name="link1" type="text" id="link1" class="regular-text form-input" value="<?php echo esc_attr( get_option('link1') ); ?>">
       
            <label class="form-label" for="description1">Description 1</label>
            <textarea name="description1" id="description1" rows="10" class="regular-text form-input"><?php echo esc_textarea( get_option('description1') ); ?></textarea>
       
            <label class="form-label" for="image_url">Image 1</label>
            <input id="image_url1" name="image1" type="text" class="regular-text form-input" value="<?php echo esc_url( get_option('image1') ); ?>">
            <input id="upload_image_button1" type="button" class="button form-input" value="Upload Image" />
            
        </div>
            <!-- Row #2 -->
        <div class="form-row">
            
            <label class="form-label" for="title2">Title 2</label>
            <input name="title2" type="text" id="title2" class="regular-text form-input" value="<?php echo esc_attr( get_option('title2') ); ?>">
            
            <label class="form-label" for="subtitle2">Sub Title 2</label>
            <input name="subtitle2" type="text" id="subtitle2" class="regular-text form-input" value="<?php echo esc_attr( get_option('subtitle2') ); ?>">
            
            <label class="form-label" for="link2">Link 2</label>
            <input name="link2" type="text" id="link2" class="regular-text form-input" value="<?php echo esc_attr( get_option('link2') ); ?>">
        
            <label class="form-label" for="description2">Description 2</label>
            <textarea name="description2" id="description2" rows="10" class="regular-text form-input"><?php echo esc_textarea( get_option('description2') ); ?></textarea>
           
            <label class="form-label" for="image_url">Image 2</label>
            <input id="image_url2" name="image2" type="text" class="regular-text form-input" value="<?php echo esc_url( get_option('image2') ); ?>">
            <input id="upload_image_button2" type="button" class="button form-input" value="Upload Image" />
            
        </div>
        <!-- Row #3 -->
        <div class="form-row">

            <label class="form-label" for="title3">Title 3</label>
            <input name="title3" type="text" id="title3" class="regular-text form-input" value="<?php echo esc_attr( get_option('title3') ); ?>">
            
            <label class="form-label" for="subtitle3">Sub Title 3</label>
            <input name="subtitle3" type="text" id="subtitle3" class="regular-text form-input" value="<?php echo esc_attr( get_option('subtitle3') ); ?>">
            
            <label class="form-label" for="link3">Link 3</label>
            <input name="link3" type="text" id="link3" class="regular-text form-input" value="<?php echo esc_attr( get_option('link3') ); ?>">
            
            <label class="form-label" for="description3">Description 3</label>
            <textarea name="description3" id="description3" rows="10" class="regular-text form-input"><?php echo esc_textarea( get_option('description3') ); ?></textarea>
            
            <label class="form-label" for="image_url">Image 3</label>
            <input id="image_url3" name="image3" type="text" class="regular-text form-input" value="<?php echo esc_url( get_option('image3') ); ?>">
            <input id="upload_image_button3" type="button" class="button form-input" value="Upload Image" />
            
        </div>
        <!-- Row #4 -->
        <div class="form-row">
            <label class="form-label" for="title4">Title 4</label>
            <input name="title4" type="text" id="title4" class="regular-text form-input" value="<?php echo esc_attr( get_option('title4') ); ?>">
            
            <label class="form-label" for="subtitle4">Sub Title 4</label>
            <input name="subtitle4" type="text" id="subtitle4" class="regular-text form-input" value="<?php echo esc_attr( get_option('subtitle4') ); ?>">
            
            <label class="form-label" for="link4">Link 4</label>
            <input name="link4" type="text" id="link4" class="regular-text form-input" value="<?php echo esc_attr( get_option('link4') ); ?>">
            
            <label class="form-label" for="description4">Description 4</label>
            <textarea name="description4" id="description4" rows="10" class="regular-text form-input"><?php echo esc_textarea( get_option('description4') ); ?></textarea>
            
            <label class="form-label" for="image_url">Image 4</label>
            <input id="image_url4" name="image4" type="text" class="regular-text form-input" value="<?php echo esc_url( get_option('image4') ); ?>">
            <input id="upload_image_button4" type="button" class="button form-input" value="Upload Image" />
            
        </div>
        <!-- Row #5 -->
        <div class="form-row">
            
            <label class="form-label" for="title5">Title 5</label>
            <input name="title5" type="text" id="title5" class="regular-text form-input" value="<?php echo esc_attr( get_option('title5') ); ?>">
            
            <label class="form-label" for="subtitle5">Sub Title 5</label>
            <input name="subtitle5" type="text" id="subtitle5" class="regular-text form-input" value="<?php echo esc_attr( get_option('subtitle5') ); ?>">
            
            <label class="form-label" for="link5">Link 5</label>
            <input name="link5" type="text" id="link5" class="regular-text form-input" value="<?php echo esc_attr( get_option('link5') ); ?>">
            
            <label class="form-label" for="description5">Description 5</label>
            <textarea name="description5" id="description5" rows="10" class="regular-text form-input"><?php echo esc_textarea( get_option('description5') ); ?></textarea>
            
            <label class="form-label" for="image_url">Image 5</label>
            <input id="image_url5" name="image5" type="text" class="regular-text form-input" value="<?php echo esc_url( get_option('image5') ); ?>">
            <input id="upload_image_button5" type="button" class="button form-input" value="Upload Image" />
            
        </div>
        <!-- Row #6 -->
        <div class="form-row">
            
            <label class="form-label" for="title6">Title 6</label>
            <input name="title6" type="text" id="title6" class="regular-text form-input" value="<?php echo esc_attr( get_option('title6') ); ?>">
            
            <label class="form-label" for="subtitle6">Sub Title 6</label>
            <input name="subtitle6" type="text" id="subtitle6" class="regular-text form-input" value="<?php echo esc_attr( get_option('subtitle6') ); ?>">
            
            <label class="form-label" for="link6">Link 6</label>
            <input name="link6" type="text" id="link6" class="regular-text form-input" value="<?php echo esc_attr( get_option('link6') ); ?>">
            
            <label class="form-label" for="description6">Description 6</label>
            <textarea name="description6" id="description6" rows="10" class="regular-text form-input"><?php echo esc_textarea( get_option('description6') ); ?></textarea>
            
            <label class="form-label" for="image_url">Image 6</label>
            <input id="image_url6" name="image6" type="text" class="regular-text form-input" value="<?php echo esc_url( get_option('image6') ); ?>">
            <input id="upload_image_button6" type="button" class="button form-input" value="Upload Image" />
            
        </div>
        <!-- Row #7 -->
        <div class="form-row">
            
            <label class="form-label" for="title7">Title 7</label>
            <input name="title7" type="text" id="title7" class="regular-text form-input" value="<?php echo esc_attr( get_option('title7') ); ?>">
            
            <label class="form-label" for="subtitle7">Sub Title 7</label>
            <input name="subtitle7" type="text" id="subtitle7" class="regular-text form-input" value="<?php echo esc_attr( get_option('subtitle7') ); ?>">
            
            <label class="form-label" for="link7">Link 7</label>
            <input name="link7" type="text" id="link7" class="regular-text form-input" value="<?php echo esc_attr( get_option('link7') ); ?>">
            
            <label class="form-label" for="description7">Description 7</label>
            <textarea name="description7" id="description7" rows="10" class="regular-text form-input"><?php echo esc_textarea( get_option('description7') ); ?></textarea>
            
            <label class="form-label" for="image_url">Image 7</label>
            <input id="image_url7" name="image7" type="text" class="regular-text form-input" value="<?php echo esc_url( get_option('image7') ); ?>">
            <input id="upload_image_button7" type="button" class="button form-input" value="Upload Image" />
            
        </div>
        <!-- Row #8 -->
        <div class="form-row">
            
            <label class="form-label" for="title8">Title 8</label>
            <input name="title8" type="text" id="title8" class="regular-text form-input" value="<?php echo esc_attr( get_option('title8') ); ?>">
            
            <label class="form-label" for="subtitle8">Sub Title 8</label>
            <input name="subtitle8" type="text" id="subtitle8" class="regular-text form-input" value="<?php echo esc_attr( get_option('subtitle8') ); ?>">
            
            <label class="form-label" for="link8">Link 8</label>
            <input name="link8" type="text" id="link8" class="regular-text form-input" value="<?php echo esc_attr( get_option('link8') ); ?>">
            
            <label class="form-label" for="description8">Description 8</label>
            <textarea name="description8" id="description8" rows="10" class="regular-text form-input"><?php echo esc_textarea( get_option('description8') ); ?></textarea>
            
            <label class="form-label" for="image_url">Image 8</label>
            <input id="image_url8" name="image8" type="text" class="regular-text form-input" value="<?php echo esc_url( get_option('image8') ); ?>">
            <input id="upload_image_button8" type="button" class="button form-input" value="Upload Image" />
            
        </div>

        <?php
        settings_fields( 'meta_field_content_settings' );
        do_settings_sections( 'meta_field_content_settings' );
        submit_button();
        ?>
        
        </form>
    </div>
<?php }

function load_wp_media_files() {
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

function meta_field_content_register_settings() {
	register_setting( 'meta_field_content_settings', 'title1' );
	register_setting( 'meta_field_content_settings', 'subtitle1' );
	register_setting( 'meta_field_content_settings', 'link1' );
	register_setting( 'meta_field_content_settings', 'description1' );
	register_setting( 'meta_field_content_settings', 'image1' );
	
	register_setting( 'meta_field_content_settings', 'title2' );
	register_setting( 'meta_field_content_settings', 'subtitle2' );
	register_setting( 'meta_field_content_settings', 'link2' );
	register_setting( 'meta_field_content_settings', 'description2' );
	register_setting( 'meta_field_content_settings', 'image2' );
	
	register_setting( 'meta_field_content_settings', 'title3' );
	register_setting( 'meta_field_content_settings', 'subtitle3' );
	register_setting( 'meta_field_content_settings', 'link3' );
	register_setting( 'meta_field_content_settings', 'description3' );
	register_setting( 'meta_field_content_settings', 'image3' );
	
	register_setting( 'meta_field_content_settings', 'title4' );
	register_setting( 'meta_field_content_settings', 'subtitle4' );
	register_setting( 'meta_field_content_settings', 'link4' );
	register_setting( 'meta_field_content_settings', 'description4' );
	register_setting( 'meta_field_content_settings', 'image4' );
	
	register_setting( 'meta_field_content_settings', 'title5' );
	register_setting( 'meta_field_content_settings', 'subtitle5' );
	register_setting( 'meta_field_content_settings', 'link5' );
	register_setting( 'meta_field_content_settings', 'description5' );
	register_setting( 'meta_field_content_settings', 'image5' );
	
	register_setting( 'meta_field_content_settings', 'title6' );
	register_setting( 'meta_field_content_settings', 'subtitle6' );
	register_setting( 'meta_field_content_settings', 'link6' );
	register_setting( 'meta_field_content_settings', 'description6' );
	register_setting( 'meta_field_content_settings', 'image6' );
	
	register_setting( 'meta_field_content_settings', 'title7' );
	register_setting( 'meta_field_content_settings', 'subtitle7' );
	register_setting( 'meta_field_content_settings', 'link7' );
	register_setting( 'meta_field_content_settings', 'description7' );
	register_setting( 'meta_field_content_settings', 'image7' );
	
	register_setting( 'meta_field_content_settings', 'title8' );
	register_setting( 'meta_field_content_settings', 'subtitle8' );
	register_setting( 'meta_field_content_settings', 'link8' );
	register_setting( 'meta_field_content_settings', 'description8' );
	register_setting( 'meta_field_content_settings', 'image8' );
}
add_action( 'admin_init', 'meta_field_content_register_settings' );

function meta_field_content_sanitize() {
	register_setting( 'meta_field_content_settings', 'title1', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'subtitle1', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link1', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description1', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image1', 'esc_url_raw' );
	
	register_setting( 'meta_field_content_settings', 'title2', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'subtitle2', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link2', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description2', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image2', 'esc_url_raw' );
	
	register_setting( 'meta_field_content_settings', 'title3', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'subtitle3', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link3', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description3', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image3', 'esc_url_raw' );
	
	register_setting( 'meta_field_content_settings', 'title4', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'subtitle4', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link4', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description4', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image4', 'esc_url_raw' );
	
	register_setting( 'meta_field_content_settings', 'title5', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'subtitle5', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link5', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description5', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image5', 'esc_url_raw' );
	
	register_setting( 'meta_field_content_settings', 'title6', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'subtitle6', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link6', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description6', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image6', 'esc_url_raw' );
	
	register_setting( 'meta_field_content_settings', 'title7', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'subtitle7', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link7', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description7', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image7', 'esc_url_raw' );
	
	register_setting( 'meta_field_content_settings', 'title8', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'subtitle8', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link8', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description8', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image8', 'esc_url_raw' );
}
add_action( 'admin_init', 'meta_field_content_register_settings' );

function my_admin_enqueue_scripts() {
	wp_enqueue_media();  // This will enqueue the Media Uploader script
	wp_enqueue_script('my-admin-script', plugins_url('admin-script.js', __FILE__), array('jquery'));
}
add_action( 'admin_enqueue_scripts', 'my_admin_enqueue_scripts' );

function render_meta_field_content() {
	global $post;

	$post_meta_data = get_custom_fields($post->ID);

	// HTML building part
	$html_content = '';
	foreach ($post_meta_data as $key => $data) {
		$html_content .= "<div class='meta-field-content'>";
		$html_content .= "<p>" . $key . " : " . $data . "</p>";
		$html_content .= "</div>";
	}
	return $html_content;
}
add_shortcode('meta_field_content', 'render_meta_field_content');
