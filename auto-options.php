<?php 



if ( !defined('ABSPATH') )
	die ( 'YOU SHALL NOT PASS!' );


class AUTO_Update_Options { 
	// Class will go here 
}

/*==============================================
 =            Build The Options Page            =
 ==============================================*/
 
$wp_url 			= get_bloginfo('url');
$wp_version 		= get_bloginfo('version');
$wp_template_url 	= get_bloginfo('template_url');
$update_data 		= wp_get_update_data();

?>

 <div class="wrap">
 	<table class="wp-list-table widefat fixed">
 		<th>
		 	<h1>WordPress Auto Update Plugin Settings </h1>
		 	<p>Your WordPress will now update automatically. There is nothing more else todo. </p>
 		</th>
 		<tr>
 			<td>

				<h2>There are <?php echo $update_data['counts']['plugins']; ?> updates available</h2>
				<h3>Site Details</h3>
				<span>Website: <?php echo $wp_url ?></span><br>
				<span>WordPress Core Version: <?php echo $wp_version; ?></span><br>
				<span>Active Theme Directory: <?php echo $wp_template_url; ?></span><br>
				

				<?php 


				// List of Pnstalled Plugins and Their versions  

				$all_plugins = get_plugins();
				echo '<h3>Installed Plugins:</h3>';

				foreach ($all_plugins as $oneplugin ) {
					echo '<div class="plugin-list">';
					echo '<span><strong>' . $oneplugin['Name'] . '</strong></span>: ';
					echo '<span> Version ' . $oneplugin['Version'] . '</span>' ;
					echo '</div>';
				}

				?>

 			</td>
 		</tr>
 	</table>
</div>