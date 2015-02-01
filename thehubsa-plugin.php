<?php

defined('ABSPATH') or die("No script kiddies please!");

/*
Plugin Name: TheHubSA.org.za
Plugin URI: http://www.thehubsa.org.za
Description: Custom Wordpress Plugin for TheHubSA.org.za
Version: 1.01
Author: Christopher Brunsdon
Author URI: http://www.brunsdon.co.za
*/

// +++ models

require_once('models/membership_types.php');
require_once('models/memberships.php');
require_once('models/npo_service_types.php');
require_once('models/npo_services.php');
require_once('models/npos.php');

// +++ forms

require_once('forms/form-join.php');
require_once('forms/form-npo.php');

// +++ database

require_once('install/add_data.php');
require_once('install/create_tables.php');

register_activation_hook( __FILE__, 'thehubsa_install' );
register_activation_hook( __FILE__, 'thehubsa_install_data' );
add_action( 'plugins_loaded', 'myplugin_update_db_check' );

// +++ admin page

require_once('admin/admin.php');

// [eof]
