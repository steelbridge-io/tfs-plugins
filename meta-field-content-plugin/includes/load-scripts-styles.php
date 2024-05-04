<?php

function enqueue_and_localize_scripts() {
    wp_enqueue_style( 'my_vertical_scroller_css', plugins_url( '../css/carousel.css', __FILE__ ) );
    wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1', 'all');
    // Register the script
    wp_register_script( 'carousel-js', plugins_url( '../js/carousel.js', __FILE__ ), array( 'jquery' ), '1.8.1', true );

    // Check if title option exists and fallback to empty string if not
    $title1 = get_option('title1') ? get_option('title1') : '';
    $image1 = get_option('image1') ? esc_url(get_option('image1')) : '';
    $description1 = get_option('description1') ? get_option('description1') : '';

    // Localize the script with necessary data
    $localize_data = array(
        'title1' => $title1,
        'image1' => $image1,
        'description1' => $description1,
    );
    wp_localize_script( 'carousel-js', 'localizedObject', $localize_data );

    // Enqueued script with localized data.
    wp_enqueue_script( 'carousel-js' );
    wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
}
add_action( 'wp_enqueue_scripts', 'enqueue_and_localize_scripts' );



