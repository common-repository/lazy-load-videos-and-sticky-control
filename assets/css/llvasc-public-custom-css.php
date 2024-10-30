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

if ( ! isset( $_GET['llvasc-custom-css'] ) || intval( $_GET['llvasc-custom-css'] ) !== 1 ) {
	return;
}

ob_start();
header("Content-type: text/css");
$custom_css = get_option('_llvasc_general_section');
$custom_css = wp_kses( $custom_css['_llvasc_custom_css'], array( '\'', '\"' ) );
$custom_css = str_replace ( '&gt;' , '>' , $custom_css );
echo $custom_css;

