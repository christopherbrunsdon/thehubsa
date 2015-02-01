<?php

defined('ABSPATH') or die("No script kiddies please!");
define('SHORTCODE_THEHUBSA_FORM_SIGNUP_NPO', 'thehubsa_form_signup_npo');

require_once("form.php");

/** 
 * Signup form for NPOs
 *
 */

class form_npo extends form
{
	/**
	 *
	 */

	function render($data = Null, $errors = Null) 
	{
		include("form-npo-template.php");
	}

	/**
	 *
	 */

	function process($data)
	{
		if(!isset($data['npo-submit'])) {
		    return Null;
		}

// var_dump("<pre>", $_POST, $_GET, "</pre>"); 
		
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

  			"npo-service-other" => 
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

  			"npo-submit" => 
  					array(
  							'filter' => FILTER_SANITIZE_STRING,
  							'flags' => FILTER_SANITIZE_STRIPPED,
  							'options' => array('default' => Null),
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

		$this->_form_data = filter_var_array($data, $sanitize_rules);

		if(empty($this->_form_data['npo-name'])) {
			$this->addError('npo-name','Please enter!');
		}

		if(empty($this->_form_data['npo-reg-number'])) {
			$this->addError('npo-reg-number','Please enter!');
		}

		if(empty($this->_form_data['npo-address'])) {
			$this->addError('npo-address','Please enter!');
		}

		if(empty($this->_form_data['npo-postal'])) {
			$this->addError('npo-postal','Please enter!');
		}

		if(empty($this->_form_data['npo-contact'])) {
			$this->addError('npo-contact','Please enter contact person!');
		}

		if(empty($this->_form_data['npo-tel'])) {
			$this->addError('npo-tel','Please enter telephonen number!');
		}

		if(empty($this->_form_data['npo-mobile'])) {
			$this->addError('npo-mobile','Please enter cellphone number!');
		}

		if(empty($this->_form_data['npo-email'])) {
			$this->addError('npo-email','Please enter email address!');
		}

		if(empty($this->_form_data['npo-website'])) {
			$this->addError('npo-website','Please enter!');
		}

		if(empty($this->_form_data['npo-url'])) {
			$this->addError('npo-url','Please enter!');
		}

		if(empty($this->_form_data['npo-facebook'])) {
			$this->addError('npo-facebook','Please enter!');
		}

		if(empty($this->_form_data['npo-description'])) {
			$this->addError('npo-description','Please enter!');
		}

		if(empty($this->_form_data['npo-service-other'])) {
			$this->addError('npo-service-other','Please enter!');
		}

		if(empty($this->_form_data['npo-associated'])) {
			$this->addError('npo-associated','Please enter!');
		}

		if(empty($this->_form_data['npo-needs'])) {
			$this->addError('npo-needs','Please enter!');
		}

		if(empty($this->_form_data['npo-wishlist'])) {
			$this->addError('npo-wishlist','Please enter!');
		}

		if(empty($this->_form_data['npo-xxx'])) {
			$this->addError('npo-xxx','Please enter!');
		}

	}

	/**
	 *
	 */

	function render_thank_you()
	{

	}
}

// register shortcode


add_shortcode( SHORTCODE_THEHUBSA_FORM_SIGNUP_NPO, array(new form_npo() ,'shortcode'));

// SELECT BY CATEGORY:
// Agriculture/Food security
// Arts & Culture
// Environment & Biodiversity
// Enterprise & Employment
// Early Childhood Development (ECD)
// Education
// Health
// Skills Development
// Senior Citizenship
// Youth Development
// Animals
// Environment
// Homeless
// Substance Abuse
// Disabilities
// Palliative Care
// Sustainability
// Women Empowerment
// Safety & Security
// Sport
// Wildlife
 
// [eof]