<?php
/**
	* Adds a meta-box to the post-editing screen
	*/
//ob_implicit_flush(true);
function register_landing_page_meta_box() {
	global $post;
	if ( ! empty( $post ) ) {
		$pageTemplate = get_post_meta( $post->ID, '_wp_page_template', TRUE );
		$types        = array( 'page', 'post' );
		
		if ( $pageTemplate == 'page-templates/landing-page.php' ) {
			foreach ( $types as $type ) {
				add_meta_box( 'landing_page_meta',
					__( 'Landing Page Template Options', 'landing-page-textdomain' ),
					'landing_page_meta_callback',
					$type,
					'normal',
					'high' );
			}
		}
	}
}

add_action( 'add_meta_boxes', 'register_landing_page_meta_box' );
/**
	* Outputs the content of the meta-box
	*/
//ob_start();
function landing_page_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'landing_page_nonce' );
	$landing_page_stored_meta = get_post_meta( $post->ID ); ?>
    
    <div id="meta-wrapper">
    
        <div class="meta-cont"> <!-- ==== TFS LOGO ==== -->
        
            <?php
            $landing_page_logo = '';
            if ( isset( $landing_page_stored_meta['landing-page-logo'] ) ) {
            $landing_page_logo = $landing_page_stored_meta['landing-page-logo'][0];
            }
            
            $landing_page_logo = get_post_meta( $post->ID, 'landing-page-logo', true );
            ?>
            <div class="input-cont">
            <div class="landing-inputs">
                <label for="landing-page-logo" class="landing-page-row-title"><?php _e( 'TFS Logo', 'landing-page-textdomain' ); ?></label>
                <input type="text" style="width:55%;" name="landing-page-logo" id="landing-page-logo" value="<?php echo esc_attr($landing_page_logo); ?>"/>
                <input type="button" id="landing-page-logo-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'landing-page-textdomain' ); ?>"/>
                <img class="image-preview" id="landing-page-logo-preview" src="<?php echo( $landing_page_logo ? $landing_page_logo : plugins_url( '../img/placeholder.jpg', __FILE__ ) ); ?>" alt="Image Preview">
            </div>
            </div>
            
        </div>
    
        <div class="meta-cont"> <!-- ==== LANDING PAGE HERO IMAGE ==== -->
        
            <?php
            $landing_page_image = '';
            if ( isset( $landing_page_stored_meta['landing-page-image'] ) ) {
            $landing_page_image = $landing_page_stored_meta['landing-page-image'][0];
            }
            $landing_page_image = get_post_meta( $post->ID, 'landing-page-image', true );
            ?>

            <div class="input-cont">
            <div class="landing-inputs">
            <label for="landing-page-image" class="landing-page-row-title"><?php _e( 'Hero Image', 'landing-page-textdomain' ); ?></label>
            <input type="text" style="width:55%;" name="landing-page-image" id="landing-page-image" value="<?php echo esc_attr($landing_page_image); ?>"/>
            <input type="button" id="landing-page-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'landing-page-textdomain' ); ?>"/>
            <img class="image-preview" id="landing-page-image-preview" src="<?php echo( $landing_page_image ? $landing_page_image : plugins_url( '../img/placeholder.jpg', __FILE__ ) ); ?>" alt="Image Preview">
            </div>
            </div>
            
        </div>
    
        <div class="meta-cont">
        
            <?php
            $landing_page_desc = '';
            if ( isset( $landing_page_stored_meta['landing-page-desc'] ) ) {
            $landing_page_desc = $landing_page_stored_meta['landing-page-desc'][0];
            }
            $landing_page_image = get_post_meta( $post->ID, 'landing-page-image', true );
            ?>
            
            <div class="input-cont">
            <div class="landing-inputs">
            <label for="landing-page-desc" class="blog-row-desc"><?php _e( 'Header Description', 'tfs-blog-textdomain' ) ?></label>
            <input style="width: 80%;" type="text" name="landing-page-desc" id="landing-page-desc" value="<?php echo esc_attr($landing_page_desc); ?>"/>
            </div>
            
            </div>
        </div>
    </div>
    
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Item #1
                    <?php  $grid_item_1_img = get_post_meta( $post->ID, 'grid-item-1-img', true ); ?>
                    <img class="image-preview-grid" id="grid-item-1-img-preview" src="<?php echo( $grid_item_1_img ? $grid_item_1_img : plugins_url( '../img/placeholder.jpg', __FILE__ ) ); ?>" alt="Image Preview">
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
				            
                    <?php
                    $grid_item_1_img = '';
                    if ( isset( $landing_page_stored_meta['grid-item-1-img'] ) ) {
                    $grid_item_1_img = $landing_page_stored_meta['grid-item-1-img'][0];
                    }
                    $grid_item_1_img = get_post_meta( $post->ID, 'grid-item-1-img', true );
                    ?>

                    <input type="text" style="width:50%;" name="grid-item-1-img" id="grid-item-1-img" value="<?php echo esc_attr($grid_item_1_img); ?>"/>
                    <input type="button" id="grid-item-1-img-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'landing-page-textdomain' ); ?>"/>
                    
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Item #2
                    <?php  $grid_item_2_img = get_post_meta( $post->ID, 'grid-item-2-img', true ); ?>
                    <img class="image-preview-grid" id="grid-item-2-img-preview" src="<?php echo( $grid_item_2_img ? $grid_item_2_img : plugins_url( '../img/placeholder.jpg', __FILE__ ) ); ?>" alt="Image Preview">
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                
                    <?php
                    $grid_item_2_img = '';
                    if ( isset( $landing_page_stored_meta['grid-item-2-img'] ) ) {
                    $grid_item_2_img = $landing_page_stored_meta['grid-item-2-img'][0];
                    }
                    $grid_item_2_img = get_post_meta( $post->ID, 'grid-item-2-img', true );
                    ?>
                    
                    <input type="text" style="width:50%;" name="grid-item-2-img" id="grid-item-2-img" value="<?php echo esc_attr($grid_item_2_img); ?>"/>
                    <input type="button" id="grid-item-2-img-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'landing-page-textdomain' ); ?>"/>
                    
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Item #3
                    <?php  $grid_item_3_img = get_post_meta( $post->ID, 'grid-item-3-img', true ); ?>
                    <img class="image-preview-grid" id="grid-item-3-img-preview" src="<?php echo( $grid_item_3_img ? $grid_item_3_img : plugins_url( '../img/placeholder.jpg', __FILE__ ) ); ?>" alt="Image Preview">
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                
                    <?php
                    $grid_item_3_img = '';
                    if ( isset( $landing_page_stored_meta['grid-item-3-img'] ) ) {
                    $grid_item_3_img = $landing_page_stored_meta['grid-item-3-img'][0];
                    }
                    $grid_item_3_img = get_post_meta( $post->ID, 'grid-item-3-img', true );
                    ?>

                    <input type="text" style="width:50%;" name="grid-item-3-img" id="grid-item-3-img" value="<?php echo esc_attr($grid_item_3_img); ?>"/>
                    <input type="button" id="grid-item-3-img-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'landing-page-textdomain' ); ?>"/>
                    
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Item #4
                    <?php  $grid_item_4_img = get_post_meta( $post->ID, 'grid-item-4-img', true ); ?>
                    <img class="image-preview-grid" id="grid-item-4-img-preview" src="<?php echo( $grid_item_4_img ? $grid_item_4_img : plugins_url( '../img/placeholder.jpg', __FILE__ ) ); ?>" alt="Image Preview">
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
												    
                    <?php
                    $grid_item_4_img = '';
                    if ( isset( $landing_page_stored_meta['grid-item-4-img'] ) ) {
                    $grid_item_4_img = $landing_page_stored_meta['grid-item-4-img'][0];
                    }
                    $grid_item_4_img = get_post_meta( $post->ID, 'grid-item-4-img', true );
                    ?>

                    <input type="text" style="width:50%;" name="grid-item-4-img" id="grid-item-4-img" value="<?php echo esc_attr($grid_item_4_img); ?>"/>
                    <input type="button" id="grid-item-4-img-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'landing-page-textdomain' ); ?>"/>

                </div>
            </div>
        </div>
    </div>

