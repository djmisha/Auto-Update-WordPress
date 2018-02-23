<?php 

/*==============================================
 =            Build The Options Page            =
 ==============================================*/
 
 ?>

 <div class="wrap">
 	<?php screen_icon(); ?>
 	<h2>WordPress Auto Update Plugin Information </h2>
 	<p>Your WordPress will now update automatically if the ON option below is checked.. </p>

 	<form method="POST">
 		<?php settings_fields( 'the_auto_update_options_group' ); ?>
 		
 		<label for="on_switch">Turn Updates ON</label>
 		    <input type="input" name="on_switch" id="on_switch" value="<?php echo($on_switch); ?>"
			
			<?php if($on_switch == 'checked') {echo $on_switch;}  ?>

 		     >
 		    <br>
 		    <br>
 		    <input type="submit" value="Save" class="button button-primary button-large">
 	</form>
 </div>

 <?php 

/*=======================================
=            Show All Plugis            =
=======================================*/

// How Available Plugin Updates
$update_data = wp_get_update_data();
echo '<h2>';
echo $update_data['counts']['plugins'] . ' updates available. ';
echo '</h2>';

// List of All Install Plugins 
$all_plugins = get_plugins();
echo '<h2>Installed Plugins</h2>';

foreach ($all_plugins as $oneplugin ) {
	echo '<div class="plugin-list">';
	echo '<span>' . $oneplugin[Name] . '</span> ';
	echo '<span>' . $oneplugin[Version] . '</span>' ;
	echo '</div>';
}

// Final Save Button at the Bottom 

echo submit_button();
