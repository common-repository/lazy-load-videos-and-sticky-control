<?php
if ( !defined('ABSPATH')) exit;
/**
 * Define the internationalization functionality
 * Loads and defines the internationalization files for this plugin so that it is ready for translation.
 * @package    Lazy load videos and sticky control
 * @author     Aishan Shrestha <aishans@gmail.com>
 * @shortname  isn
 * @copyright Copyright (c) 2019, Aishan Shrestha
 * @link       aishan-shrestha.com.np
 * @since      1.0.0
 */
class Lazy_Load_Videos_And_Sticky_Control_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function llvasc_load_plugin_textdomain() {
		load_plugin_textdomain(
			LLVSC_PLUGIN_NAME,
			false,
			LLVSC_PLUGIN_NAME.'/languages/'
		);
	}
}
