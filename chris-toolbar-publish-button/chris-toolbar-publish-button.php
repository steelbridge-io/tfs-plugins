<?php

/*
 * Plugin Name: Chris' Toolbar Publish Button
 * Plugin URI: (Original)https://wpUXsolutions.com
 * Description: Note: This plugin has not been updated in 3 years. Chris Parsons has assumed support for this plugin on theflyshop.com. The original developer remains in the Plugin URI, Author, and Author URI and email. Save a lot of your time by scrolling less in WP admin! A small UX improvement that keeps Publish button within reach and retains the scrollbar position after saving in WordPress admin.
 * Version: 1.8
 * Author: wpUXsolutions
 * Author URI: https://wpUXsolutions.com
 * License: GPL2+ - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: toolbar-publish-button
 * Domain Path: /languages/
 *
 * Copyright 2013-2021  wpUXsolutions  (email : wpUXsolutions@gmail.com Current support: chris@parsonshosting.com )
 */



if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}



if ( ! class_exists( 'tpb' ) ) :

class tpb {

    /**
     * TPB version.
     *
     * @var string
     */
    public $version = '1.8';



    /**
     *  Main TPB Instance.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  N/A
     *  @return (object) the one TPB instance
     */

    public static function instance() {

        static $instance = null;

        if ( null === $instance ) {
            $instance = new tpb;
            $instance->initialize();
        }

        return $instance;
    }



    /**
     * Constructor. Intentionally left empty.
     *
     * @since   1.5
     *  @date   07/10/16
     */

    function __construct() {}



    /**
     *  Initializes TPB.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  N/A
     *  @return N/A
     */

    public $options;

