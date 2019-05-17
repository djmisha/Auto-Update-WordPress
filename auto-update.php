<?php

/*
  Plugin Name: The Auto Update for WordPress  
  Plugin URI: https://github.com/djmisha/the-auto-update
  Description: This plugin will update your WordPress core, themes and plugins automatically.
  Version: 420
  Author: Misha Osinovskiy
  Author URI: https://mynameismisha.com
  Disclaimer: Use this plugin at your own risk and be sure to regularly backup WordPress content files and database. 
 */



if ( !defined('ABSPATH') )
	die ( 'YOU SHALL NOT PASS!' );


define( 'AUTO_UPDATE_PATH', plugin_dir_path(__FILE__) );
define( 'AUTO_UPDATE_URL', plugin_dir_url(__FILE__) );
define( 'AUTO_UPDATE_BASE', plugin_basename( __FILE__ ) );
define( 'AUTO_UPDATE_VERSION', '420' );


/*==========================================================================
=            Create a Link to Settings Page on the Plugin List Page        =
==========================================================================*/

function plugin_add_settings_link( $links ) {

    $settings_link = '<a href="options-general.php?page=the_auto_update">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}

$plugin = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );


/*=====================================================
=            The Main Function to Update WordPress    =
=====================================================*/

function updateTheWordPress() {

	// Enable WordPress Core - major updates
	add_filter( 'allow_major_auto_core_updates', '__return_true' );         

	// Enable WordPress Core - minor updates
	add_filter( 'allow_minor_auto_core_updates', '__return_true' );         

	// Enable WordPress Core - development updates 
	add_filter( 'allow_dev_auto_core_updates', '__return_true' );  

	// Auto Update All Plugins 
	add_filter( 'auto_update_plugin', '__return_true' );

	// Auto Update All Themes 
	add_filter( 'auto_update_theme', '__return_true' );

	// Victory, our site is updating, lets note in the head 
	add_action('wp_head','header_hook');

	function header_hook() {
		echo '<!-- Auto WordPress updates are on! -->';
	}
}

updateTheWordPress();


/*================================================================
=            Register an Options Page Admin > Setting            =
================================================================*/

function the_auto_update_register_options_page() {
	add_menu_page(
		'WP Auto Update', 
		'WP Auto Update', 
		'manage_options', 
		'the_auto_update', 
		'the_auto_update_options_page'
	);
}

add_action('admin_menu', 'the_auto_update_register_options_page');


/*==========================================
=            Call Options Page             =
==========================================*/

function the_auto_update_options_page() {

	include 'auto-options.php';

}



// Run update checker code

if ( file_exists(dirname(__FILE__) . '/plugin-update-checker/plugin-update-checker.php') ) {

	if ( !class_exists('Puc_v4_Factory') ) {
		require 'plugin-update-checker/plugin-update-checker.php';
	}

	if ( class_exists('Puc_v4_Factory') ) {
		$autoUpdatePluginChecker = Puc_v4_Factory::buildUpdateChecker(
		    'http://plugins.rosemontmedia.com/wp-update-server/?action=get_metadata&slug=the-auto-update',
		    __FILE__,
		    'the-auto-update',
		    24
		);
	}

}
