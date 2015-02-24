<?php

defined('ABSPATH') or die("No script kiddies please!");

class model_thehub_npos /** extends model */{

    public
        $validation_errors = Null;

	public
		$id=Null,
		$Name=Null,
		$RegNumber=Null,
		$RegNumberOther=Null,
		$Address=Null,
		$AddressPostal=Null,
		$Contact=Null,
		$Tel=Null,
		$Mobile=Null,
		$Email=Null,
		$wwwDomain=Null,
		$wwwHomepage=Null,
		$wwwFacebook=Null,
		$Description=Null,
		$ServicesOffered=Null,
		$AssociatedOrganisations=Null,
		$listNeeds=Null,
		$listWish=Null,
		$paymentEft=Null,
		$paymentDeposit=Null,
		$Notes=Null,
		$LogoPath=Null,
		$bActive=Null;

    /**
     * @return model_thehubsa_npos
     */
	static function instance()
	{
		static $inst = null;
        if (is_null($inst)) {
            $inst = new model_thehubsa_npos();
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
	public function __toString() 
	{
		return $this->Name." (Reg: {$this->RegNumber})";
	}

	/**
	 *
	 */
	static function get_table_name() 
	{
		global $wpdb;
		return $wpdb->prefix."thehub_npos";
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

//IF NOT EXISTS 
//		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
		$sql = "CREATE TABLE {$table_name} (
			id INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
			Name varchar(255) DEFAULT '',
			RegNumber varchar(255) DEFAULT '',
			RegNumberOther varchar(255) DEFAULT '',
			Address varchar(512) NOT NULL  DEFAULT '',
			AddressPostal varchar(512) NOT NULL  DEFAULT '',
			Contact varchar(255) NOT NULL  DEFAULT '',
			Tel varchar(255) NOT NULL  DEFAULT '',
			Mobile varchar(255) NOT NULL  DEFAULT '',
			Email varchar(255) NOT NULL  DEFAULT '',
			wwwDomain varchar(255) NOT NULL  DEFAULT '',
			wwwHomepage varchar(255) NOT NULL  DEFAULT '',
			wwwFacebook varchar(255) NOT NULL  DEFAULT '',			
			Description varchar(512) NOT NULL  DEFAULT '',
			ServicesOffered varchar(512) NOT NULL  DEFAULT '',
			AssociatedOrganisations varchar(512) NOT NULL  DEFAULT '',			
			listNeeds varchar(512) NOT NULL  DEFAULT '',
			listWish varchar(512) NOT NULL  DEFAULT '',
			paymentEft TINYINT default 0,
			paymentDeposit TINYINT default 0,
			bActive TINYINT DEFAULT FALSE,
			Notes varchar(1024) DEFAULT '',
			LogoPath varchar(255) NOT NULL DEFAULT '',
			WhenCreated TIMESTAMP DEFAULT 0,
			WhenUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
		return self::_postProcess($wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  id = ".$id,
				OBJECT));
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
		return self::_postProcess($wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  lower(email) = '".strtolower($email)."' ",
				OBJECT));
	}

	/**
	 * 
	 */
	public function set_data($data)
	{
		if(is_object($data)) {
			return $this->set_data(get_object_vars($data));
		}

        if(!is_array($data)) {
            return;
        }

		foreach(get_object_vars($this) as $k=>$v) {
			if(array_key_exists($k, $data)) {
				$this->$k=$data[$k];
			}
		}
	}

	/**
	 * Validate
	 * Change this to not be form specific.
	 */
	public function validate()
	{

		$this->validation_errors = array();

		// validate

		$sanitize_rules = array(
  			"id" => 
  					array(
  							'filter' => FILTER_SANITIZE_NUMBER_INT,
  							'flags' => FILTER_SANITIZE_STRIPPED,  							
  							'options' => array('default' => Null),
  						),

  			"Name" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"RegNumber" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"RegNumberOther" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"Address" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"AdressPostal" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"Contact" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"Tel" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"Mobile" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"Email" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"wwwDomain" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"wwwHomepage" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"wwwFacebook" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"Description" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"ServicesOffered" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),


  			"AssociatedOrganisations" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"listNeeds" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"listWidh" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"paymentEft" => 
  					array(
  							'filter' => FILTER_SANITIZE_NUMBER_INT,
  							'flags' => FILTER_SANITIZE_STRIPPED,  							
  							'options' => array('default' => 0),
  						),

  			"paymentDeposit" => 
  					array(
  							'filter' => FILTER_SANITIZE_NUMBER_INT,
  							'flags' => FILTER_SANITIZE_STRIPPED,  							
  							'options' => array('default' => 0),
  						),
			);

