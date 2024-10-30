<?php
if ( !defined('ABSPATH')) exit;
/**
 * Plugin Admin control
 * Description: Setting tab control for lazy load video and sticky control
 * @package    Lazy load videos and sticky control
 * @author     Aishan Shrestha <aishans@gmail.com>
 * @shortname  isn
 * @copyright Copyright (c) 2019, Aishan Shrestha
 * @link       aishan-shrestha.com.np
 * @since      1.0.0
 */
require_once( LLVSC_PLUGIN_PATH.'/inc/classes/helpers/class-settings-api.php' );

class Lazy_Load_Videos_And_Sticky_Control_Admin {
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * The setting API/Helper of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $settings_llvasc   admin helper of this plugin.
    */
    private $settings_llvasc;

     /**
     * The setting option page of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $llvasc_option_page   admin helper of this plugin.
    */
    private $llvasc_option_page;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct() {
        $this->version     = defined( 'LLVSC_PLUGIN_VERSION' ) ? LLVSC_PLUGIN_VERSION : '1.0.0';
		$this->plugin_name = defined( 'LLVSC_PLUGIN_NAME' ) ? LLVSC_PLUGIN_NAME : 'lazy-load-videos-and-sticky-control';
    }

    /**
     * Enqueue scripts 
     *
     * @since    1.0.0
    */
    function llvasc_admin_enqueue_scripts($hook) {
        if( $hook != $this->llvasc_settings_page ) return;
        wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
        wp_enqueue_script( $this->plugin_name.'-script', LLVSC_PLUGIN_DIR_URL. 'assets/js/llvasc-backend.min.js', array(), $this->version, false );
    }

    /**
     * Add Option Page
     *
     * @since    1.0.0
    */
    function llvasc_admin_menu() {
        $this->llvasc_settings_page = add_options_page( __( 'Lazy Load Videos & Sticky Control Settings', LLVSC_PLUGIN_NAME ),
                                                        __( 'Lazy Load Videos & Sticky Control Settings', LLVSC_PLUGIN_NAME ), 
                                                        'manage_options', 
                                                        'lazy-load-videos-and-sticky-control', 
                                                        array( $this, 'llvasc_sections_fields_output' ) );
    }

    /**
     * Add Setting link
     *
     * @since    1.0.0
    */
    function llvasc_action_setting_links($links) {
        $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=lazy-load-videos-and-sticky-control') ) .'">'.__('Settings',LLVSC_PLUGIN_NAME).'</a>';
        $links[] = '<a href="https://preview-plugin.web.app/lazy-load-videos-and-sticky-control.html" target="_blank">'.__('Demo preview',LLVSC_PLUGIN_NAME).'</a>';
        return $links;
    }
    /**
     * Initialize the setting: sections and field for the backned 
     *
     * @since    1.0.0
    */
    function llvasc_admin_init() {
        $this->settings_llvasc = new WeDevs_Settings_API();
       
        //set the settings
        $this->settings_llvasc->set_sections( $this->llvasc_get_settings_tab_sections() );
        $this->settings_llvasc->set_fields( $this->llvasc_get_settings_tab_fields() );

        //initialize settings
        $this->settings_llvasc->admin_init();
    }

    
    
    /**
     * Add Tabbed Setting sections
     *
     * @since    1.0.0
    */
    function llvasc_get_settings_tab_sections() {
        $sections = array(
            array(
                'id'    => '_llvasc_general_section',
                'title' => __( 'General Settings', LLVSC_PLUGIN_NAME )
            ),
            array(
                'id'    => '_llvasc_guide',
                'title' => __( 'Manual/Guide', LLVSC_PLUGIN_NAME )
            )
            
        );
        return $sections;
    }

