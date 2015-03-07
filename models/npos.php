<?php

//defined('ABSPATH') or die("No script kiddies please!");

require_once("model_abstract.php");

class model_thehub_npos extends model_abstract {

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
		$bActive=Null,
        $WhenCreated=Null,
        $WhenUpdated=Null;

    public
        $_npo_services=Null;

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

		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
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
				." WHERE  id = {$id}",
				OBJECT);

        return $result ? new self($result) : False;
	}

	/**
	 * Get by email
	 *
	 * @return object
	 */
	static public function get_by_email($email, $active=Null)
	{
		if($email == False) {
            return Null;
        }

		global $wpdb;
		$result=$wpdb->get_row("SELECT * FROM ".self::get_table_name()
				." WHERE  lower(email) = '".strtolower($email)."' "
                . (!is_null($active)?" AND bActive=".($active?"True":"False")." ":""),
				OBJECT);

        return $result ? new self($result) : False;
	}

	/**
	 * Sanitize
     *
     * Prep the data coming in
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
                    'filter' => FILTER_SANITIZE_EMAIL,
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

            "listWish" =>
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

        // Email
		if(!$this->Email) {
            $this->validation_errors['Email'] = 'Please enter email address!';
		}
        elseif (!filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            $this->validation_errors['Email'] = 'There is an error in the email address!';
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
            return $this->id;
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
			$sql .= $pre." lower(Name) like '%".strtolower($name_like)."%' ";
			$pre = ' AND ';
		}

		if($filter_service) {
			$sql .= $pre." service.id={$filter_service} ";
			$pre = ' AND ';
		}

		if(!is_null($active)) {
			$sql .= $pre." npo.bActive=".($active?"True ":"False ");
			$pre = ' AND ';
		}

        $sql .= " ORDER BY lower(Name) ";

		global $wpdb;

		$res = array();
		foreach($wpdb->get_results($sql, OBJECT) as $row) {
			$res[] = new self($row);
		}
		return $res;
	}

    /**
     * @param $LogoPath
     * @return mixed|null
     */
	static function logo_url($LogoPath)
	{
		$logo = Null;
		if($LogoPath) {
			$upload_dir=wp_upload_dir();
			$logo=str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $LogoPath);
		}
		return $logo;
	}

    /**
     * @TODO: For the images we want to be able to return
     * a resized image. Eg - small, medium, original, large ...
     */

    /**
     * @return mixed|null
     */
	function get_logo_url()
	{
		return self::logo_url($this->LogoPath);
	}

    /**
     * @return null
     */
    function get_npo_services($refresh=False)
    {
        if($refresh) {
            $this->_npo_services = Null;
        }
        if(empty($this->_npo_services) && !is_array($this->_npo_services)) {
            if($this->id) {
                $this->_npo_services=model_thehub_npo_services::get_by_npo($this->id)?:array(); //set to array if failed
            } else {
                $this->_npo_services=array();
            }
        }
        return $this->_npo_services;
    }
}
// [eof]