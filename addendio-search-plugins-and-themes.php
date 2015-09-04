<?php
/*
* Plugin Name: Addendio - Search Plugins and Themes
* Plugin URI: https://addendio.com
* Description: Find plugins and themes like The Flash. Filter and sort based on installations, ratings, and many other criteria.
* Version: 1.0.2
* Author: Addendio
* Author URI: https://addendio.com
* License: GPL2
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

		
		// Make sure that wp_get_current_user function is available
		if(!function_exists('wp_get_current_user()')) {
    	include(ABSPATH . 'wp-includes/pluggable.php'); 
		}

		// Plugin Folder Path
		if ( ! defined( 'AWPPT_PLUGIN_DIR' ) ) {
			define( 'AWPPT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}
		
		if ( is_admin() && current_user_can( 'administrator' ) ) {			
			require_once AWPPT_PLUGIN_DIR . 'includes/awppt-functions.php';
		} 

		// Plugin Folder URL
		if ( ! defined( 'AWPPT_PLUGIN_URL' ) ) {
			define( 'AWPPT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Images Folder URL
		if ( ! defined( 'AWPPT_PLUGIN_IMAGES_URL' ) ) {
		define( 'AWPPT_PLUGIN_IMAGES_URL', plugin_dir_url( __FILE__ ).'assets/images/' );
		}

		// Admin Folder URL
		if ( ! defined( 'AWPPT_ADMIN_FOLDER' ) ) {
		define( 'AWPPT_ADMIN_FOLDER', get_admin_url());
		}

