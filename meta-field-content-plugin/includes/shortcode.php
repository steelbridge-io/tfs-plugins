<?php

function generate_scroller_func( $atts ) {
    return '<div id="my-scroller"></div>';
}
add_shortcode( 'my-vertical-scroller', 'generate_scroller_func' );

function generate_horizontal_scroller_func( $atts ) {
	return '<div id="my-horizontal-scroller"></div>';
}
add_shortcode( 'my-horizontal-scroller', 'generate_horizontal_scroller_func' );


