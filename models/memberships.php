<?php

defined('ABSPATH') or die("No script kiddies please!");

// +------------------+--------------+------+-----+---------------------+-----------------------------+
// | Field            | Type         | Null | Key | Default             | Extra                       |
// +------------------+--------------+------+-----+---------------------+-----------------------------+
// | id               | int(11)      | NO   | PRI | NULL                | auto_increment              |
// | Name             | varchar(255) | YES  |     |                     |                             |
// | Surname          | varchar(255) | YES  |     |                     |                             |
// | Email            | varchar(255) | NO   |     | NULL                |                             |
// | fkMembershipType | int(11)      | YES  | MUL | NULL                |                             |
// | bActive          | tinyint(4)   | YES  |     | 1                   |                             |
// | WhenCreated      | timestamp    | NO   |     | 0000-00-00 00:00:00 |                             |
// | WhenUpdated      | timestamp    | NO   |     | CURRENT_TIMESTAMP   | on update CURRENT_TIMESTAMP |
// +------------------+--------------+------+-----+---------------------+-----------------------------+

class model_thehub_memberships {


	public
		$_id = Null,
		$_name = Null,
		$_surname = Null,
		$_email = Null,
		$_m_type = Null,
		$_notes = Null;


	static function instance() {
		static $inst = null;
        if (is_null($inst)) {
            $inst = new model_thehub_memberships();
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
	 *
	 */

	static function get_table_name() 
	{
		global $wpdb;
		return $wpdb->prefix."thehub_memberships";
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
		$fk_name_membership_types = model_thehub_membership_types::get_table_name();

		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
			id INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
			Name varchar(255) DEFAULT '',
			Surname varchar(255) DEFAULT '',
			Email varchar(255) NOT NULL,
			fkMembershipType INT DEFAULT NULL,

			bActive   TINYINT DEFAULT TRUE,
			Notes varchar(1024) DEFAULT '',
			WhenCreated TIMESTAMP DEFAULT 0,
			WhenUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		                ON UPDATE CURRENT_TIMESTAMP,

			FOREIGN KEY (fkMembershipType)
				REFERENCES {$fk_name_membership_types}(id)
				ON DELETE SET NULL			
			) {$charset_collate};";
		return $sql;
	}

	/**
	 * Get by id
	 *
	 * @return object
	 */

	static public function get_by_id($id)
	{
		if($id == False)
			return Null;

		global $wpdb;
		return $wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  id = ".$id,
				OBJECT);
	}

	/**
	 * Get by email
	 *
	 * @return object
	 */

	static public function get_by_email($email)
	{
		if($type == False)
			return Null;

		global $wpdb;
		return $wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  lower(email) = '".strtolower($email)."' ",
				OBJECT);
	}

	/**
	 * 
	 */

	public function set_data($data)
	{
		if(!is_array($data)) {
			return $this->set_data(array());
		}

		$this->_name    = array_key_exists('name', $data) ? $data['name'] : Null;
		$this->_surname = array_key_exists('surname', $data) ? $data['surname'] : Null;
		$this->_email   = array_key_exists('email', $data) ? $data['email'] : Null;
		$this->_m_type  = array_key_exists('mtype', $data) ? $data['mtype'] : Null;
		$this->_notes  = array_key_exists('notes', $data) ? $data['notes'] : Null;
	}
	/**
	 * Validate
	 *
	 */

	public function validate()
	{
		$errors = array();

		// validate

	    if(empty($this->_name)) {
	        $errors['name'] = 'Please enter in your name';
	    }

	    if(empty($this->_email)) {
	        $errors['email'] = 'Please enter in your email';
	    } elseif (filter_var($this->_email, FILTER_VALIDATE_EMAIL) == False) {
	        $errors['email'] = "Please enter in a valid email";
	    }

	    if(empty($this->_m_type)) {
	        $errors['membership-type'] = 'Please select an option';
	    } else {
	        $exists = model_thehub_membership_types::get_by_id($this->_m_type);
	        if(empty($exists)) {
	            $errors['membership-type'] = 'Please select an option';
	        }
	    }

	    return array('errors'=>$errors);
	}


	/**
	 * Save data
	 *
	 */

	public function save()
	{
		global $wpdb;

		if($this->_id == False) {
			// add to db

			$wpdb->insert(self::get_table_name(),
				array(
					'Name' => $this->_name,            
					'Surname' => $this->_surname ,         
					'Email' => $this->_email ,           
					'fkMembershipType' => $this->_m_type,
					'Notes' => $this->_notes,
					'WhenCreated' => date("Y-m-d H:i"), // now()     
					),
				array(
					'%s',
					'%s',
					'%s',
					'%d',
					'%s',
					'%s',
					));

			$this->_id = $wpdb->insert_id;
		} else {
			// update
		}
	}

	/** 
	 * Send email
	 *
	 */

	public function email($subject, $message)
	{
		if(empty($subject) || empty($message)) {
			error_log(__CLASS__.":".__METHOS." Empty: [\$subject:{$suject}] [\$message:{$message}]");
			return False;
		}

		if(filter_var($this->_email, FILTER_VALIDATE_EMAIL) == False)
		{
			error_log(__CLASS__.":".__METHOS." Invalid email ".$this->_email);
			return False;
		}

        $to = $this->_email;
        $from = get_option( 'admin_email' );
        $headers = "From: TheHubSA <{$from}>" . "\r\n";

  		return wp_mail( $to, $subject, $message, $headers );
	}
}
// [eof]