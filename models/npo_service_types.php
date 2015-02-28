<?php

//defined('ABSPATH') or die("No script kiddies please!");


class model_thehub_npo_service_types extends model_abstract {

    public
        $id=Null,
        $Service = Null,
        $bActive=Null;

    /**
     * @return model_thehub_npo_service_types
     */
	static function instance()
    {
		static $inst = null;
        if (is_null($inst)) {
            $inst = new model_thehub_npo_service_types();
        }
        return $inst;
	}

    /**
     *
     */
    public function __construct($data = Null)
    {
        $this->set_data($data);
    }

    /**
     * @return string
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
			bActive TINYINT DEFAULT TRUE,
			WhenCreated TIMESTAMP DEFAULT 0,
			WhenUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			) {$charset_collate};";

		return $sql;
	}

    /**
     * @return mixed
     */
    static function get_table_stats()
    {
        global $wpdb;

        $query = "SELECT COUNT(*) as count_all,
				SUM(CASE WHEN bActive THEN 1 ELSE 0 END) AS count_active,
				SUM(CASE WHEN NOT bActive THEN 1 ELSE 0 END) AS count_deactive
				FROM ".self::get_table_name();

        return $wpdb->get_row($query);
    }

    /**
     *
     */
    public function sanitize()
    {
        // sanitize
        $sanitize_rules = array(
            "id" =>
                array(
                    'filter' => FILTER_SANITIZE_NUMBER_INT,
                    'flags' => FILTER_SANITIZE_STRIPPED,
                    'options' => array('default' => Null),
                ),

            "Service" =>
                array(
                    'filter' => FILTER_SANITIZE_STRING,
                    'flags' => FILTER_SANITIZE_STRIPPED,
                    'options' => array('default' => Null),
                ),
        );
        $this->set_data(filter_var_array(get_object_vars($this), $sanitize_rules));
    }

    /**
     * Validate data
     *
     * @return bool
     */
    public function validate()
    {
        $this->sanitize();
        $this->validation_errors = array();

        if(!$this->Service) {
            $this->validation_errors['Service'] = 'Please enter!';
        }
        // return
        return empty($this->validation_errors);
    }

    /**
     * Save data
     *
     */
    public function save()
    {
        global $wpdb;

        // data
        $data =  array(
            'Service'=>$this->Service,
            'bActive'=>$this->is_active(), // we can never force this
        );

        // data format
        $format = array(
            '%s', // Name
            '%d', // Active
        );

        // insert
        if(!$this->id) {
            $data['WhenCreated']=date("Y-m-d H:i");
            $format[''] = '%s';

            $wpdb->insert($table = self::get_table_name(), $data, $format);
            $this->id=$wpdb->insert_id;
            return $this->id;
        } else {
            // update
            $wpdb->update(
                $table=self::get_table_name(),
                $data,
                $where=array('id'=>$this->id),
                $format,
                $where_format = array('%d'));
        }
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
	static public function get_by_id($id)
	{
		if($id == False) {
            return Null;
        }

		global $wpdb;
		$result=$wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  id = ".$id,
				OBJECT);
        return $result ? new self($result) : False;

	}

	/**
	 * Get by service name
	 *
	 * @return object
	 */
	static public function get_by_service($service, $active=True)
	{
		if($service == False) {
            return Null;
        }

		$sql="SELECT * FROM ".self::get_table_name()
				." WHERE  lower(Service) like '%".strtolower($service)."%' ";

        if(!is_null($active)) {
            $sql .= " AND bActive=".($active?"True":"False")." ";
        }

        global $wpdb;

        $res = array();
        foreach($wpdb->get_results($sql, OBJECT) as $row) {
            $res[] = new self($row);
        }
        return $res;

    }

}

// [eof]