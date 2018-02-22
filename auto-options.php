<?php 

/*==============================================
 =            Build The Options Page            =
 ==============================================*/
 
 ?>

 <div class="wrap">
 	<?php screen_icon(); ?>
 	<h2>WordPress Auto Update Plugin Information </h2>
 	<p>The plugin is active and running.  There is nothing more to do!  Your WordPress will now update automatically. </p>

 	<form method="POST">
 		<?php settings_fields( 'the_auto_update_options_group' ); ?>
 		<table>
 			<tr valign="top">
 				<th scope="row">
 					<label for="the_auto_update_option_name_on_switch">Turn Updates ON</label>
 				</th>
 				<td>
 					<input type="checkbox" id="the_auto_update_option_name_on_switch" name="the_auto_update_option_name_on_switch" value="<?php echo get_option('the_auto_update_option_name_on_switch'); ?>" />
 				</td>
 			</tr>
 		</table>
 		<label for="awesome_text">Awesome Text</label>
 		    <input type="text" name="awesome_text" id="awesome_text" value="<?php echo $value; ?>">
 		    <input type="submit" value="Save" class="button button-primary button-large">
 	</form>
 </div>

 <?php 

/*=======================================
=            Show All Plugis            =
=======================================*/

// How Available Plugin Updates
$update_data = wp_get_update_data();
echo '<h3>';
echo $update_data['counts']['plugins'] . ' updates available. ';
echo '</h3>';

// List of All Install Plugins 
$all_plugins = get_plugins();
echo '<h2>Currently Installed Plugins</h2>';

foreach ($all_plugins as $oneplugin ) {
	echo '<div class="plugin-list">';
	echo '<span>' . $oneplugin[Name] . '</span> ';
	echo '<span>' . $oneplugin[Version] . '</span>' ;
	echo '</div>';
}

// Final Save Button at the Bottom 

echo submit_button();
