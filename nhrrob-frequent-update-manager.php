<?php
/**
 * Plugin Name: NHR Frequent Update Manager
 * Plugin URI: http://wordpress.org/plugins/nhrrob-frequent-update-manager/
 * Description: Getting too many updates from plugins? Well, say no to unnecessary frequent updates. Get updates whenever you want (e.x. once monthly) and Enjoy!
 * Author: Nazmul Hasan Robin
 * Author URI: https://profiles.wordpress.org/nhrrob/
 * Version: 1.0.4
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Text Domain: nhrrob-frequent-update-manager
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('NHRROB_FREQUENT_UPDATE_MANAGER_VERSION', '1.0.4');
define('NHRROB_FREQUENT_UPDATE_MANAGER_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('NHRROB_FREQUENT_UPDATE_MANAGER_FILE', __FILE__);
define('NHRROB_FREQUENT_UPDATE_MANAGER_PATH', __DIR__);
define('NHRROB_FREQUENT_UPDATE_MANAGER_URL', plugins_url('', NHRROB_FREQUENT_UPDATE_MANAGER_FILE));
define('NHRROB_FREQUENT_UPDATE_MANAGER_ASSETS', NHRROB_FREQUENT_UPDATE_MANAGER_URL . '/assets');

function nhrrob_frequent_update_manager_init(){
    global $pagenow;

    $current_date = current_time('Y-m-d');
    $day_of_month = gmdate('j', strtotime($current_date));

    $allowed_days = apply_filters('nhrrob_frequent_update_manager/allowed_days', 7);

    if ($day_of_month > intval( $allowed_days )) {
        wp_register_style( 'nhrrob-frequent-update-manager-style', NHRROB_FREQUENT_UPDATE_MANAGER_ASSETS . '/css/style.css', array(), filemtime( NHRROB_FREQUENT_UPDATE_MANAGER_PATH . '/assets/css/style.css' ) );
        wp_register_style( 'nhrrob-frequent-update-manager-global-style', NHRROB_FREQUENT_UPDATE_MANAGER_ASSETS . '/css/global.css', array(), filemtime( NHRROB_FREQUENT_UPDATE_MANAGER_PATH . '/assets/css/global.css' ) );
        
        wp_enqueue_style('nhrrob-frequent-update-manager-global-style');
        if ($pagenow === 'plugins.php') { 
            wp_enqueue_style('nhrrob-frequent-update-manager-style');
        }
    }
}

add_action('admin_enqueue_scripts', 'nhrrob_frequent_update_manager_init');