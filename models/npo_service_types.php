<?php

defined('ABSPATH') or die("No script kiddies please!");


class model_thehub_npo_service_types {

	static function instance() {
		static $inst = null;
        if (is_null($inst)) {
            $inst = new model_thehub_npo_service_types();
        }
        return $inst;
	}

	/**
	 *
	 */

	static function get_table_name() 
	{
		global $wpdb;
		return $wpdb->prefix."thehub_npo_service_types";
	}

	/**
	 * Create table sql
	 *
	 */

	static function get_create_table()
	{
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name = self::get_table_name();

		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
			id INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
			Service varchar(512) NOT NULL DEFAULT '',
			bActive TINYINT DEFAULT TRUE
			) {$charset_collate};";

		return $sql;
	}

	/**
	 * List of active types
	 */

	static public function get_services()
	{
		global $wpdb;
		return $wpdb->get_results(
			"SELECT 
				id, Service 
			FROM 
				".self::get_table_name()." 
			WHERE 
				bActive = True 
			ORDER BY 
				LOWER(Service)", 
			OBJECT);
	}

	/**
	 * Get by id
	 *
	 * @return object
	 */

	static public function get_by_id($id, $active = True)
	{
		if($id == False)
			return Null;

		global $wpdb;
		return $wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  id = ".$id 
				. ($active?" AND bActive=True ":""), 
				OBJECT);
	}

	/**
	 * Get by id
	 *
	 * @return object
	 */

	static public function get_by_service($service, $active = True)
	{
		if($service == False)
			return Null;

		global $wpdb;
		return $wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  lower(Service) = '".strtolower($service)."' " 
				. ($active?" AND bActive=True ":""), 
				OBJECT);
	}
}

// [eof]