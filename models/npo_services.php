<?php

defined('ABSPATH') or die("No script kiddies please!");

require_once("model_abstract.php");


class model_thehub_npo_services  extends model_abstract  {

	CONST NUMBER_PER_NPO = 5; // set the number per NPO here

	public
        $fkNpo = Null,
		$fkService = Null,
		$ServiceOther = Null,
		$RankOrder = Null,
		$Notes = Null;

    /**
     * @return model_thehub_npo_services
     */
	static function instance() {
		static $inst = null;
        if (is_null($inst)) {
            $inst = new model_thehub_npo_services();
        }
        return $inst;
	}

    /**
     *
     */
	function __toString()
	{
		
	}

    /**
     * @return string
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

    /**
     * @return bool
     */
    public function validate()
    {
        $this->validation_errors = array();

        $sanitize_rules = array(
                'fkService'=> array(
                        'filter' => FILTER_SANITIZE_STRING,
                        'flags' => FILTER_SANITIZE_STRIPPED,
                        'options' => array('default' => Null),
                    ),
                'ServiceOther'=>array(
                        'filter' => FILTER_SANITIZE_STRING,
                        'flags' => FILTER_SANITIZE_STRIPPED,
                        'options' => array('default' => Null),
                ),
        );

        $this->set_data(filter_var_array(get_object_vars($this), $sanitize_rules));

        if($this->fkService) {
            //pass
        }
        if($this->ServiceOther){
            //pass
        }
        return empty($this->validation_errors);
    }

    /**
     * @param $fkNpo
     */
    static function delete_by_npo($fkNpo)
    {
        global $wpdb;
        $wpdb->insert(self::get_table_name(), $fields, $field_meta);
    }

    /**
     * Save
     */
	public function save()
	{
		global $wpdb;

		$fields = array(
					'fkNpo' 		=> $this->fkNpo,
					// 'fkService' 	=> $this->_id_service,
					'ServiceOther' 	=> $this->ServiceOther,
					'RankOrder' 	=> $this->RankOrder,
					'Notes' 		=> $this->Notes,
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

		if($this->fkService) {
			$fields['fkService']= $this->fkService;
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