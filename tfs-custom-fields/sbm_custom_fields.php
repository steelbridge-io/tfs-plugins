<?php
/*
Plugin Name: TFS Custom Fields
Plugin URI: http://steelbridgemedia.com
Description: A plugin for custom meta fields associated with templates.
Version: 1.3.3
Author: Chris Parsons
Author URI: http://steelbridgemedia.com
Copyright 2016 Chris Parsons (chris@steelbridgemedia.com)
*/

if (!defined('ABSPATH')) {
		exit('Cheatin&#8217; uh?');
	}

include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_travel.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_private_waters.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_guide_service.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_schools.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_fish_camp.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_stream_report.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_basic.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_blog.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_blog_new.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_fields_travel_table.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_survey_template.php');
include( plugin_dir_path( __FILE__ ) . 'sbm_custom_blog_basic.php');
include( plugin_dir_path( __FILE__ ) . 'meta-style/meta-css.php');

function favicon_function() {
	echo '<link href="'.get_bloginfo('stylesheet_directory').'/img/favicon.ico" rel="Shortcut Icon" type="image/x-icon" />';
}
add_action('wp_head', 'favicon_function');

function load_custom_private_admin_style() {
        // Load only on ?page=mypluginname
        /*if($hook != 'post.php') {
                return;
        }*/
        wp_enqueue_style( 'sbm_wp_admin_css', plugins_url('css/bootstrap.css', __FILE__) );
				wp_enqueue_style( 'sbm_cust_styles', plugins_url( 'css/custom_fields_style.css', __FILE__ ) );

				wp_enqueue_script( 'custom_wp_admin_js', plugins_url('js/bootstrap.min.js', __FILE__));
				wp_enqueue_script( 'custom_meta_field_js', plugin_dir_url( __FILE__ ) . 'js/custom-meta.js', array('wp-color-picker'), '', false );
}
add_action( 'admin_enqueue_scripts', 'load_custom_private_admin_style' );

