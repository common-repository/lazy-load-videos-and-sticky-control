<?php
if ( !defined('ABSPATH')) exit;
/**
 * The core plugin class
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 * @package    Lazy load videos and sticky control
 * @author     Aishan Shrestha <aishans@gmail.com>
 * @shortname  isn
 * @copyright Copyright (c) 2019, Aishan Shrestha
 * @link       aishan-shrestha.com.np
 * @since      1.0.0
 */
class Lazy_Load_Videos_And_Sticky_Control {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->version     = defined( 'LLVSC_PLUGIN_VERSION' ) ? LLVSC_PLUGIN_VERSION : '1.0.0';
		$this->plugin_name = defined( 'LLVSC_PLUGIN_NAME' ) ? LLVSC_PLUGIN_NAME : 'lazy-load-videos-and-sticky-control';

		$this->llvasc_load_dependencies();
		$this->llvasc_set_locale();
		$this->llvasc_define_admin_hooks();
		$this->llvasc_define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Name_i18n. Defines internationalization functionality.
	 * - Plugin_Name_Admin. Defines all hooks for the admin area.
	 * - Plugin_Name_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function llvasc_load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-loader.php' );


		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-i18n.php' );


		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-admin.php' );

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-shortcode.php' );

		/**
		 * The class responsible for defining WP-block the admin area.
		 */
		require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-block.php' );

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once( LLVSC_PLUGIN_PATH.'/inc/classes/class-lazy-load-videos-and-sticky-control-public.php' );

		$this->loader = new Lazy_Load_Videos_And_Sticky_Control_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function llvasc_set_locale() {
		$plugin_i18n = new Lazy_Load_Videos_And_Sticky_Control_i18n();
		$this->loader->llvasc_add_action( 'plugins_loaded', $plugin_i18n, 'llvasc_load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function llvasc_define_admin_hooks() {
		$plugin_admin = new Lazy_Load_Videos_And_Sticky_Control_Admin( $this->llvasc_get_plugin_name(), $this->llvasc_get_version() );

		$this->loader->llvasc_add_action( 'admin_menu', $plugin_admin, 'llvasc_admin_menu' );
		$this->loader->llvasc_add_filter( 'plugin_action_links_' .LLVSC_PLUGIN_BASENAME, $plugin_admin, 'llvasc_action_setting_links' );
		$this->loader->llvasc_add_action( 'admin_init', $plugin_admin, 'llvasc_admin_init' );
		$this->loader->llvasc_add_action( 'admin_enqueue_scripts', $plugin_admin, 'llvasc_admin_enqueue_scripts' );

		$plugin_admin_shortcode = new Lazy_Load_Videos_And_Sticky_Control_Shortcode( $this->llvasc_get_plugin_name(), $this->llvasc_get_version() );
		$this->loader->llvasc_add_action( 'admin_enqueue_scripts', $plugin_admin_shortcode, 'llvasc_enqueue_scripts' );
		$this->loader->llvasc_add_action( 'init', $plugin_admin_shortcode, 'llvasc_add_shortcode' );
		$this->loader->llvasc_add_filter( 'mce_external_plugins', $plugin_admin_shortcode, 'llvasc_mce_external' );
		$this->loader->llvasc_add_filter( 'mce_buttons', $plugin_admin_shortcode, 'llvasc_mce_button' );

		$plugin_admin_block = new Lazy_Load_Videos_And_Sticky_Control_Block( $this->llvasc_get_plugin_name(), $this->llvasc_get_version() );
		$this->loader->llvasc_add_action('enqueue_block_editor_assets', $plugin_admin_block, 'llvasc_enqueue_block_editor_script');
		$this->loader->llvasc_add_action( 'init', $plugin_admin_block, 'llvasc_register_block' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function llvasc_define_public_hooks() {
		if( !is_admin() ) {
			$plugin_public = new Lazy_Load_Videos_And_Sticky_Control_Public( $this->llvasc_get_plugin_name(), $this->llvasc_get_version() );
			$this->loader->llvasc_add_filter('query_vars', $plugin_public, 'llvasc_add_public_wp_var' );
			$this->loader->llvasc_add_action( 'template_redirect', $plugin_public, 'llvasc_public_custom_css' );
			
			$this->loader->llvasc_add_action( 'wp_enqueue_scripts', $plugin_public, 'llvasc_public_enqueue_scripts' );
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function llvasc_excute_all() {
		$this->loader->llvasc_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function llvasc_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function llvasc_get_version() {
		return $this->version;
	}

}
