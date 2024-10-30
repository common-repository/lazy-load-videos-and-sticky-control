<?php
if ( !defined('ABSPATH')) exit;
/**
 * The Shortcode functionality of the plugin.
 * @package    Lazy load videos and sticky control
 * @author     Aishan Shrestha <aishans@gmail.com>
 * @shortname  isn
 * @copyright Copyright (c) 2019, Aishan Shrestha
 * @link       aishan-shrestha.com.np
 * @since      1.0.0
 */
class Lazy_Load_Videos_And_Sticky_Control_Shortcode {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {
		$this->version     = defined( 'LLVSC_PLUGIN_VERSION' ) ? LLVSC_PLUGIN_VERSION : '1.0.0';
		$this->plugin_name = defined( 'LLVSC_PLUGIN_NAME' ) ? LLVSC_PLUGIN_NAME : 'lazy-load-videos-and-sticky-control';
	}

	/**
	 * Register the Styles.
	 * Register the JavaScript.
	 * @since    1.0.0
	*/
	public function llvasc_enqueue_scripts() {
		wp_enqueue_style( $this->plugin_name.'-tinymcestyle', LLVSC_PLUGIN_DIR_URL. 'assets/css/llvasc-backend-tinymce.min.css', array(), $this->version, 'all' );
	}

	

	/**
	 * Register button for LLVASC 
	 * @since    1.0.0
	*/
	public function llvasc_mce_button($buttons){
		array_push( $buttons, 'llvasc_mce_button' );
  		return $buttons;
	}

	/**
	 * LLVASC button on WP editor
	 * create shortcode and add to editor
	 * @since    1.0.0
	*/
	public function llvasc_mce_external(){
		$plugin_array['llvasc_register_mce_button'] = LLVSC_PLUGIN_DIR_URL. 'assets/js/llvasc-backend-tinymce.min.js';
  		return $plugin_array;
	}


	/**
	 * Add Shortcode
	 * init
	 * @since    1.0.0
	 */
	public function llvasc_add_shortcode() {
    	add_shortcode('lazy-load-videos-and-sticky-control', array( $this, 'llvasc_shortcode_callback' ) );
	}

	/**
	 * Output shortcode
	 * callback 
	 * @since    1.0.0
	 */
	public function llvasc_shortcode_callback($atts = [], $content = null) {
		extract( shortcode_atts(array( 'id' => null ), $atts) );
		$general_section = get_option('_llvasc_general_section');
		$postion = isset( $general_section['_llvasc_sticky_position'] ) ? $general_section['_llvasc_sticky_position'] : 'stick-to-bottom-right';
		$html = '<div class="llvasc-video-container ytvideo '.$postion.'" data-id="'.$id.'" data-vsrc="youtube"></div>';
		return $html;
    }
}
