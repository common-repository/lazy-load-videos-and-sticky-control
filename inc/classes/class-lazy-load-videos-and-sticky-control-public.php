<?php
if ( !defined('ABSPATH')) exit;
/**
 * The public-facing functionality of the plugin.
 * @package    Lazy load videos and sticky control
 * @author     Aishan Shrestha <aishans@gmail.com>
 * @shortname  isn
 * @copyright Copyright (c) 2019, Aishan Shrestha
 * @link       aishan-shrestha.com.np
 * @since      1.0.0
 */
class Lazy_Load_Videos_And_Sticky_Control_Public {

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
	 * added custom query vars
	 * query_vars
	 * @since    1.0.0
	*/
	public function llvasc_add_public_wp_var($public_query_vars) {
		$public_query_vars[] = 'llvasc-custom-css';
		return $public_query_vars;
	}

	/**
	 * Render custom css
	 * template_redirect
	 * @since    1.0.0
	 */
	public function llvasc_public_custom_css(){
		$llvasc_custom_css = get_query_var('llvasc-custom-css');
		if ( $llvasc_custom_css == '1' ){
			include_once (LLVSC_PLUGIN_PATH. 'assets/css/llvasc-public-custom-css.php');
			exit;
		}
	}
	

	/**
	 * Register the Styles for the public-facing side of the site.
	 * Register the JavaScript for the public-facing side of the site.
	 * wp_enqueue_scripts
	 * @since    1.0.0
	 */
	public function llvasc_public_enqueue_scripts() {
		//main style file
		wp_enqueue_style( $this->plugin_name.'-style', LLVSC_PLUGIN_DIR_URL. 'assets/css/llvasc-public.min.css', array(), $this->version, 'all' );
		
		// custom css from general setting 
		$custom_css  = get_option('_llvasc_general_section');
		$custom_css  = isset( $custom_css['_llvasc_custom_css'] ) ? $custom_css['_llvasc_custom_css'] : '';
		if( $custom_css ) {
			if ( function_exists('icl_object_id') ) {
				$css_base_url = site_url();
				if ( is_ssl() ) {
					$css_base_url = site_url('/', 'https');
				}
			} else {
				$css_base_url = get_bloginfo('url');
				if ( is_ssl() ) {
					$css_base_url = str_replace('http://', 'https://', $css_base_url);
				}
			}
			wp_register_style( $this->plugin_name.'-custom', $css_base_url . '?llvasc-custom-css=1' );
			wp_enqueue_style( $this->plugin_name.'-custom');
		}

		/*
		* YouTube iframe api script
		* main script
		*/
		wp_enqueue_script( $this->plugin_name.'-script', LLVSC_PLUGIN_DIR_URL. 'assets/js/llvasc-public.min.js', array(), $this->version, true );
	}
}
