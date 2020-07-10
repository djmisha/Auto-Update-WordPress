<?php 


if ( !defined('ABSPATH') )
	die ( 'YOU SHALL NOT PASS!' );


class AUTO_Update_Options { 
	// Options class will go here 
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
	<h1>WordPress Auto Update Plugin Settings </h1>
 	<table class="wp-list-table widefat fixed">
 		<th>
			<p>Your WordPress will now update automatically. There is nothing else todo here. Check out information about your website below. </p>
 		</th>
 		<tr>
 			<td>
				<h2>There are <?php echo $update_data['counts']['plugins']; ?> updates available</h2>
				<h3>Site Details</h3>
				<span>Website: <?php echo $wp_url ?></span><br />
				<span>WordPress Core Version: <?php echo $wp_version; ?></span><br />
				<span>Active Theme Directory: <?php echo $wp_template_url; ?></span><br />

				<?php 

				// List of Pnstalled Plugins and Their versions  

				$all_plugins = get_plugins();
				echo '<h3>Installed Plugins:</h3>';

				foreach ($all_plugins as $oneplugin ) {
					echo '<div class="plugin-list">';
					echo '<span><strong>' . $oneplugin['Name'] . '</strong></span>: ';
					echo '<span> | Version: ' . $oneplugin['Version'] . '</span>' ;
					echo '<span> | Author: ' . $oneplugin['Author'] . '</span>' ;
					echo '<span> | Description: ' . $oneplugin['Description'] . '</span>' ;
					echo '<span> | Website: <a href="' . $oneplugin['AuthorURI'] . '">' . $oneplugin['AuthorURI'] . '</a></span>' ;
					echo '</div>';
				}

				?>

 			</td>
 		</tr>
 	</table>
	<br>
 	<p>If you like this plugin and would like to contribute, pull requests are welcome here:
 	<a href="https://github.com/djmisha/the-auto-update">https://github.com/djmisha/the-auto-update</a>	
 	</p>
</div>