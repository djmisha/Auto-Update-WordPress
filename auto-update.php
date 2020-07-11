<?php

/*
  Plugin Name: Auto Update WordPress
  Plugin URI: https://github.com/djmisha/the-auto-update
  Description: This plugin updates your WordPress core, themes and plugins automatically.
  Version: 420
  Author: Misha Osinovskiy
  Author URI: https://mynameismisha.com
  Disclaimer: Use at your own risk. Always be be sure to regularly backup WordPress /wp-contents/ folder and the my SQL database.
 */


if (!defined('ABSPATH')) {
    die('YOU SHALL NOT PASS!');
}

/* Define Path Variables */

define('AUTO_UPDATE_PATH', plugin_dir_path(__FILE__));
define('AUTO_UPDATE_URL', plugin_dir_url(__FILE__));
define('AUTO_UPDATE_BASE', plugin_basename(__FILE__));
define('AUTO_UPDATE_VERSION', '420');


class AUTO_Update
{

    // Instance of this class
    public static $instance	= false;

    // Plugin Slug
    public static $plugin_slug = "auto-update";

    // Plugin data
    public static $plugin_data = null;

    // The data that will be echoed out in the head

    private $payload 	= array();

    public function __construct()
    {
        add_action('plugins_loaded', array( $this, 'plugin_init'));

        // add_action( 'admin_notices', array( $this, 'data_notifications') );
    }


    /**
     * Singleton
     *
     * @return A single instance of the current class.
     */

    public static function singleton()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function plugin_init()
    {
        // add_action('plugin/init', array( $this, 'add_our_files' ));

        // add_action('admin_notices', array( $this, 'plguin_is_active_notice' ), 22);
    }


    public function add_our_files()
    {
        if (is_admin()) {
            if (file_exists(AUTO_UPDATE_PATH .'auto-options.php')) {
                include_once AUTO_UPDATE_PATH .'auto-options.php';
                AUTO_Update_Options::singleton();
            }
        }
    }

    public function plguin_is_active_notice()
    {
        if (is_plugin_active('the-auto-update/auto-update.php')) { ?>

			<div class="notice notice-success is-dismissible"">
				<p>You are automatically upgrading WordPress.  </p>
				<button type="button" class="notice-dismiss">
					<span class="screen-reader-text">Dismiss this notice.</span>
				</button>
			</div>

			<?php
        }
    }
}


// Initiate our foundation class
AUTO_Update::singleton();



/*==========================================================================
=            Create a Link to Settings Page on the Plugin List Page        =
==========================================================================*/

function plugin_add_settings_link($links)
{
    $settings_link = '<a href="options-general.php?page=the_auto_update">' . __('Settings') . '</a>';
    array_push($links, $settings_link);
    return $links;
}

$plugin = plugin_basename(__FILE__);

add_filter("plugin_action_links_$plugin", 'plugin_add_settings_link');


/*=====================================================
=            The Main Function to Update WordPress    =
=====================================================*/

function updateTheWordPress()
{

    // Enable WordPress Core - major updates
    add_filter('allow_major_auto_core_updates', '__return_true');

    // Enable WordPress Core - minor updates
    add_filter('allow_minor_auto_core_updates', '__return_true');

    // Enable WordPress Core - development updates
    add_filter('allow_dev_auto_core_updates', '__return_true');

    // Auto Update All Plugins
    add_filter('auto_update_plugin', '__return_true');

    // Auto Update All Themes
    add_filter('auto_update_theme', '__return_true');

    // Victory, our site is updating, lets note in the head
    add_action('wp_head', 'header_hook');

    function header_hook()
    {
        echo '<!-- Auto WordPress updates are on! -->';
    }
}

updateTheWordPress();


/* Register Options Page */

function the_auto_update_register_options_page()
{
    // Register Submenu Item under 'Tools'
    add_submenu_page(
        'tools.php',
        'Auto Update',
        'Auto Update',
        'manage_options',
        'the_auto_update',
        'the_auto_update_options_page'
    );
    
    // Include File to page
    function the_auto_update_options_page()
    {
        include 'auto-options.php';
    }
}

add_action('admin_menu', 'the_auto_update_register_options_page');



/*==========================================
=            Call Options Page             =
==========================================*/




// Run update checker code

if (file_exists(dirname(__FILE__) . '/plugin-update-checker/plugin-update-checker.php')) {
    if (!class_exists('Puc_v4_Factory')) {
        require 'plugin-update-checker/plugin-update-checker.php';
    }

    if (class_exists('Puc_v4_Factory')) {
        $autoUpdatePluginChecker = Puc_v4_Factory::buildUpdateChecker(
            'http://plugins.rosemontmedia.com/wp-update-server/?action=get_metadata&slug=the-auto-update',
            __FILE__,
            'the-auto-update',
            24
        );
    }
}
