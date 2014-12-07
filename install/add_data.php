<?php

/**
 * Setup
 * http://codex.wordpress.org/Creating_Tables_with_Plugins
 */

function thehubsa_install_data()
{
	global $wpdb;
	
	$welcome_name = 'Mr. WordPres';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	// we need to run this once
	$table_name = model_thehub_membership_types::get_table_name(); //$wpdb->prefix . 'thehub_membership_types';
	$types = array(
				'NPO',
				'NGO',
				'Business',
				'Individual',
				'Volunteer',
				'Service Club',
				'Religious Organisation',
				'Community Service');

	foreach($types as $type) {
		$found = model_thehub_membership_types::get_by_type($type, False);
		if(empty($found)) {
			$wpdb->insert( $table_name, array('MembershipType'=> $type));
		}
	}
}

// lets install
