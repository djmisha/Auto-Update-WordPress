<?php

/*
  Plugin Name: The Auto Update  
  Plugin URI: http://mynameismisha.com
  Description: This plugin will update your WordPress site automatically.   
  Version: 420 
  Author: Misha Osinovskiy
  Author URI: http://mynameismisha.com
  Disclaimer: Use at your own risk and backup early and often. 
 */


/*=====================================================
=            Function to Update WordPress             =
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

	// Victory, our site is updating 
	add_action('wp_head','header_hook');

	function header_hook() {
		echo '<!-- Auto WordPress updates are on! -->';
	}
}

updateTheWordPress();


/*================================================================
=            Register an Options Page Admin > Setting            =
================================================================*/


function the_auto_update_register_settings() {
	// you can add more options like this
	add_option( 'the_auto_update_option_name', 'This is my option value.');

	register_setting( 
		'the_auto_update_options_group', 
		'the_auto_update_option_name', 
		'the_auto_update_callback'
	 );
}

add_action( 'admin_init', 'the_auto_update_register_settings' );

function the_auto_update_register_options_page() {
  	add_options_page(
		'The Auto Update', 
		'The Auto Update', 
		'manage_options', 
		'the_auto_update', 
		'the_auto_update_options_page'
	);
}

add_action('admin_menu', 'the_auto_update_register_options_page');


 /*===============================================
 =            Build the Settings Page            =
 ===============================================*/

	function the_auto_update_options_page() { ?>
	  <div class="wrap">
	  <?php screen_icon(); ?>
	  <h2>The Auto Update Plugin Information </h2>
	  <p>The plugin is active and running.  There is nothing more to do!  Your WordPress will now update automatically. </p>

	  <form method="post" action="options.php">
	  <?php settings_fields( 'the_auto_update_options_group' ); ?>
	  	<table>
		<tr valign="top">
		<th scope="row"><label for="the_auto_update_option_name">Do you love this plugin? </label></th>
		 <td><input type="checkbox" id="the_auto_update_option_name" name="the_auto_update_option_name" value="<?php echo get_option('the_auto_update_option_name'); ?>" /></td>
	 	 </tr>
		  </table>
	  	<?php //submit_button(); ?>
	  	</form>
	</div>



<?php 

/*=======================================
=            Show All Plugis            =
=======================================*/

	// How Available Plugin Updates
	$update_data = wp_get_update_data();
	echo '<h3>';
	echo $update_data['counts']['plugins'] . ' updates available and updating soon. ';
	echo '</h3>';

	// List of All Install Plugins 
	$all_plugins = get_plugins();
	echo '<h2>Installed Plugins</h2>';

	foreach ($all_plugins as $oneplugin ) {
		echo '<div class="plugin-list">';
	    	echo '<span>' . $oneplugin[Name] . '</span> ';
	    	echo '<span>' . $oneplugin[Version] . '</span>' ;
		echo '</div>';
	}
}