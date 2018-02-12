<?php

/*
  Plugin Name: The Auto Update  
  Plugin URI: http://mynameismisha.com
  Description: This must-use plugin will update your WordPress site automatically. 
  Version: 420 
  Author: Misha Osinovskiy
  Author URI: http://mynameismisha.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */


// Function to Update WordPress 

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

	// Make a note in the head that plugin is loaded  

	add_action('wp_head','header_hook');

	function header_hook() {
		echo '<!-- Auto updates are ON -->';
	}
}

// Run the update function 
updateTheWordPress();