    /**
     * Returns all the tabbed settings fields
     *
     * @since    1.0.0
     * @return array settings fields
     */
    function llvasc_get_settings_tab_fields() {
        $settings_fields = array(
            '_llvasc_general_section' => array(
                array(
                    'name'    => '_llvasc_sticky_position',
                    'label'   => __( 'Sticky position', LLVSC_PLUGIN_NAME ),
                    'desc'    => __( 'Choose the position you would like to your current playing video to be sticky during scrolling', LLVSC_PLUGIN_NAME ),
                    'type'    => 'select',
                    'default' => 'stick-to-bottom-right',
                    'options' => array(
                        'stick-to-bottom-right' => 'Bottom Right',
                        'stick-to-bottom-left'  => 'Bottom Left',
                        'stick-to-top-right'    => 'Top Right',
                        'stick-to-top-left'     => 'Top Left'
                    )
                ),
                array(
                    'name'    => '_llvasc_custom_css',
                    'label'   => __( 'Custom CSS', LLVSC_PLUGIN_NAME ),
                    'desc'    => __( 'Add your own style', LLVSC_PLUGIN_NAME ),
                    'type'    => 'textarea',
                )
            ),
            '_llvasc_guide' => array(
                array(
                    'name'    => '_llvasc_features',
                    'label'   => __( 'Features', LLVSC_PLUGIN_NAME ),
                    'desc'    => '
                                    <ol>
                                        <li>'.__( 'Lazy load videos. No need to worry about complex settings.', LLVSC_PLUGIN_NAME).'</li>
                                        <li>'.__( 'Support multiple videos on single page. Play only one video at a time. The video will pause if you play other video.', LLVSC_PLUGIN_NAME).'</li>
                                        <li>'.__( 'Sticky video to bottom/top if you scroll away from the video.', LLVSC_PLUGIN_NAME).'</li>
                                        <li>'.__( 'You can also add your own custom styling..', LLVSC_PLUGIN_NAME).'</li>
                                    </ol>
                                ',
                    'type'    => 'html'
                ),
                array(
                    'name'    => '_llvasc_guide',
                    'label'   => __( 'How to?', LLVSC_PLUGIN_NAME ),
                    'desc'    => '
                                    <ol>
                                        <li>Generate shortcode on post/page (WP Editor) by clicking on the icon "LLVASC". This will show you a popup where you can add your YouTube video ID. Where, "Youtube-video-ID" is the unique Alphanumeric code present at the end of your YouTube video. For example: https://www.youtube.com/watch?v=iXGoAj7IEys, where the video id is iXGoAj7IEys.
                                         After you add your ID click "Ok", then the shortcode will be added to your content.</li>
                                        <li>The shortcode it add to your content is:  <mark>[lazy-load-videos-and-sticky-control id="Youtube-video-ID"]</mark> on your page/posts/postypes. 
                                            . Hence, <mark>[lazy-load-videos-and-sticky-control id="iXGoAj7IEys"]<mark> on you content. </li>
                                        <li>'.__( 'Save/update.', LLVSC_PLUGIN_NAME).'</li>
                                        <li>'.__( 'Preview your page. And if you want to adjust some styling you can add your own/custom CSS from the General tab.', LLVSC_PLUGIN_NAME).'</li>
                                    </ol>
                                ',
                    'type'    => 'html'
                )
            )
        );

        return $settings_fields;
    }

    /**
     * Output Tab setting and relative form fields inputs
     *
     * @since    1.0.0
     * @return setting forms and navigation tab
    */
    function llvasc_sections_fields_output() {
        ob_start();
        echo '<div class="wrap">';
        echo '<h2>Lazy Load Videos & Sticky Control Settings<span class="subtitle">by <a href="https://aishan-shrestha.com.np" target="_blank" title="Website of Aishan">Aishan Shrestha</a> (Version '.LLVSC_PLUGIN_VERSION.')</span></h2>';
        $this->settings_llvasc->show_navigation();
        $this->settings_llvasc->show_forms();

        echo '<table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row" style="width:100px;">
                        <a href="https://aishan-shrestha.com.np" target="_blank">
                            <img src="https://secure.gravatar.com/avatar/d3c26d1fed0d8c522234f47f866e9946?s=100&d=retro&r=g" style="-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;">
                        </a>
                    </th>
                    <td style="width:200px;">
                        <p><a href="https://aishan-shrestha.com.np" target="_blank">Aishan Shrestha</a> – thats me.<br>
                        Im the developer of this plugin. Love it!</p>
                        <p><a href="https://preview-plugin.web.app/lazy-load-videos-and-sticky-control.html" target="_blank">Demo here</a></p>
                    </td>
                    <td>
                        <p>If you want to buy a <a href="javascript:void(0)" title="$15 only">premium version</a> of this plugin please contact @<a href="mailto:aishans@gmail.com">Me</a> . On premium version, you will get Lazy Load and sticky feature on HTML5 and Vimeo videos as well :) </p>
                        <p>
                            <b>Feel free to comment for more features and dont forget to </b> give this plugin a 5 star rating <a href="https://wordpress.org/support/view/plugin-reviews/lazy-load-videos-and-sticky-control?filter=5" title="Vote for Lazy load videos and sticky control" target="_blank">on WordPress.org</a>.
                        </p>
                    </td>
		        </tr>
            </tbody>
        </table>';
        echo '</div>';
    }

}