<?php }

/* ========== Saves/Sanitizes ========== */

add_action( 'save_post', 'save_landing_page_fields' );
    function save_landing_page_fields( $post_id ): void {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! isset( $_POST['landing_page_nonce'] )
             || ! wp_verify_nonce( $_POST['landing_page_nonce'], basename( __FILE__ ) ) )
        {
            return;
        }
    
        if ( isset( $_POST['landing-page-logo'] ) ) {
            $landing_page_logo = $_POST['landing-page-logo'];
            } else {
            $landing_page_logo = '';
        }
    
        update_post_meta( $post_id, 'landing-page-logo', sanitize_text_field( $landing_page_logo ) );
        
        if ( isset( $_POST['grid-item-1-img'] ) ) {
            $grid_item_1_img = $_POST['grid-item-1-img'];
            } else {
            $grid_item_1_img = '';
        }
        
        update_post_meta( $post_id, 'grid-item-1-img', sanitize_text_field( $grid_item_1_img ) );
    
        if ( isset( $_POST['grid-item-2-img'] ) ) {
            $grid_item_2_img = $_POST['grid-item-2-img'];
            } else {
            $grid_item_2_img = '';
        }
        
        update_post_meta( $post_id, 'grid-item-2-img', sanitize_text_field( $grid_item_2_img ) );
    
        if ( isset( $_POST['grid-item-3-img'] ) ) {
            $grid_item_3_img = $_POST['grid-item-3-img'];
            } else {
            $grid_item_3_img = '';
        }
    
        update_post_meta( $post_id, 'grid-item-3-img', sanitize_text_field( $grid_item_3_img ) );
    
        if ( isset( $_POST['grid-item-4-img'] ) ) {
        $grid_item_4_img = $_POST['grid-item-4-img'];
        } else {
        $grid_item_4_img = '';
        }
        
        update_post_meta( $post_id, 'grid-item-4-img', sanitize_text_field( $grid_item_4_img ) );
        
        if ( isset( $_POST['landing-page-image'] ) ) {
            $landing_page_image = $_POST['landing-page-image'];
            if ( ! empty( $landing_page_image ) )
            {
                update_post_meta( $post_id, 'landing-page-image', $landing_page_image );
            } else {
                delete_post_meta( $post_id, 'landing-page-image' );
            }
        }
    
        if ( isset( $_POST['landing-page-desc'] ) ) {
            $landing_page_desc = $_POST['landing-page-desc'];
            if ( ! empty( $landing_page_desc ) ) {
                update_post_meta( $post_id, 'landing-page-desc', $landing_page_desc );
            } else {
                delete_post_meta( $post_id, 'landing-page-desc' );
            }
        }
    
    }


