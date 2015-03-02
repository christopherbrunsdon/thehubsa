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
				1 => 'NPO',
				2 => 'NGO',
				3 => 'Business',
				4 => 'Individual',
				5 => 'Volunteer',
				6 => 'Service Club',
				7 => 'Religious Organisation',
				8 => 'Community Service',
				9 => 'Media');

	foreach($types as $display_order=>$type) {
		$found = model_thehub_membership_types::get_by_type($type, False);
// 			var_dump("</pre>", $found, "</pre><hr />");
// echo $found->id;

		if(empty($found)) {
			$wpdb->insert( $table_name, 
				array('MembershipType'=>$type, 'DisplayOrder'=>$display_order));
		} else {
			// update position
			$wpdb->update( $table_name, 
				array('DisplayOrder'=>$display_order),
				array('id'=>$found->id));
		}
	}

	// NPO Services
	// we need to run this once
	$table_name = model_thehub_npo_service_types::get_table_name();
	$services = array(
				'Adult abuse victim support',
				'Adult education',
				'Adult rape victim support',
				'Animal abuse intervention',
				'Child abuse victim support',
				'Child rape victim support',
				'Crisis pregnancy support',
				'ECD education',
				'Environmental projects',
				'Feeding scheme',
				'Food gardens',
				'HIV and AIDS intervention',
				'Literacy scheme',
				'Lost and found animals',
				'Lost and found children/adults',
				'Skills training ',
				'Substance abuse',
				'Support for homeless',
				'Support for new mothers',
				'Support for the disabled',
				'Support for the elderly',
				'Support for the terminal',
				'Tertiary education',
				'Wildlife',
				);

	foreach($services as $service) {
		$found = model_thehub_npo_service_types::get_by_service($service, Null);

		// insert if not found
		if(empty($found)) {
			$wpdb->insert( $table_name, 
				array('Service'=>$service));
		} else {
			// update if exists
		}
	}

}

// lets install
