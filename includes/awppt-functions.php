<?php
/**
 * @copyright   Copyright (c) 2015, Addendio.com
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



//Search Plugins Page
require_once  dirname(__FILE__) . '/awppt-search-plugins-page.php';

//Search Themes Page
require_once  dirname(__FILE__) . '/awppt-search-themes-page.php';

//Tooltips
require_once( dirname( __FILE__ ).'/awppt-tooltips.php');


//We add the menus for searching plugins and Themes
add_action( 'admin_menu', 'awppt_menu', 9 );

function awppt_menu() {
	
	global $awppt_plugins_page;
	global $awppt_themes_page;
	global $submenu;
	
	$awppt_plugins_page = add_plugins_page( 'Search Plugins with Addendio', 'Search Plugins', 'manage_options', 'addendio-search-plugins', 'awpp_search_plugins');
	$awppt_themes_page = add_theme_page( 'Search Themes with Addendio', 'Search Themes', 'manage_options', 'addendio-search-themes', 'awpp_search_themes');
			
}
 

// Reorders the submenu for plugins so that the Search Plugins is top of the list

add_filter( 'custom_menu_order', 'awppt_custom_plugins_submenu_order' );

function awppt_custom_plugins_submenu_order( $menu_ord ) 
    {
        global $submenu;

		$results = array_search('addendio-search-plugins', array_column($submenu['plugins.php'],2));
		$submenu['plugins.php'] = array_values($submenu['plugins.php']);
		$value = $submenu['plugins.php'][$results];
		unset($submenu['plugins.php'][$results]);
    	array_unshift($submenu['plugins.php'], $value);
       		
		return $menu_ord;
    }


// Reorders the submenu for themes so that the Search Themes is top of the list

add_filter( 'custom_menu_order', 'awppt_custom_themes_submenu_order' );

	function awppt_custom_themes_submenu_order( $menu_ord ) 
	{
	global $submenu;

	$results = array_search('addendio-search-themes', array_column($submenu['themes.php'],2));
	$submenu['themes.php'] = array_values($submenu['themes.php']);
	$value = $submenu['themes.php'][$results];
	unset($submenu['themes.php'][$results]);
	array_unshift($submenu['themes.php'], $value);


	return $menu_ord;
	}



// We load the scripts for the search of plugins and themes
add_action( 'admin_enqueue_scripts', 'awppt_load_addendio_pages' );	

function awppt_load_addendio_pages($hook){

	global $awppt_plugins_page;
	global $awppt_themes_page;

	
	//=======================================================================================================================================
	// PLUGINS SEARCH PAGE
	// only if user is admin and is on the right page, we load what we need

	if(is_admin() && $hook == $awppt_plugins_page ) {	
	
	//CSS	
	wp_enqueue_style( 'swpp-styles-css', AWPPT_PLUGIN_URL .'assets/css/styles.css');
	add_thickbox();

	//JS
	wp_enqueue_script( 'bootstrap_awppt', AWPPT_PLUGIN_URL.'assets/js/bootstrap.min.js', array('jquery'), '3.2.0', true);
	wp_enqueue_script( 's_awppt', AWPPT_PLUGIN_URL.'assets/js/s.min.js', false, '3.0.2', true);
	wp_enqueue_script( 'sh_awppt', AWPPT_PLUGIN_URL.'assets/js/s.h.min.js', false,'2.0.1', true);
	wp_enqueue_script( 'hogan_awppt', AWPPT_PLUGIN_URL.'assets/js/hogan.common.js', false, '3.0.0', true);
	wp_enqueue_script( 'checkbox_awppt', AWPPT_PLUGIN_URL . 'assets/js/bootstrap-checkbox.js',false,'1.0.0', true);
	wp_enqueue_script( 'slider_awppt', AWPPT_PLUGIN_URL . 'assets/js/bootstrap-slider.js',false,'1.0.0', true);
	wp_enqueue_script( 'app_awpp', AWPPT_PLUGIN_URL . 'assets/js/awpp.min.js',false,'1.0.1', true);
	
	// We pass some variables to the JS app in order to improve results	
	$plugins = 	awppt_get_plugins_installed ();
	
	wp_localize_script('app_awpp', 'app_awpp_vars', 
					   array( 
						   'wpversion' => get_bloginfo( 'version' )
						   , 'plugins_installed' =>  $plugins 
							, 'last_update_range_facet_tooltip' => _txt_awppt_last_update_range_tooltip 
							, 'rating_facet_tooltip' => _txt_awppt_rating_tooltip
							, 'num_ratings_facet_tooltip' => _txt_awppt_num_ratings_tooltip
							, 'plugin_class_facet_tooltip' => _txt_awppt_plugin_class_tooltip
						   , 'installs_facet_tooltip' => _txt_awppt_installs_tooltip
					   )  );
	
	} 
	
	//=======================================================================================================================================
	// THEMES SEARCH PAGE
	// only if user is admin and is on the right page, we load what we need
	
	if(is_admin() && $hook == $awppt_themes_page ) {	
	
	//CSS
	wp_enqueue_style( 'swpp-styles-css', AWPPT_PLUGIN_URL .'assets/css/styles.css');
	add_thickbox();

	//JS
	wp_enqueue_script( 'bootstrap_awppt', AWPPT_PLUGIN_URL.'assets/js/bootstrap.min.js', array('jquery'), '3.2.0', true);
	wp_enqueue_script( 's_awppt', AWPPT_PLUGIN_URL.'assets/js/s.min.js', false, '3.0.1', true);
	wp_enqueue_script( 'sh_awppt', AWPPT_PLUGIN_URL.'assets/js/s.h.min.js', false,'2.0.1', true);
	wp_enqueue_script( 'hogan_awptt', AWPPT_PLUGIN_URL.'assets/js/hogan.common.js', false, '3.0.0', true);
	wp_enqueue_script( 'checkbox_awppt', AWPPT_PLUGIN_URL . 'assets/js/bootstrap-checkbox.js',false,'1.0.0', true);
	wp_enqueue_script( 'slider_awppt', AWPPT_PLUGIN_URL . 'assets/js/bootstrap-slider.js',false,'1.0.0', true);
	wp_enqueue_script( 'app_awpt', AWPPT_PLUGIN_URL . 'assets/js/awpt.min.js',false,'1.0.1', true);
			
		
	// We pass some variables to the JS app in order to improve results	
	wp_localize_script('app_awpt', 
					   'app_awpt_vars', 
					   array( 
						   'wpversion' =>  get_bloginfo( 'version' )
							, 'last_update_range_facet_tooltip' => _txt_awppt_last_update_range_tooltip 
							, 'rating_facet_tooltip' => _txt_awppt_rating_tooltip
							, 'num_ratings_facet_tooltip' => _txt_awppt_num_ratings_tooltip
							, 'installs_facet_tooltip' => _txt_awppt_installs_tooltip
							)  );		
		
		
	}
	
}



function awppt_get_plugins_installed() {

	//We get the list of plugins installed in order to check against the search so the user can see if 
	//the plugin is already installed directly in the results...
	
	//Un-comment for debugging...
	//print("<pre>".print_r(get_plugins(),true)."</pre>");

		$all_plugins = get_plugins();
		$all_plugins_keys = array_keys($all_plugins);
		
		$plugins = array();
	
		$loopCtr = 0;
		foreach ($all_plugins as $plugin_item) {

			 // Get our Plugin data variables
			 $plugin_root_file   = $all_plugins_keys[$loopCtr];
			$arr = explode("/", $plugin_root_file, 2);
			$plugins[] .= $arr[0];
			
			//Uncomment for debugging if needed
			/*
			$slug = $arr[0];
			$plugin_title       = $plugin_item['Title'];
			$plugin_version     = $plugin_item['Version'];
			$plugin_status      = is_plugin_active($plugin_root_file) ? 'active' : 'inactive';
			echo $loopCtr.'-'.$plugin_root_file .'   -   SLUG  = '. $slug.'<br>';
			*/
		$loopCtr++;
		}
	
	return $plugins;
}



