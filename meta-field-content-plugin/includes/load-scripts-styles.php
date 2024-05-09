<?php

function enqueue_and_localize_scripts() {
    wp_enqueue_style( 'my_vertical_scroller_css', plugins_url( '../css/carousel.css', __FILE__ ) );
    wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1', 'all');
    // Register the script
    wp_register_script( 'carousel-js', plugins_url( '../js/carousel.js', __FILE__ ), array( 'jquery' ), '1.8.1', true );

    // Check if title option exists and fallback to empty string if not
    $title1 = get_option('title1') ? get_option('title1') : '';
	$subtitle1 = get_option('subtitle1') ? get_option('subtitle1') : '';
    $image1 = get_option('image1') ? esc_url(get_option('image1')) : '';
    $description1 = get_option('description1') ? get_option('description1') : '';
	$link1 = get_option('link1') ? esc_url(get_option('link1')) : '';
	
	$title2 = get_option('title2') ? get_option('title2') : '';
	$subtitle2 = get_option('subtitle2') ? get_option('subtitle2') : '';
	$image2 = get_option('image2') ? esc_url(get_option('image2')) : '';
	$description2 = get_option('description2') ? get_option('description2') : '';
	$link2 = get_option('link2') ? esc_url(get_option('link2')) : '';
	
	$title3 = get_option('title3') ? get_option('title3') : '';
	$subtitle3 = get_option('subtitle3') ? get_option('subtitle3') : '';
	$image3 = get_option('image3') ? esc_url(get_option('image3')) : '';
	$description3 = get_option('description3') ? get_option('description3') : '';
	$link3 = get_option('link3') ? esc_url(get_option('link3')) : '';
	
	$title4 = get_option('title4') ? get_option('title4') : '';
	$subtitle4 = get_option('subtitle4') ? get_option('subtitle4') : '';
	$image4 = get_option('image4') ? esc_url(get_option('image4')) : '';
	$description4 = get_option('description4') ? get_option('description4') : '';
	$link4 = get_option('link4') ? esc_url(get_option('link4')) : '';
	
	$title5 = get_option('title5') ? get_option('title5') : '';
	$subtitle5 = get_option('subtitle5') ? get_option('subtitle5') : '';
	$image5 = get_option('image5') ? esc_url(get_option('image5')) : '';
	$description5 = get_option('description5') ? get_option('description5') : '';
	$link5 = get_option('link5') ? esc_url(get_option('link5')) : '';
	
	$title6 = get_option('title6') ? get_option('title6') : '';
	$subtitle6 = get_option('subtitle6') ? get_option('subtitle6') : '';
	$image6 = get_option('image6') ? esc_url(get_option('image6')) : '';
	$description6 = get_option('description6') ? get_option('description6') : '';
	$link6 = get_option('link6') ? esc_url(get_option('link6')) : '';
	
	$title7 = get_option('title7') ? get_option('title7') : '';
	$subtitle7 = get_option('subtitle7') ? get_option('subtitle7') : '';
	$image7 = get_option('image7') ? esc_url(get_option('image7')) : '';
	$description7 = get_option('description7') ? get_option('description7') : '';
	$link7 = get_option('link7') ? esc_url(get_option('link7')) : '';
	
	$title8 = get_option('title8') ? get_option('title8') : '';
	$subtitle8 = get_option('subtitle8') ? get_option('subtitle8') : '';
	$image8 = get_option('image8') ? esc_url(get_option('image8')) : '';
	$description8 = get_option('description8') ? get_option('description8') : '';
	$link8 = get_option('link8') ? esc_url(get_option('link8')) : '';

    // Localize the script with necessary data
    $localize_data = array(
        'title1' => $title1,
		'subtitle1' => $subtitle1,
        'image1' => $image1,
        'description1' => $description1,
        'link1' => $link1,
        
        'title2' => $title2,
        'subtitle2' => $subtitle2,
        'image2' => $image2,
        'description2' => $description2,
        'link2' => $link2,
        
        'title3' => $title3,
        'subtitle3' => $subtitle3,
        'image3' => $image3,
        'description3' => $description3,
        'link3' => $link3,
        
        'title4' => $title4,
        'subtitle4' => $subtitle4,
        'image4' => $image4,
        'description4' => $description4,
        'link4' => $link4,
        
        'title5' => $title5,
        'subtitle5' => $subtitle5,
        'image5' => $image5,
        'description5' => $description5,
        'link5' => $link5,
        
        'title6' => $title6,
        'subtitle6' => $subtitle6,
        'image6' => $image6,
        'description6' => $description6,
        'link6' => $link6,
        
        'title7' => $title7,
        'subtitle7' => $subtitle7,
        'image7' => $image7,
        'description7' => $description7,
        'link7' => $link7,
        
        'title8' => $title8,
        'subtitle8' => $subtitle8,
        'image8' => $image8,
        'description8' => $description8,
        'link8' => $link8,
    );
    wp_localize_script( 'carousel-js', 'localizedObject', $localize_data );

    // Enqueued script with localized data.
    wp_enqueue_script( 'carousel-js' );
    wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
}
add_action( 'wp_enqueue_scripts', 'enqueue_and_localize_scripts' );

function enqueue_admin_scripts() {
	wp_enqueue_style( 'admin-style', plugins_url( '../admin/admin-styles.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_scripts' );



