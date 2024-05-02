<?php
/*
Plugin Name: Meta Field Content Plugin
Version: 1.0
*/

function get_custom_fields($post_id) {
	$meta_elements = ['title', 'sub-title', 'link', 'description', 'image'];
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
        <form method="post" action="options.php">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
                        <label for="title">Title</label>
                    </th>
                    <td>
                        <input name="title" type="text" id="title" class="regular-text" value="<?php echo esc_attr( get_option('title') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="link">Link</label>
                    </th>
                    <td>
                        <input name="link" type="text" id="link" class="regular-text" value="<?php echo esc_attr( get_option('link') ); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="description">Description</label>
                    </th>
                    <td>
                        <textarea name="description" id="description" rows="10" class="regular-text"><?php echo esc_textarea( get_option('description') ); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="image_url">Image</label>
                    </th>
                    <td>
                        <input id="upload_image_button" type="button" class="button" value="Upload Image" />
                        <input id="image_url" name="image" type="text" class="regular-text" value="<?php echo esc_url( get_option('image') ); ?>">
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
	register_setting( 'meta_field_content_settings', 'title' );
	register_setting( 'meta_field_content_settings', 'link' );
	register_setting( 'meta_field_content_settings', 'description' );
	register_setting( 'meta_field_content_settings', 'image' );
}
add_action( 'admin_init', 'meta_field_content_register_settings' );

function meta_field_content_sanitize() {
	register_setting( 'meta_field_content_settings', 'title', 'sanitize_text_field' );
	register_setting( 'meta_field_content_settings', 'link', 'esc_url_raw' );
	register_setting( 'meta_field_content_settings', 'description', 'sanitize_textarea_field' );
	register_setting( 'meta_field_content_settings', 'image', 'sanitize_text_field' );
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