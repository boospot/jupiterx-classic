<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://booskills.com/rao
 * @since             1.0.0
 * @package           Jupiterx_Classic
 *
 * @wordpress-plugin
 * Plugin Name:       JupiterX Classic
 * Plugin URI:        https://github.com/boospot/jupiterx-classic
 * Description:       This plugin adds the lost Custom Post Types when migrated from jupiter 6.x to JupiterX
 * Version:           1.1.1
 * Author:            Rao | BooSpot
 * Author URI:        https://boospot.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jupiterx-classic
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'JUPITERX_CLASSIC_VERSION', '1.1.0' );

define( 'JUPITERX_CLASSIC_NAME', 'jupiterx-classic' );

define( 'JUPITERX_CLASSIC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'JUPITERX_CLASSIC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jupiterx-classic-activator.php
 */
function activate_jupiterx_classic() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jupiterx-classic-activator.php';
	Jupiterx_Classic_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jupiterx-classic-deactivator.php
 */
function deactivate_jupiterx_classic() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jupiterx-classic-deactivator.php';
	Jupiterx_Classic_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jupiterx_classic' );
register_deactivation_hook( __FILE__, 'deactivate_jupiterx_classic' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jupiterx-classic.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jupiterx_classic() {

	$plugin = new Jupiterx_Classic();
	$plugin->run();

}

run_jupiterx_classic();