function awppt_subscribe_newsletter() {
	
	$screen = get_current_screen();
	
		if($screen->id == 'appearance_page_addendio-search-themes'){

				// Form for the Themes Newsletter

				$html = '<form action="https://app.mailjet.com/account/tools/widget/subscribe/1zh" target="_blank" class="mailjet-widget-form" id="mailjet-widget-form-6031" accept-charset="utf-8" method="post">      
					<fieldset class="mailjet-widget-list-subscribe-fieldset">
						<p class="mailjet-widjet-paragraph">
							<label for="mailjet-widget-email-field-6031" class="mailjet-widget-email-label" >
								<strong class="sc">Your email address</strong>
								<input type="text" class="mailjet-widget-email-field" name="email" id="mailjet-widget-email-field-6031"  value="" size="20" maxlength="80"  />
							</label>
						</p>
						<input type="submit" id="mailjet-widget-submit-button-6031" class="mailjet-widget-submit-button" value="Subscribe">

					</fieldset>
				</form>';
		} 

		// Form for the Plugins  Newsletter
		if($screen->id == 'plugins_page_addendio-search-plugins'){

			$html = '<form action="https://app.mailjet.com/account/tools/widget/subscribe/1zk" class="mailjet-widget-form" target="_blank" id="mailjet-widget-form-6034" accept-charset="utf-8" method="post">      
	        <fieldset class="mailjet-widget-list-subscribe-fieldset">
	            <p class="mailjet-widjet-paragraph">
	                <label for="mailjet-widget-email-field-6034" class="mailjet-widget-email-label" >
                    	<strong class="sc">Your email address</strong>
	                    <input type="text" class="mailjet-widget-email-field" name="email" id="mailjet-widget-email-field-6034"  value="" size="20" maxlength="80"  />
	                </label>
						</p>
						<input type="submit" id="mailjet-widget-submit-button-6031" class="mailjet-widget-submit-button" value="Subscribe">
					</fieldset>
				</form>';
		} 
	
		return $html;	
}






