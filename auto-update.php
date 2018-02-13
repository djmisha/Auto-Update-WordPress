<?php

/*
  Plugin Name: The Auto Update  
  Plugin URI: http://mynameismisha.com
  Description: This plugin will update your WordPress site automatically. 
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
		echo '<!-- Auto updates are ON ◉_◉ Hackers BeWARE  -->';
	}
}

// Run the update function 

updateTheWordPress();


/* Register an Options page under settings  */
/* Register an Options page under settings  */
/* Register an Options page under settings  */

function the_auto_update_register_settings() {
   add_option( 'the_auto_update_option_name', 'This is my option value.');
   register_setting( 'the_auto_update_options_group', 'the_auto_update_option_name', 'the_auto_update_callback' );
}

add_action( 'admin_init', 'the_auto_update_register_settings' );

function the_auto_update_register_options_page() {
  add_options_page('Page Title', 'The Auto Update', 'manage_options', 'the_auto_update', 'the_auto_update_options_page');
}

add_action('admin_menu', 'the_auto_update_register_options_page');

/* Build the Settings Page */
/* Build the Settings Page */
/* Build the Settings Page */

function the_auto_update_options_page() { ?>
  <div class="wrap">
  <?php screen_icon(); ?>
  <h2>The Auto Update Plugin Settings </h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'the_auto_update_options_group' ); ?>
  <h3>Center of Awesome for Kids who don't WordPress update good.</h3>
  <p>More options are coming soon to this page. </p>
  <table>
	  <tr valign="top">
		  <th scope="row"><label for="the_auto_update_option_name">Label</label></th>
	  <td><input type="text" id="the_auto_update_option_name" name="the_auto_update_option_name" value="<?php echo get_option('the_auto_update_option_name'); ?>" /></td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php } ?>