		// dynamically add
		// move to model
		// for($i = 1; $i <= 5 ; $i++)
		// {
  // 			$sanitize_rules["service-offered-{$i}"] =
  // 					array(
  // 							'filter' => FILTER_SANITIZE_STRING,
  // 							'flags' => FILTER_SANITIZE_STRIPPED,
  // 							'options' => array('default' => Null),
  // 						);

  // 			$sanitize_rules["service-offered-other-${i}"] = 
  // 					array(
  // 							'filter' => FILTER_SANITIZE_STRING,
  // 							'flags' => FILTER_SANITIZE_STRIPPED,
  // 							'options' => array('default' => Null),
  // 						);
		// }

		// sanitize data

		// $data = get_object_vars($this);
		// $data = filter_var_array($data, $sanitize_rules);
		
		$this->set_data(filter_var_array(get_object_vars($this), $sanitize_rules));

		if(!$this->Name) {
            $this->validation_errors['Name'] = 'Please enter!';
		}

		if(!$this->RegNumber) {
            $this->validation_errors['RegNumber'] = 'Please enter!';
		}

		if(!$this->Address) {
            $this->validation_errors['Address'] = 'Please enter!';
		}

		if(!$this->AddressPostal) {
            $this->validation_errors['AddressPostal'] = 'Please enter!';
		}

		if(!$this->Contact) {
            $this->validation_errors['Contact'] = 'Please enter contact person!';
		}


		// one or the other
		if(!$this->Tel && !$this->Mobile) {
            $this->validation_errors['Tel'] = 'Please enter telephone number!';
		}

		if(!$this->Mobile && !$this->Tel) {
            $this->validation_errors['Mobile'] = 'Please enter cellphone number!';
		}


		if(!$this->Email) {
            $this->validation_errors['Email'] = 'Please enter email address!';
		}

		// if(empty($this->website)) {
		// 	$errors['website'] = 'Please enter!';
		// }

		// if(empty($this->url'])) {
		// 	$errors['url'] = 'Please enter!';
		// }

		// if(empty($this->facebook'])) {
		// 	$errors['facebook'] = 'Please enter!';
		// }

		if(!$this->Description) {
            $this->validation_errors['Description'] = 'Please enter!';
		}

		if(!$this->ServicesOffered) {
            $this->validation_errors['ServicesOffered'] = 'Please enter!';
		}

		// if(empty($this->AssociatedOrganisations'])) {
		// 	$errors['AssociatedOrganisations'] = 'Please enter!';
		// }

		if(!$this->listNeeds) {
            $this->validation_errors['listNeeds'] = 'Please enter!';
		}

		if(!$this->listWish) {
            $this->validation_errors['listWish'] = 'Please enter!';
		}

		// check payments for new entries.
		if(!$this->id) {
			if(!$this->paymentEft && !$this->paymentDeposit) {
                $this->validation_errors['paymentEft'] = 'Please make a payment!';
                $this->validation_errors['paymentDeposit'] = 'Please make a payment!';
			}
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
					'Name' 				=> $this->Name,
					'RegNumber' 		=> $this->RegNumber,
					'RegNumberOther' 	=> $this->RegNumberOther,
					'Address' 			=> $this->Address,
					'AddressPostal' 	=> $this->AddressPostal,
					'Contact' 			=> $this->Contact,
					'Tel' 				=> $this->Tel,
					'Mobile' 			=> $this->Mobile,
					'Email' 			=> $this->Email,
					'wwwDomain' 		=> $this->wwwDomain,
					'wwwHomepage' 		=> $this->wwwHomepage,
					'wwwFacebook' 		=> $this->wwwFacebook,
					'Description' 		=> $this->Description,
					'ServicesOffered' 	=> $this->ServicesOffered,
					'AssociatedOrganisations' => $this->AssociatedOrganisations,
					'listNeeds' 		=> $this->listNeeds,
					'listWish' 			=> $this->listWish,
					'paymentEft' 		=> (bool)$this->paymentEft,
					'paymentDeposit' 	=> (bool)$this->paymentDeposit,
					'Notes' 			=> $this->Notes,
					'LogoPath'			=> $this->LogoPath,
					'bActive' 			=> $this->is_active(), // we can never force this  
					);