    function initialize() {

        // options
        $this->options = array(

            'name'              => __('Toolbar Publish Button', 'toolbar-publish-button'),
            'dir'               => plugin_dir_url( __FILE__ ),
            'basename'          => plugin_basename( __FILE__ ),

            'settings'          => get_option( 'wpuxss_tpb_settings', array() )
        );


        // on update
        $version = get_option( 'wpuxss_tpb_version', null );

        if ( ! is_null( $version ) && version_compare( $version, $this->version, '<>' ) ) {
            $this->on_update();
        }


        // init actions
        add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
        add_action( 'init', array( $this, 'register_admin_assets') );

        add_action( 'admin_init', array( $this, 'register_setting' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets') );
        add_action( 'admin_print_scripts-settings_page_tpb-settings', array( $this, 'print_tpb_settings_page_scripts' ) );


        // activation hook
        add_action( 'activate_' . $this->get_option( 'basename' ), array( $this, 'on_activation' ), 20 );


        // filters
        add_filter( 'plugin_action_links_' . $this->get_option( 'basename' ), array( $this, 'tpb_settings_links' ) );
    }



    /**
     *  Returns a value from the options.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  $name (string) the option name to return
     *  @param  $value (mixed) default value
     *  @return $value (mixed)
     */

    function get_option( $name, $value = null ) {

        if ( isset( $this->options[$name] ) ) {
            $value = $this->options[$name];
        }

        return $value;
    }



    /**
     *  Updates a value into the options.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  $name (string)
     *  @param  $value (mixed)
     *  @return N/A
     */

    function update_option( $name, $value ) {

        $this->options[$name] = $value;
    }



    /**
     *  Loads plugin text domain.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function load_plugin_textdomain() {

        load_plugin_textdomain( 'toolbar-publish-button' );
    }



    /**
     *  Register plugin settings.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function register_setting() {

        register_setting(
            'wpuxss_tpb_settings', //option_group
            'wpuxss_tpb_settings', //option_name
            array( $this, 'sanitize_tpb_settings' ) //sanitize_callback
        );
    }



    /**
     *  Sanitizes plugin settings before saving.
     *
     *  @type   callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function sanitize_tpb_settings( $input ) {

        $defaults = $this->get_default_settings();


        foreach ( $defaults as $option => $value ) {

            switch ( $option ) {

                case 'button_bg_color':
                    $tpb_settings = $this->get_option( 'settings' );
                    $button_bg_color = trim( $input['button_bg_color'] );
                    $button_bg_color = strip_tags( stripslashes( $button_bg_color ) );

                    if( ! empty( $button_bg_color ) && false === $this->validate_color_format( $button_bg_color ) ) {

                        // $setting, $code, $message, $type
                        add_settings_error( 'wpuxss_tpb_settings', 'wpuxss_tpb_settings_color_error', __( 'Please choose a valid color for background', 'toolbar-publish-button' ), 'error' );

                        $input['button_bg_color'] = $tpb_settings['button_bg_color'];

                    } else {
                        $input['button_bg_color'] = $button_bg_color;
                    }
                    break;

                default:
                    $input[$option] = isset( $input[$option] ) && !! $input[$option] ? 1 : 0;
                    break;
            }
        }

        return $input;
    }



    /**
     *  Checks if BG color format is correct.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  $color (string)
     *  @return (bool)
     */

    function validate_color_format( $color ) {

        if ( preg_match( '/^#[a-f0-9]{6}$/i', $color ) ) {
            return true;
        }

        return false;
    }



    /**
     *  Registers scripts and styles for admin.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function register_admin_assets() {

        $version = $this->version;
        $dir     = $this->get_option( 'dir' );


        // scripts
        wp_register_script( 'tpb-admin', $dir . 'js/tpb.js', array( 'jquery' ), $version, true );
        wp_register_script( 'tpb-options', $dir . 'js/tpb-options.js', array( 'jquery' ), $version, true );
        wp_register_script( 'tpb-scrollbar', $dir . 'js/tpb-scrollbar.js', array( 'jquery', 'tpb-admin' ), $version, true );
        wp_register_script( 'tpb-color-picker', $dir . 'js/tpb-color-picker.js', array( 'wp-color-picker' ), $version, true );


        // styles
        wp_register_style( 'tpb-admin', $dir . 'css/tpb-admin.css', false, $version, 'all' );
    }



    /**
     *  Enqueues scripts and styles for admin.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function enqueue_admin_assets( $hook ) {

        global $hook_suffix;

        if ( 'index.php' == $hook_suffix ) {
            return;
        }


        $screen = get_current_screen();
        $settings = $this->get_option( 'settings' );
        
        // Ensure all required settings have defaults if they don't exist
        $defaults = $this->get_default_settings();
        foreach ($defaults as $key => $default_value) {
            if (!isset($settings[$key])) {
                $settings[$key] = $default_value;
            }
        }

        // scripts
        wp_enqueue_script( 'tpb-admin' );
        wp_localize_script( 'tpb-admin', 'tpb_l10n', array(
            'button_bg' => isset($settings['button_bg_color']) ? $settings['button_bg_color'] : '#0073AA',
            'draft_button' => (bool) (isset($settings['draft_button']) ? $settings['draft_button'] : 1),
            'preview_button' => (bool) (isset($settings['preview_button']) ? $settings['preview_button'] : 1),
            'buttons_to_the_right' => (bool) (isset($settings['buttons_to_the_right']) ? $settings['buttons_to_the_right'] : 0)
        ) );


        if ( isset($settings['scrollbar_return']) && (bool) $settings['scrollbar_return'] ) {

            if ( ( 'acf-field-group' === $screen->post_type && isset($settings['expand_acf']) && (bool) $settings['expand_acf'] ) || 
                 'acf-field-group' !== $screen->post_type ) {
                wp_enqueue_script( 'tpb-scrollbar' );
            }
        }
    }



    /**
     *  Enqueues scripts for plugin's settings page.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function print_tpb_settings_page_scripts() {

        // scripts
        wp_enqueue_script( 'tpb-color-picker' );
        wp_enqueue_script( 'tpb-options' );

        // styles
        wp_enqueue_style( 'tpb-admin' );
        wp_enqueue_style( 'wp-color-picker' );
    }



    /**
     *  Adds plugin options admin page.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function admin_menu() {

        add_options_page(
            __('Settings','toolbar-publish-button') . ' :: ' . __( 'Toolbar Publish Button', 'toolbar-publish-button' ), //page_title
            __('Toolbar Publish Button','toolbar-publish-button'), //menu_title
            'manage_options', //capability
            'tpb-settings', //page
            array( $this, 'print_tpb_settings_page' ) //callback
        );
    }



    /**
     *  Displays TPB settings page.
     *
     *  @since  1.5
     *  @date   07/10/16
     *
     *  @param  N/A
     *  @return N/A
     */

    function print_tpb_settings_page() {

        $version = $this->version;
        $settings = $this->get_option( 'settings' );


        if ( ! current_user_can( 'manage_options' ) )
            wp_die( __('You do not have sufficient permissions to access this page.','toolbar-publish-button') );
        ?>

        <div id="tpb-settings-wrap" class="wrap">

            <h2><?php _e( 'Settings', 'toolbar-publish-button' ); ?> :: <?php _e( 'Toolbar Publish Button', 'toolbar-publish-button' ); ?></h2>

            <div id="poststuff">

                <div id="post-body" class="metabox-holder columns-2">

                    <div id="postbox-container-2" class="postbox-container">

                        <div class="postbox">

                            <div class="inside">

                                <form method="post" action="options.php">

                                    <?php settings_fields( 'wpuxss_tpb_settings' ); ?>

                                    <table class="form-table">

                                        <tr id="wpuxss-tpb-scrollbar-position">
                                            <th scope="row"><?php _e('Scrollbar Position','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('Remember scrollbar position','toolbar-publish-button'); ?></span></legend>
                                                    <label><input name="wpuxss_tpb_settings[scrollbar_return]" type="checkbox" value="1" <?php checked( '1', (bool) $settings['scrollbar_return'] ); ?> /> <?php _e('Remember scrollbar position','toolbar-publish-button'); ?></label>
                                                    <p class="description"><?php _e('Returns the scrollbar of any admin page to its position after saving.','toolbar-publish-button'); ?></p>
                                                    <p class="description"><?php _e('Works for Plugins page after plugin actiation / deactivation.','toolbar-publish-button'); ?></p>
                                                </fieldset>
                                            </td>
                                        </tr>

                                        <tr id="wpuxss-tpb-expand-acf">
                                            <th scope="row"><?php _e('Expand ACF fields','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('Expand ACF fields','toolbar-publish-button'); ?></span></legend>
                                                    <label><input name="wpuxss_tpb_settings[expand_acf]" type="checkbox" value="1" <?php checked( '1', (bool) $settings['expand_acf'] ); ?> /> <?php _e('Expand ACF fields to scroll to the point of editing after saving','toolbar-publish-button'); ?></label>
                                                </fieldset>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row"><?php _e('"Save Draft" button','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('"Save Draft" button','toolbar-publish-button'); ?></span></legend>
                                                    <label><input name="wpuxss_tpb_settings[draft_button]" type="checkbox" value="1" <?php checked( '1', (bool) $settings['draft_button'] ); ?> /> <?php _e('Duplicate "Save Draft" button to the Toolbar','toolbar-publish-button'); ?></label>
                                                </fieldset>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row"><?php _e('"Preview" button','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('"Preview" button','toolbar-publish-button'); ?></span></legend>
                                                    <label><input name="wpuxss_tpb_settings[preview_button]" type="checkbox" value="1" <?php checked( '1', (bool) $settings['preview_button'] ); ?> /> <?php _e('Duplicate "Preview" / "Preview Changes" button to the Toolbar','toolbar-publish-button'); ?></label>
                                                </fieldset>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row"><?php _e('Buttons to the right','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('Buttons to the right','toolbar-publish-button'); ?></span></legend>
                                                    <label><input name="wpuxss_tpb_settings[buttons_to_the_right]" type="checkbox" value="1" <?php checked( '1', (bool) $settings['buttons_to_the_right'] ); ?> /> <?php _e('Move buttons to the right side of the Toolbar','toolbar-publish-button'); ?></label>
                                                </fieldset>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row"><?php _e('Button Background','toolbar-publish-button'); ?></th>
                                            <td>
                                                <fieldset>
                                                    <legend class="screen-reader-text"><span><?php _e('Button Background','toolbar-publish-button'); ?></span></legend>
                                                    <label><input type="text" value="<?php echo $settings['button_bg_color']; ?>" class="wpuxss-tpb-button-color" name="wpuxss_tpb_settings[button_bg_color]" /></label>
                                                </fieldset>
                                            </td>
                                        </tr>

                                    </table>

                                    <?php submit_button(); ?>

                                </form>

                            </div>

                        </div>

                    </div>

                    <div id="postbox-container-1" class="postbox-container">

                        <div class="postbox" id="wpuxss-credit">

                            <h3 class="hndle">Toolbar Publish Button <?php echo $version; ?></h3>

                            <div class="inside">

                                <h4><?php _e( 'Changelog', 'toolbar-publish-button' ); ?></h4>
                                <p><?php _e( 'What\'s new in', 'toolbar-publish-button' ); ?> <a href="http://wordpress.org/plugins/toolbar-publish-button/changelog/"><?php _e( 'version', 'toolbar-publish-button' ); echo ' ' . $version; ?></a>.</p>

                                <h4><?php _e( 'Support', 'toolbar-publish-button' ); ?></h4>
                                <p><?php _e( 'Feel free to ask for help on', 'toolbar-publish-button' ); ?> <a href="http://www.wpuxsolutions.com/support/">www.wpuxsolutions.com</a>.</p>

                                <h4><?php _e( 'Plugin rating', 'toolbar-publish-button' ); ?> <span class="dashicons dashicons-thumbs-up"></span></h4>
                                <p><?php _e( 'Please', 'toolbar-publish-button' ); ?> <a href="http://wordpress.org/support/view/plugin-reviews/toolbar-publish-button/"><?php _e( 'vote for the plugin', 'toolbar-publish-button' ); ?></a>. <?php _e( 'Thanks!', 'toolbar-publish-button' ); ?></p>                                 
                                <div class="author">
                                    <span><a href="http://www.wpuxsolutions.com/">wpUXsolutions</a> by <a class="logo-webbistro" href="http://twitter.com/webbistro"><span class="icon-webbistro">@</span>webbistro</a></span>
                                </div>

                            </div>

                        </div>

                        <div class="postbox" id="wpuxss-credit">

                            <h3 class="hndle">Enhanced Media Library PRO</h3>

                            <div class="inside">
                                <p>Categorize & filter your media library!</p>
                                <p><a href="https://wpuxsolutions.com/pricing?coupon=TPBFAN" target="_blank" class="button button-primary"><span>52% OFF</span> DISCOUNT</a></p>
                                <p>Exclusive offer for this plugin users ONLY. Pay just <strong>$12</strong> instead of <strong style="text-decoration: line-through;">$25</strong> for a lifetime multisite license.</p>
                                
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php
    }



    /**
     *  Adds settings link to the plugin action links.
     *
     *  @type   filter callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function tpb_settings_links( $links ) {

        return array_merge(
            array(
                'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/options-general.php?page=tpb-settings">' . __('Settings','toolbar-publish-button') . '</a>'
            ),
            $links
        );
    }



    /**
     *  Sets plugin default settings.
     *
     *  @type   action callback
     *  @since  1.8
     *  @date   08/2021
     */
    function get_default_settings() {

        $defaults = array (
            'scrollbar_return'     => 1,
            'button_bg_color'      => '#0073AA',
            'draft_button'         => 1,
            'preview_button'       => 1,
            'buttons_to_the_right' => 0,
            'expand_acf'           => 1
        );

        return $defaults;
    }



    /**
     *  Sets initial plugin settings.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function on_activation() {

        if ( ! is_null( get_option( 'wpuxss_tpb_version', null ) ) ) {
            return;
        }

        // update version
        update_option( 'wpuxss_tpb_version', $this->version );


        // set initial settings
        $defaults = $this->get_default_settings();

        update_option( 'wpuxss_tpb_settings', $defaults );
        $this->update_option( 'settings', $defaults );
    }



    /**
     *  Makes changes to plugin options on update.
     *
     *  @type   action callback
     *  @since  1.5
     *  @date   07/10/16
     */

    function on_update() {

        // update version
        update_option( 'wpuxss_tpb_version', $this->version );


        // correct settings
        $tpb_settings = $this->get_option( 'settings' );
        $defaults = $this->get_default_settings();

        $defaults['scrollbar_return'] = isset( $tpb_settings['wpuxss_tpb_scrollbar_return'] ) ? $tpb_settings['wpuxss_tpb_scrollbar_return'] : 1;
        $defaults['button_bg_color'] = isset( $tpb_settings['wpuxss_tpb_background'] ) ? $tpb_settings['wpuxss_tpb_background'] : '';

        $tpb_settings = array_intersect_key( $tpb_settings, $defaults );
        $tpb_settings = array_merge( $defaults, $tpb_settings );


        update_option( 'wpuxss_tpb_settings', $tpb_settings );
        $this->update_option( 'settings', $tpb_settings );
    }


} // class tpb



/**
*  The main function.
*
*  @since    1.5
*  @date  07/10/16
*
*  @param    N/A
*  @return   (object)
*/

function tpb() {

   return tpb::instance();
}



// initialize
tpb();


endif; // class_exists