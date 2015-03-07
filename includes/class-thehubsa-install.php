<?php

if (!defined('ABSPATH')) {
    exit;
}

class TheHubSA_Install
{
    /**
     * Hook in tabs
     */
    public static function init()
    {
        add_action('admin_init', array( __CLASS__, 'check_version'), 5);
    }

    /**
     *
     */
    public static function check_version()
    {
        if (!defined('IFRAME_REQUEST')
            && (get_option('thehubsa_version') != TheHubSA()->version || get_option('thehubsa_db_version') != TheHubSA()->version)) {
            self::install();
            do_action('thehubsa_updated'); // used for unit test
        }
    }

    /**
     *
     */
    public static function install()
    {
        if (!defined('THEHUBSA_INSTALLING')) {
            define('THEHUBSA_INSTALLING', true);
        }

        self::create_tables();
        self::create_fixtures();
        update_option('thehubsa_version', TheHubSA()->version);
        update_option('thehubsa_db_version', TheHubSA()->version);

        do_action('thehubsa_installed');
    }

    /**
     *
     */
    public static function update()
    {
        $current_db=get_option('thehubsa_db_version');

        //+++ do updates here

        //+++
        update_option('thehubsa_db_version', TheHubSA()->version);
    }

    /**
     *
     */
    public static function create_tables()
    {
        global $wpdb;
        $wpdb->hide_errors();

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        foreach(self::get_schema() as $schema) {
            dbDelta($schema);
        }
    }

    /**
     * @return string
     */
    public function get_schema()
    {
        $schema=array(
            model_thehub_membership_types::get_create_table(),
            model_thehub_memberships::get_create_table(),
            model_thehub_npos::get_create_table(),
            model_thehub_npo_service_types::get_create_table(),
            model_thehub_npo_services::get_create_table(),
        );
        return $schema;
    }

    /**
     * Load the fixture data.
     * This will be replaced by the admin crud.
     *
     */
    public function create_fixtures()
    {
        global $wpdb;

        $table_name = model_thehub_membership_types::get_table_name();
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

    		if(empty($found)) {
    			$wpdb->insert($table_name, array('MembershipType'=>$type, 'DisplayOrder'=>$display_order));
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
    			$wpdb->insert($table_name, array('Service'=>$service));
    		} else {
    			// update if exists
    		}
    	}
    }

    /**
     * This is not implemented
     *
     */
    public function drop_tables()
    {
        // pass
    }
}