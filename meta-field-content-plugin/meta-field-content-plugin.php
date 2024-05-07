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
        <h2>Meta Field Content</h2>
        <form method="post" action="options.php"
              class="editor-publication-form-grid">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
                        <label for="title1">Title 1</label>
                    </th>
                    <td>
                        <input name="title1" type="text" id="title1" class="regular-text" value="<?php echo esc_attr( get_option('title1') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="subtitle1">Sub Title 1</label>
                    </th>
                    <td>
                        <input name="subtitle1" type="text" id="subtitle1"
                               class="regular-text" value="<?php echo
                        esc_attr( get_option('subtitle1') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link1">Link 1</label>
                    </th>
                    <td>
                        <input name="link1" type="text" id="link1"
                               class="regular-text" value="<?php echo
                        esc_attr( get_option('link1') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description1">Description 1</label>
                    </th>
                    <td>
                        <textarea name="description1" id="description1" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description1') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image 1</label>
                    </th>
                    <td>
                        <input id="upload_image_button1" type="button"
                               class="button" value="Upload Image" />
                        <input id="image_url1" name="image1" type="text"
                               class="regular-text" value="<?php echo esc_url( get_option('image1') ); ?>">
                    </td>
                </tr>
                <!-- Row #2 -->
                <tr>
                    <th scope="row">
                        <label for="title2">Title 2</label>
                    </th>
                    <td>
                        <input name="title2" type="text" id="title2" class="regular-text" value="<?php echo esc_attr( get_option('title2') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="subtitle2">Sub Title 2</label>
                    </th>
                    <td>
                        <input name="subtitle2" type="text" id="subtitle2"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('subtitle2') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link2">Link 2</label>
                    </th>
                    <td>
                        <input name="link2" type="text" id="link2"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('link2') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description2">Description 2</label>
                    </th>
                    <td>
                        <textarea name="description2" id="description2" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description2') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image 2</label>
                    </th>
                    <td>
                        <input id="upload_image_button2" type="button"
                               class="button" value="Upload Image" />
                        <input id="image_url2" name="image2" type="text"
                               class="regular-text" value="<?php echo esc_url( get_option('image2') ); ?>">
                    </td>
                </tr>
                <!-- Row #3 -->
                <tr>
                    <th scope="row">
                        <label for="title3">Title 3</label>
                    </th>
                    <td>
                        <input name="title3" type="text" id="title3" class="regular-text" value="<?php echo esc_attr( get_option('title3') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="subtitle3">Sub Title 3</label>
                    </th>
                    <td>
                        <input name="subtitle3" type="text" id="subtitle3"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('subtitle3') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link3">Link 3</label>
                    </th>
                    <td>
                        <input name="link3" type="text" id="link3"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('link3') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description3">Description 3</label>
                    </th>
                    <td>
                        <textarea name="description3" id="description3" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description3') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image 3</label>
                    </th>
                    <td>
                        <input id="upload_image_button" type="button" class="button" value="Upload Image" />
                        <input id="image_url" name="image3" type="text" class="regular-text" value="<?php echo esc_url( get_option('image3') ); ?>">
                    </td>
                </tr>
                <!-- Row #4 -->
                <tr>
                    <th scope="row">
                        <label for="title4">Title 4</label>
                    </th>
                    <td>
                        <input name="title4" type="text" id="title4" class="regular-text" value="<?php echo esc_attr( get_option('title4') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="subtitle4">Sub Title 4</label>
                    </th>
                    <td>
                        <input name="subtitle4" type="text" id="subtitle4"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('subtitle4') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link4">Link 4</label>
                    </th>
                    <td>
                        <input name="link4" type="text" id="link4"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('link4') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description4">Description 4</label>
                    </th>
                    <td>
                        <textarea name="description4" id="description4" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description4') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image 4</label>
                    </th>
                    <td>
                        <input id="upload_image_button" type="button" class="button" value="Upload Image" />
                        <input id="image_url" name="image4" type="text" class="regular-text" value="<?php echo esc_url( get_option('image4') ); ?>">
                    </td>
                </tr>
                <!-- Row #5 -->
                <tr>
                    <th scope="row">
                        <label for="title5">Title 5</label>
                    </th>
                    <td>
                        <input name="title5" type="text" id="title5" class="regular-text" value="<?php echo esc_attr( get_option('title5') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="subtitle5">Sub Title 5</label>
                    </th>
                    <td>
                        <input name="subtitle5" type="text" id="subtitle5"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('subtitle5') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link5">Link 5</label>
                    </th>
                    <td>
                        <input name="link5" type="text" id="link5"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('link5') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description5">Description 5</label>
                    </th>
                    <td>
                        <textarea name="description5" id="description5" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description5') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image 5</label>
                    </th>
                    <td>
                        <input id="upload_image_button" type="button" class="button" value="Upload Image" />
                        <input id="image_url" name="image5" type="text" class="regular-text" value="<?php echo esc_url( get_option('image5') ); ?>">
                    </td>
                </tr>
                <!-- Row #6 -->
                <tr>
                    <th scope="row">
                        <label for="title6">Title 6</label>
                    </th>
                    <td>
                        <input name="title6" type="text" id="title6" class="regular-text" value="<?php echo esc_attr( get_option('title6') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="subtitle6">Sub Title 6</label>
                    </th>
                    <td>
                        <input name="subtitle6" type="text" id="subtitle6"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('subtitle6') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link6">Link 6</label>
                    </th>
                    <td>
                        <input name="link6" type="text" id="link6"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('link6') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description6">Description 6</label>
                    </th>
                    <td>
                        <textarea name="description6" id="description6" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description6') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image 6</label>
                    </th>
                    <td>
                        <input id="upload_image_button" type="button" class="button" value="Upload Image" />
                        <input id="image_url" name="image6" type="text" class="regular-text" value="<?php echo esc_url( get_option('image6') ); ?>">
                    </td>
                </tr>
                <!-- Row #7 -->
                <tr>
                    <th scope="row">
                        <label for="title7">Title 7</label>
                    </th>
                    <td>
                        <input name="title7" type="text" id="title7" class="regular-text" value="<?php echo esc_attr( get_option('title7') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="subtitle7">Sub Title 7</label>
                    </th>
                    <td>
                        <input name="subtitle7" type="text" id="subtitle7"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('subtitle7') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link7">Link 7</label>
                    </th>
                    <td>
                        <input name="link7" type="text" id="link7"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('link7') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description7">Description 7</label>
                    </th>
                    <td>
                        <textarea name="description7" id="description7" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description7') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image 7</label>
                    </th>
                    <td>
                        <input id="upload_image_button" type="button" class="button" value="Upload Image" />
                        <input id="image_url" name="image7" type="text" class="regular-text" value="<?php echo esc_url( get_option('image7') ); ?>">
                    </td>
                </tr>
                <!-- Row #8 -->
                <tr>
                    <th scope="row">
                        <label for="title8">Title 8</label>
                    </th>
                    <td>
                        <input name="title8" type="text" id="title8" class="regular-text" value="<?php echo esc_attr( get_option('title8') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="subtitle8">Sub Title 8</label>
                    </th>
                    <td>
                        <input name="subtitle8" type="text" id="subtitle8"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('subtitle8') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link8">Link 8</label>
                    </th>
                    <td>
                        <input name="link8" type="text" id="link8"
                               class="regular-text" value="<?php echo
		                esc_attr( get_option('link8') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description8">Description 8</label>
                    </th>
                    <td>
                        <textarea name="description8" id="description8" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description8') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image 8</label>
                    </th>
                    <td>
                        <input id="upload_image_button" type="button" class="button" value="Upload Image" />
                        <input id="image_url" name="image8" type="text" class="regular-text" value="<?php echo esc_url( get_option('image8') ); ?>">
                    </td>
                </tr>
                </tbody>
            </table>

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
