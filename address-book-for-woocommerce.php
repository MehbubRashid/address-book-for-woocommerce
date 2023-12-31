<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/MehbubRashid
 * @since             1.0.0
 * @package           Address_Book_For_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Address Book for WooCommerce
 * Plugin URI:        https://github.com/MehbubRashid
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mehbub Rashid
 * Author URI:        https://github.com/MehbubRashid
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       address-book-for-woocommerce
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
define( 'ABFW_VERSION', '1.0.0' );

/**
 * Define plugin path and plugin url.
 */
define( 'ABFW_PATH', plugin_dir_path( __FILE__ ) );
define( 'ABFW_URL', plugin_dir_url( __FILE__ ) );
define( 'ABFW_ASSETS_URL', plugin_dir_url( __FILE__ ) . 'assets/' );
define( 'ABFW_ASSETS_VERSION', time() );

/**
 * The code that runs during plugin activation.
 */
function abfw_activate() {
	
}

/**
 * The code that runs during plugin deactivation.
 */
function abfw_deactivate() {
	
}

register_activation_hook( __FILE__, 'abfw_activate' );
register_deactivation_hook( __FILE__, 'abfw_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function abfw_run() {

	$plugin = new Abfw_Plugin();

}
abfw_run();
