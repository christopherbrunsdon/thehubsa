<?php

defined('ABSPATH') or die("No script kiddies please!");

// Name 			varchar(255) DEFAULT '',
// RegNumber  		varchar(255) DEFAULT '',
// RegNumberOther  varchar(255) DEFAULT '',
// Address 		varchar(512) NOT NULL  DEFAULT '',
// AddressPostal 	varchar(512) NOT NULL  DEFAULT '',
// Contact 		varchar(255) NOT NULL  DEFAULT '',
// Tel 			varchar(255) NOT NULL  DEFAULT '',
// Mobile 			varchar(255) NOT NULL  DEFAULT '',
// Email 			varchar(255) NOT NULL  DEFAULT '',			
// wwwDomain 		varchar(255) NOT NULL  DEFAULT '',
// wwwHomepage 	varchar(255) NOT NULL  DEFAULT '',
// wwwFacebook 	varchar(255) NOT NULL  DEFAULT '',			
// Description 			varchar(512) NOT NULL  DEFAULT '',
// ServicesOffered 		varchar(512) NOT NULL  DEFAULT '',
// AssociatedOrganisations varchar(512) NOT NULL  DEFAULT '',
// listNeeds 	varchar(512) NOT NULL  DEFAULT '',
// listWish 	varchar(512) NOT NULL  DEFAULT '',
// paymentEft TINYINT default 0,
// paymentDeposit TINYINT default 0,

class model_thehub_npos {


	public
		$_id = Null,
		$_name = Null,
		$_reg_number = Null,
		$_reg_number_other = Null,
		$_address = Null,
		$_address_postal = Null,
		$_contact = Null,
		$_tel = Null,
		$_mobile = Null,
		$_email = Null,
		$_www_domain = Null,
		$_www_homepage = Null,
		$_www_facebook = Null,
		$_description = Null,
		$_services_offered = Null,
		$_associated_organisations = Null,
		$_listneeds = Null,
		$_listwish = Null,
		$_payment_eft = Null,
		$_payment_deposit = Null,
		$_notes = Null;



	static function instance() {
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

		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
			id INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,

			Name 					varchar(255) DEFAULT '',
			RegNumber  				varchar(255) DEFAULT '',
			RegNumberOther  		varchar(255) DEFAULT '',
			Address 				varchar(512) NOT NULL  DEFAULT '',
			AddressPostal 			varchar(512) NOT NULL  DEFAULT '',
			Contact 				varchar(255) NOT NULL  DEFAULT '',
			Tel 					varchar(255) NOT NULL  DEFAULT '',
			Mobile 					varchar(255) NOT NULL  DEFAULT '',
			Email 					varchar(255) NOT NULL  DEFAULT '',
			wwwDomain 				varchar(255) NOT NULL  DEFAULT '',
			wwwHomepage 			varchar(255) NOT NULL  DEFAULT '',
			wwwFacebook 			varchar(255) NOT NULL  DEFAULT '',			
			Description 			varchar(512) NOT NULL  DEFAULT '',
			ServicesOffered 		varchar(512) NOT NULL  DEFAULT '',
			AssociatedOrganisations varchar(512) NOT NULL  DEFAULT '',			
			listNeeds 				varchar(512) NOT NULL  DEFAULT '',
			listWish 				varchar(512) NOT NULL  DEFAULT '',
			paymentEft 				TINYINT default 0,
			paymentDeposit 			TINYINT default 0,
			bActive   	TINYINT DEFAULT TRUE,
			Notes 		varchar(1024) DEFAULT '',
			WhenCreated TIMESTAMP DEFAULT 0,
			WhenUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		                ON UPDATE CURRENT_TIMESTAMP
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

		$this->_name					= array_key_exists('Name', $data) ? $data['Name'] : Null;
		$this->_reg_number				= array_key_exists('RegNumber', $data) ? $data['RegNumber'] : Null;
		$this->_reg_number_other		= array_key_exists('RegNumberOther', $data) ? $data['RegNumberOther'] : Null;
		$this->_address					= array_key_exists('Address', $data) ? $data['Address'] : Null;
		$this->_address_postal			= array_key_exists('AddressPostal', $data) ? $data['AddressPostal'] : Null;
		$this->_contact					= array_key_exists('Contact', $data) ? $data['Contact'] : Null;
		$this->_tel						= array_key_exists('Tel', $data) ? $data['Tel'] : Null;
		$this->_mobile					= array_key_exists('Mobile', $data) ? $data['Mobile'] : Null;
		$this->_email					= array_key_exists('Email', $data) ? $data['Email'] : Null;
		$this->_www_domain				= array_key_exists('wwwDomain', $data) ? $data['wwwDomain'] : Null;
		$this->_www_homepage			= array_key_exists('wwwHomepage', $data) ? $data['wwwHomepage'] : Null;
		$this->_www_facebook			= array_key_exists('wwwFacebook', $data) ? $data['wwwFacebook'] : Null;
		$this->_description				= array_key_exists('Description', $data) ? $data['Description'] : Null;
		$this->_services_offered		= array_key_exists('ServicesOffered', $data) ? $data['ServicesOffered'] : Null;
		$this->_associated_organisations= array_key_exists('AssociatedOrganisations', $data) ? $data['AssociatedOrganisations'] : Null;
		$this->_listneeds				= array_key_exists('listNeeds', $data) ? $data['listNeeds'] : Null;
		$this->_listwish				= array_key_exists('listWish', $data) ? $data['listWish'] : Null;
		$this->_payment_eft				= array_key_exists('paymentEft', $data) ? $data['paymentEft'] : Null;
		$this->_payment_deposit			= array_key_exists('paymentDeposit', $data) ? $data['paymentDeposit'] : Null;
	}

