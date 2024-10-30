<?php
if ( !defined('ABSPATH')) exit;
/**
 * The Block functionality of the plugin.
 * @package    Lazy load videos and sticky control
 * @author     Aishan Shrestha <aishans@gmail.com>
 * @shortname  isn
 * @copyright Copyright (c) 2019, Aishan Shrestha
 * @link       aishan-shrestha.com.np
 * @since      1.0.0
 */
class Lazy_Load_Videos_And_Sticky_Control_Block {

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
	 * Registers the block
	 * @since    3.0.0
	*/
	public function llvasc_register_block() {
        register_block_type( LLVSC_PLUGIN_PATH . 'assets/block' );
    }

	/**
	 * Enqueue the block editor script
	 * @since    1.0.0
	*/
    function llvasc_enqueue_block_editor_script() {
        $data_essentials = array(
			'llvasc-addon' => 'uninstalled',
		);
		
		if (is_plugin_active('llvasc-addon/llvasc-addon.php')) {
			$data_essentials['llvasc-addon'] = 'activated';
		}
		
		wp_localize_script( 'postbox', 'llvascEssentials', $data_essentials );
    }
   
}
