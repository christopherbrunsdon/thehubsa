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

		foreach($data as $k=>$v) {
			$this->$k=$v;
		}
	}

	/**
	 * Validate
	 * Change this to not be form specific.
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


		// one or the other
		if(empty($data['npo-tel']) && empty($data['npo-mobile'])) {
			$errors['npo-tel'] = 'Please enter telephone number!';
		}

		if(empty($data['npo-mobile']) && empty($data['npo-tel'])) {
			$errors['npo-mobile'] = 'Please enter cellphone number!';
		}


		if(empty($data['npo-email'])) {
			$errors['npo-email'] = 'Please enter email address!';
		}

		// if(empty($data['npo-website'])) {
		// 	$errors['npo-website'] = 'Please enter!';
		// }

		// if(empty($data['npo-url'])) {
		// 	$errors['npo-url'] = 'Please enter!';
		// }

		// if(empty($data['npo-facebook'])) {
		// 	$errors['npo-facebook'] = 'Please enter!';
		// }

		if(empty($data['npo-description'])) {
			$errors['npo-description'] = 'Please enter!';
		}

		if(empty($data['npo-services-other'])) {
			$errors['npo-services-other'] = 'Please enter!';
		}

		// if(empty($data['npo-associated'])) {
		// 	$errors['npo-associated'] = 'Please enter!';
		// }

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
		if (empty($object)) {
			return $object;
		}

		if($object->id == 111111) {
			$object->Name = "Masikhule";		// ]=> string(4) "test"
			$object->RegNumber = "050-955";		// ]=> string(11) "test REG NP"
			$object->RegNumberOther = "";		// ]=> string(5) "OTHER"
			
			$object->Address = "";		
			$object->AddressPostal = "P. O. BOX 5508
	HELDERBERG
	SOMERSET WEST
	7135";	
			
			$object->Contact = "Sandy Immelman";		// ]=> string(7) "Contact"
			$object->Tel = "";		// ]=> string(5) "08282"
			$object->Mobile = "+27 82 494 0983";		// ]=> string(8) "08080808"
			$object->Email = "maskihule1@gmail.com";		// ]=> string(11) "bob@bob.com"
			$object->wwwDomain = "http://www.masikhule.org/";		// ]=> string(11) "www.bob.com"
			$object->wwwHomepage = "http://www.masikhule.org/";		// ]=> string(12) "bob.com/home"
			$object->wwwFacebook = "https://www.facebook.com/pages/Masikhule/289475921083560";		// ]=> string(12) "facebook/bob"
			
			$object->Description = "Masikhule is a local NPO established in 2005 that trains and educates women and children in the townships surrounding the Helderberg.

	We provide training to 300 women per annum in Early Child Development and the importance of early stimulation. To ensure the integration of the theory and practice of ECD we provide mentorship within 32 ECD Centres, thus reaching nearly 2 000 children from birth to 6 years of age annually.";		// ]=> string(12) "Short descrt"
			
			$object->ServicesOffered = "";		// ]=> string(3) "moo"
			$object->AssociatedOrganisations = "";		// ]=> string(9) "sadsadsad"
			$object->list_Needs = "<ul>
	<li>Funding for training.</li>
	<li>Infrastructure upgrades to ECD centres.</li>
	<li>Feeding schemes.</li>
	<li>Reading corners.</li>
	<li>Resources for toy and book library.		</li>
			</ul>";		// ]=> string(4) "need"
			$object->listWish = "
			<ul>
	<li>First aid training for ECD staff.</li>
	<li>Security for ECD centres.</li>
	<li>First aid kits and fire extinguishers.</li>
	<li>Computers and printers.	</li>
	<li>Outdoor shade and playground equipment.	</li>
			</ul>";		// ]=> string(4) "wish"
			
			$object->paymentEft = "";		// ]=> string(1) "0"
			$object->paymentDeposit = "";		// ]=> string(1) "0"
			$object->bActive = True;		// ]=> string(1) "1"
			$object->Notes = "";		// ]=> string(0) ""		

			$object->logo =  plugins_url('../downloads/logo/masikhule_258x99.jpg', __FILE__);
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