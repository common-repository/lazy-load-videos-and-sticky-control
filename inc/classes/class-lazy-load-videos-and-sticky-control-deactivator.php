<?php
if ( !defined('ABSPATH')) exit;
/**
 * Plugin Deactivator
 * @package    Sticky videos on scroll
 * @author     Aishan Shrestha <aishans@gmail.com>
 * @shortname  isn
 * @copyright Copyright (c) 2016, Aishan Shrestha
 * @link       aishan-shrestha.com.np
 * @since      1.0.0
 */
class Lazy_Load_Videos_And_Sticky_Control_Deactivator {
	public static function llvasc_deactivate() {
		if ( ! current_user_can( 'activate_plugins' ) ) return;
	    $plugin = LLVSC_PLUGIN_BASENAME;
		check_admin_referer( "deactivate-plugin_{$plugin}" );
	}
	
}




		