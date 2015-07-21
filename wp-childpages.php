<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://onedge.be
 * @since             1.0.0
 * @package           Wp_Subpages
 *
 * @wordpress-plugin
 * Plugin Name:       Child pages
 * Plugin URI:        onedge.be/plugins/wp-childpages
 * Description:       Displays the childpages of the page you're currently on.
 * Version:           1.1
 * Author:            Jan Henckens
 * Author URI:        http://onedge.be
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-childpages
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-childpages-activator.php
 */
function activate_wp_subpages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-childpages-activator.php';
	Wp_Subpages_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-childpages-deactivator.php
 */
function deactivate_wp_subpages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-childpages-deactivator.php';
	Wp_Subpages_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_subpages' );
register_deactivation_hook( __FILE__, 'deactivate_wp_subpages' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-childpages.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_subpages() {

	$plugin = new Wp_Subpages();
	$plugin->run();

}
run_wp_subpages();