	/**
	 * Validate
	 *
	 */

	public function validate($data)
	{
		$errors = array();

		// validate

		$sanitize_rules = array(
  			"npo-name" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-reg-number" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-reg-other" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-address" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-postal" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-contact" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-tel" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-mobile" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-email" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-website" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-url" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-facebook" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-description" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-services-other" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-associated" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-needs" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-wishlist" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						),

  			"npo-payment-eft" => 
  					array(
  							'filter' => FILTER_SANITIZE_NUMBER_INT,
  							'flags' => FILTER_SANITIZE_STRIPPED,  							
  							'options' => array('default' => 0),
  						),

  			"npo-payment-deposit" => 
  					array(
  							'filter' => FILTER_SANITIZE_NUMBER_INT,
  							'flags' => FILTER_SANITIZE_STRIPPED,  							
  							'options' => array('default' => 0),
  						),
			);

		// dynamically add

		for($i = 1; $i <= 5 ; $i++)
		{
  			$sanitize_rules["npo-service-offered-{$i}"] =
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						);

  			$sanitize_rules["npo-service-offered-other-${i}"] = 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
  						);
		}

		// sanitize data

		$data = filter_var_array($data, $sanitize_rules);

		if(empty($data['npo-name'])) {
			$errors['npo-name'] = 'Please enter!';
		}

		if(empty($data['npo-reg-number'])) {
			$errors['npo-reg-number'] = 'Please enter!';
		}

		if(empty($data['npo-address'])) {
			$errors['npo-address'] = 'Please enter!';
		}

		if(empty($data['npo-postal'])) {
			$errors['npo-postal'] = 'Please enter!';
		}

		if(empty($data['npo-contact'])) {
			$errors['npo-contact'] = 'Please enter contact person!';
		}

		if(empty($data['npo-tel'])) {
			$errors['npo-tel'] = 'Please enter telephonen number!';
		}

		if(empty($data['npo-mobile'])) {
			$errors['npo-mobile'] = 'Please enter cellphone number!';
		}

		if(empty($data['npo-email'])) {
			$errors['npo-email'] = 'Please enter email address!';
		}

		if(empty($data['npo-website'])) {
			$errors['npo-website'] = 'Please enter!';
		}

		if(empty($data['npo-url'])) {
			$errors['npo-url'] = 'Please enter!';
		}

		if(empty($data['npo-facebook'])) {
			$errors['npo-facebook'] = 'Please enter!';
		}

		if(empty($data['npo-description'])) {
			$errors['npo-description'] = 'Please enter!';
		}

		if(empty($data['npo-services-other'])) {
			$errors['npo-services-other'] = 'Please enter!';
		}

		if(empty($data['npo-associated'])) {
			$errors['npo-associated'] = 'Please enter!';
		}

		if(empty($data['npo-needs'])) {
			$errors['npo-needs'] = 'Please enter!';
		}

		if(empty($data['npo-wishlist'])) {
			$errors['npo-wishlist'] = 'Please enter!';
		}

		if(!isset($data['npo-payment-eft']) && !isset($data['npo-payment-deposit'])) {
			$errors['npo-payment-eft'] = 'Please make a payment!';
			$errors['npo-payment-deposit'] = 'Please make a payment!';
		}
		
	    return array('errors'=>$errors, 'data' => $data);
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
					'Name' 				=> $this->_name,
					'RegNumber' 		=> $this->_reg_number,
					'RegNumberOther' 	=> $this->_reg_number_other,
					'Address' 			=> $this->_address,
					'AddressPostal' 	=> $this->_address_postal,
					'Contact' 			=> $this->_contact,
					'Tel' 				=> $this->_tel,
					'Mobile' 			=> $this->_mobile,
					'Email' 			=> $this->_email,
					'wwwDomain' 		=> $this->_www_domain,
					'wwwHomepage' 		=> $this->_www_homepage,
					'wwwFacebook' 		=> $this->_www_facebook,
					'Description' 		=> $this->_description,
					'ServicesOffered' 	=> $this->_services_offered,
					'AssociatedOrganisations' => $this->_associated_organisations,
					'listNeeds' 		=> $this->_listneeds,
					'listWish' 			=> $this->_listwish,
					'paymentEft' 		=> $this->_payment_eft,
					'paymentDeposit' 	=> $this->_payment_deposit,
					'Notes' => $this->_notes,
					'WhenCreated' => date("Y-m-d H:i"), // now()     
					),
				array(
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
					'%s', // paymentEft
					'%s', // paymentDeposit
					'%s', // Notes
					'%s', // WhenCreated
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