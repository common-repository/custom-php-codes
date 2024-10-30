<?php
/*
Plugin Name:  Custom PHP Codes
Description:  This plugin helps you to insert custom PHP Code in Posts, Pages & Widgets.
Plugin URI:   https://wordpress.org/plugins/custom-php-codes
Author:       SPcits - spcits.com
Author URI:   http://spcits.com
Version:      1.0
Text Domain:  customphpcode
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

function create_customphpcode_database_table() {
 global $wpdb;
 $table_name = $wpdb->prefix . 'customphpcode';
 $sql = "CREATE TABLE IF NOT EXISTS $table_name (
	 `sno` INT NOT NULL AUTO_INCREMENT ,
	 `query` TEXT NOT NULL ,
	 `query_insert_time` TEXT NOT NULL ,
	 `allowed` TEXT NOT NULL,
	 PRIMARY KEY (`sno`));";
$results = $wpdb->query($sql);
$custom_options = customphpcode_options_default();
add_option('customphpcode_options',$custom_options);
}

function customphpcode_options_default() {

	return array(
		'custom_spcitsphpcode'   => '1',
		'custom_spcitsphpsave'   => '1',
	);

}

register_activation_hook( __FILE__, 'create_customphpcode_database_table' );


if(is_admin()) {
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callback.php';
  require_once plugin_dir_path( __FILE__ ) . 'admin/custom-php-codes-class.php';
  require_once plugin_dir_path( __FILE__ ) . 'admin/spcits-plugin-class.php';
	add_action( 'plugins_loaded', function () {
		spcits_Plugin::get_instance();
	} );
}

require_once plugin_dir_path( __FILE__ ) . 'public/front_end_execute.php';
