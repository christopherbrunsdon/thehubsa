<?php

defined('ABSPATH') or die("No script kiddies please!");


class model_thehub_npo_services {

	CONST NUMBER_PER_NPO = 5; // set the number per NPO here

	public
		$_id_npo = Null,
		$_id_service = Null,
		$_service_other = Null,
		$_rank_order = Null,
		$_notes = Null;


	static function instance() {
		static $inst = null;
        if (is_null($inst)) {
            $inst = new model_thehub_npo_services();
        }
        return $inst;
	}


	function __toString()
	{
		
	}

	/**
	 *
	 */

	static function get_table_name() 
	{
		global $wpdb;
		return $wpdb->prefix."thehub_npo_services";
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

		$fk_npo = model_thehub_npos::get_table_name();
		$fk_services = model_thehub_npo_service_types::get_table_name();


		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
			fkNpo     INT NOT NULL,
			fkService INT DEFAULT NULL,	
			ServiceOther varchar(128) NOT NULL DEFAULT '',
			RankOrder mediumint(9) ,					

			bActive   	TINYINT DEFAULT TRUE,
			Notes 		varchar(1024) DEFAULT '',
			WhenCreated TIMESTAMP DEFAULT 0,
			WhenUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		                ON UPDATE CURRENT_TIMESTAMP,

			FOREIGN KEY (fkNpo)
				REFERENCES {$fk_npo}(id),

			FOREIGN KEY (fkService)
				REFERENCES {$fk_services}(id)
				ON DELETE SET NULL			

			) {$charset_collate};";

		return $sql;
	}

	
	public function set_data($data)
	{
		if(!is_array($data)) {
			return $this->set_data(array());
		}

		$this->_id_npo			= array_key_exists('fkNpo', $data) ? $data['fkNpo'] : Null;
		$this->_id_service		= array_key_exists('fkService', $data) && is_numeric($data['fkService']) ? $data['fkService'] : Null;
		$this->_service_other	= array_key_exists('ServiceOther', $data) ? $data['ServiceOther'] : Null;
		$this->_rank_order		= array_key_exists('RankOrder', $data) ? $data['RankOrder'] : Null;
	}


	public function save()
	{
		global $wpdb;

		$fields = array(
					'fkNpo' 		=> $this->_id_npo,
					// 'fkService' 	=> $this->_id_service,
					'ServiceOther' 	=> $this->_service_other,
					'RankOrder' 	=> $this->_rank_order,
					'Notes' 		=> $this->_notes,
					'WhenCreated' 	=> date("Y-m-d H:i"), // now()     
					);

		$field_meta = array(
					'%d', // 'fkNpo' 
					// '%d', // 'fkService' 
					'%s', // 'ServiceOther' 
					'%d', // 'RankOrder' 
					'%s', // 'Notes' 
					'%s', // 'WhenCreated' 
					);

		if($this->_id_service) {
			$fields['fkService']= $this->_id_service;
			$field_meta[] = '%d';
		}
			
		$wpdb->insert(self::get_table_name(), $fields, $field_meta);
	}


	/**
	 * List of active types
	 * do inner join here
	 */

	static public function get_types()
	{
		global $wpdb;
		return $wpdb->get_results(
			"SELECT 
				fkNpo, fkService 
			FROM 
				".self::get_table_name()." 
			WHERE 
				bActive = True 
			ORDER BY 
				DisplayOrder, id", 
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

	static public function get_by_type($type, $active = True)
	{
		if($type == False)
			return Null;

		global $wpdb;
		return $wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  lower(MembershipType) = '".strtolower($type)."' " 
				. ($active?" AND bActive=True ":""), 
				OBJECT);
	}

	/**
	 * Get by NPO
	 *
	 * @return object
	 */

	static public function get_by_npo($fkNpo, $active = True)
	{
		if($fkNpo == False)
			return Null;

		global $wpdb;
		$sql="SELECT COALESCE(Service, ServiceOther) as Service FROM "
				.self::get_table_name()." as ns "
				." LEFT JOIN "
				.model_thehub_npo_service_types::get_table_name()." as nst "
				." ON (ns.fkService = nst.id )"
				." WHERE  fkNpo = ".$fkNpo 
				." ORDER BY RankOrder ";
		// error_log($sql);
		return $wpdb->get_results($sql, OBJECT);
	}

}

// [eof]