		// data format
		$format = array(
					'%s', // Name
					'%s', // RegNumber
					'%s', // RegNumberOther
					'%s', // Address
					'%s', // AddressPostal
					'%s', // Contact
					'%s', // Tel
					'%s', // Mobile
					'%s', // Email
					'%s', // wwwDomain
					'%s', // wwwHomepage
					'%s', // wwwFacebook
					'%s', // Description
					'%s', // ServicesOffered
					'%s', // AssociatedOrganisations
					'%s', // listNeeds
					'%s', // listWish
					'%d', // paymentEft
					'%d', // paymentDeposit
					'%s', // Notes
					'%s', // Logo
					'%d', // Active
					);

		// insert
		if(!$this->id) {
			$data['WhenCreated'] = date("Y-m-d H:i");    
			$format[''] = '%s';

			$wpdb->insert($table = self::get_table_name(), $data, $format);
			$this->id = $wpdb->insert_id;
		} else {
			// update
			$wpdb->update(
				$table = self::get_table_name(), 
				$data, 
				$where = array('id' => $this->id),
				$format,
				$where_format = array('%d'));
		}
	}

	/**
	 * Is active
	 * 
	 * Apply active rules here
	 *
	 * @return bool
	 */
	public function is_active() {
		return (bool)(isset($this->bActive) && $this->bActive);
	}


	/**
	 *
	 */
	public function setActive($active = True) {
		$this->bActive = $active;
		$this->save();
	}

	/**
	 * Get by name
	 *
	 * @return object
	 */
	static public function get_by_name($name_like = Null, $filter_service = Null, $active = True)
	{
		$sql = "SELECT npo.* FROM ".self::get_table_name()." As npo ";

		if($filter_service) {
			$sql .= " INNER JOIN ".model_thehub_npo_services::get_table_name()." AS ns ON(npo.id=ns.fkNpo) "
				." INNER JOIN ".model_thehub_npo_service_types::get_table_name()." AS service ON(ns.fkService=service.id) ";
		}

		$pre = ' WHERE ';
		if($name_like) {
			$sql .= $pre." lower(Name) like '".strtolower($name_like)."%' ";
			$pre = ' AND ';
		}

		if($filter_service) {
			$sql .= $pre." service.id={$filter_service} ";
			$pre = ' AND ';
		}

		if($active) {
			$sql .= $pre." npo.bActive=True ";
			$pre = ' AND ';
		}

		$sql .= " ORDER BY lower(Name) ";


		global $wpdb;

		$res = array();

		foreach($wpdb->get_results($sql, OBJECT) as $row) {
			$res[] = self::_postProcess($row);
		}
		return $res;
	}


	/**
	 * Post process the data
	 *
	 * This is for the launch on 2015-02-09
	 */
	static function _postProcess($object) 
	{
        // we can remove this ....
		if (empty($object)) {
			return $object;
		}

		$object->logo = self::logo_url($object->LogoPath); 
		$object->npo_services = model_thehub_npo_services::get_by_npo($object->id);
		return new self($object);
	}

	/**
	 *
	 */
	static function logo_url($LogoPath)
	{
		$logo = Null;
		if($LogoPath) {
			$upload_dir = wp_upload_dir();
			$logo = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $LogoPath);		
		}
		return $logo;
	}

	function get_logo_url()
	{
		return self::logo_url($this->LogoPath);
	}
}
// [eof]