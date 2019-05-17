<?php 

/*==============================================
 =            Build The Options Page            =
 ==============================================*/
 
 ?>

 <div class="wrap">
 	<?php screen_icon(); ?>
 	<h1>WordPress Auto Update Plugin Settings </h1>
 	<p>Your WordPress will now update automatically. There is nothing more else todo. </p>
	
	<h2>Site Details</h2>
	<strong>Website: <?php get_bloginfo('url'); ?></strong><br>
	<strong>WordPress Version: <?php get_bloginfo('version'); ?></strong><br>
	<strong>Theme Directory: <?php get_bloginfo('template_url'); ?></strong><br>
	
<?php 

/*=======================================
=            Show All Plugins           =
=======================================*/

// How Available Plugin Updates
$update_data = wp_get_update_data();
echo '<h2>';
echo $update_data['counts']['plugins'] . ' updates available. ';
echo '</h2>';

// List of All Install Plugins 
$all_plugins = get_plugins();
echo '<h2>Installed Plugins:</h2>';

foreach ($all_plugins as $oneplugin ) {
	echo '<div class="plugin-list">';
	echo '<span><strong>' . $oneplugin['Name'] . '</strong></span> | ';
	echo '<span>  ' . $oneplugin['Version'] . '</span>' ;
	echo '</div>';
}


?>

</div>