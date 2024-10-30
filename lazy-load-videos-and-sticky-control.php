<?php
/**
 * Plugin Name: Lazy load videos and sticky control
 * @package    Lazy load videos and sticky control
 * Description: Lazy load and sticky your video. Super-easy and fun!
 * Author: Aishan
 * @author     Aishan Shrestha <aishans@gmail.com>
 * Author URI: aishan-shrestha.com.np
 * @link       aishan-shrestha.com.np
 * Version: 3.0.0
 * @shortname  isn
 * @copyright Copyright (c) 2019, Aishan Shrestha
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin current version.
 * Plugin Directory Path
 * Plugin Directory URL
 * Plugin ID
 */
define( 'LLVSC_PLUGIN_VERSION', '3.0.0' );
define( 'LLVSC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); 
define( 'LLVSC_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'LLVSC_PLUGIN_BASENAME', plugin_basename(__FILE__) ); 
define( 'LLVSC_PLUGIN_NAME', 'lazy-load-videos-and-sticky-control' ); 
define( 'LLVSC_REQUIRED_PHP_VERSION', '5.5' ); 

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
register_activation_hook( __FILE__, 'activate_lazy_load_videos_and_sticky_control' );
function activate_lazy_load_videos_and_sticky_control() {
    require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-activator.php' );
    Lazy_Load_Videos_And_Sticky_Control_Activator::llvasc_activate();
    
    register_uninstall_hook( __FILE__ , 'lazy_load_videos_and_sticky_control_uninstall' );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
register_deactivation_hook( __FILE__, 'deactivate_lazy_load_videos_and_sticky_control' );
function deactivate_lazy_load_videos_and_sticky_control() {
    require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-deactivator.php' );
	Lazy_Load_Videos_And_Sticky_Control_Deactivator::llvasc_deactivate();
}



// Delete all option data when plugin is uninstalled
function lazy_load_videos_and_sticky_control_uninstall(){

	/*
	 * get all the sections and delete all options from DB
	*/
	require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-admin.php' );
	$settings_sections = new Lazy_Load_Videos_And_Sticky_Control_Admin();
	$sections = $settings_sections->llvasc_get_settings_tab_sections();
	foreach ($sections as $section) {
		$section_id = $section['id'];
		delete_option( $section_id );
	}
}


// plug it in
add_action( 'plugins_loaded', 'initialize_lazy_load_videos_and_sticky_control' );
function initialize_lazy_load_videos_and_sticky_control() {
	
	require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control.php' );
	$lazy_load_videos_and_sticky_control = new Lazy_Load_Videos_And_Sticky_Control();
	$lazy_load_videos_and_sticky_control->llvasc_excute_all();
}

