<?php
if ( !defined('ABSPATH')) exit;
/**
 * Plugin activation
 * @package    Lazy load videos and sticky control
 * @author     Aishan Shrestha <aishans@gmail.com>
 * @shortname  isn
 * @copyright Copyright (c) 2019, Aishan Shrestha
 * @link       aishan-shrestha.com.np
 * @since      1.0.0
 */
class Lazy_Load_Videos_And_Sticky_Control_Activator {
	public static function llvasc_activate() {
		
		if ( ! current_user_can( 'activate_plugins' ) ) return;
		// Compare versions.
  		if ( version_compare(phpversion(), LLVSC_REQUIRED_PHP_VERSION, '<') ) {
			deactivate_plugins( basename( __FILE__ ) );
			wp_die( 'This plugin requires atleast PHP Version 5.5.  Sorry about that.' );
		} else {
			$plugin = LLVSC_PLUGIN_BASENAME;
        	check_admin_referer( "activate-plugin_{$plugin}" );
        	# Uncomment the following line to see the function in action
			# exit( var_dump( $_GET ) );
			
		}
	}
	
}
