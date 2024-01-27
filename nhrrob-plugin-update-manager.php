<?php
/*
Plugin Name: NHR Plugin Update Manager
Plugin URI: http://wordpress.org/plugins/nhrrob-plugin-update-manager/
Description: Getting too many updates from plugins? Well, say no to unnecessary frequent updates. Get updates whenever you want (e.x. once monthly) and Enjoy!
Author: Nazmul Hasan Robin
Version: 1.0.0
Author URI: https://nazmulrobin.com
*/

// Make sure we don't expose any info if called directly
if ( ! function_exists('add_action') ) {
	echo 'Access Denied!';
	exit;
}

define('NHRROB_PLUGIN_UPDATE_MANAGER_VERSION', '1.0.0');
define('NHRROB_PLUGIN_UPDATE_MANAGER_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('NHRROB_PLUGIN_UPDATE_MANAGER_FILE', __FILE__);
define('NHRROB_PLUGIN_UPDATE_MANAGER_URL', plugins_url('', NHRROB_PLUGIN_UPDATE_MANAGER_FILE));
define('NHRROB_PLUGIN_UPDATE_MANAGER_ASSETS', NHRROB_PLUGIN_UPDATE_MANAGER_URL . '/assets');

function nhrrob_plugin_update_manager(){
    global $pagenow;

    $current_date = current_time('Y-m-d');
    $day_of_month = date('j', strtotime($current_date));

    $allowed_days = apply_filters('nhrrob_plugin_update_manager/allowed_days', 7);

    if ($day_of_month > intval( $allowed_days )) {
        wp_register_style( 'nhrrob-plugin-update-manager-style', NHRROB_PLUGIN_UPDATE_MANAGER_ASSETS . '/css/style.css' );
        wp_register_style( 'nhrrob-plugin-update-manager-global-style', NHRROB_PLUGIN_UPDATE_MANAGER_ASSETS . '/css/global.css' );
        
        wp_enqueue_style('nhrrob-plugin-update-manager-global-style');
        if ($pagenow === 'plugins.php') { 
            wp_enqueue_style('nhrrob-plugin-update-manager-style');
        }
    }
}

add_action('admin_enqueue_scripts', 'nhrrob_plugin_update_manager');