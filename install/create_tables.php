<?php
defined('ABSPATH') or die("No script kiddies please!");

// format date.version
DEFINE('THEHUBSA_DB_VERSION', 201502080);

/**
 * Setup
 * http://codex.wordpress.org/Creating_Tables_with_Plugins
 */

function thehubsa_install()
{
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	// +++ list the table here

	dbDelta(model_thehub_membership_types::get_create_table());
	dbDelta(model_thehub_memberships::get_create_table());

	dbDelta(model_thehub_npos::get_create_table()); //error_log(model_thehub_npos::get_create_table());
	dbDelta(model_thehub_npo_service_types::get_create_table());
	dbDelta(model_thehub_npo_services::get_create_table());

	//+++ 

	if(get_option('thehubsa_db_version') === False) {
		add_option('thehubsa_db_version', THEHUBSA_DB_VERSION );
	} else {
		update_option('thehubsa_db_version', THEHUBSA_DB_VERSION );
	}
}

/**
 * Used for upgrades
 */

function myplugin_update_db_check() {
    if (get_site_option( 'thehubsa_db_version' ) != THEHUBSA_DB_VERSION ) 
    {
        thehubsa_install();
        thehubsa_install_data();
    }
}


// lets install
