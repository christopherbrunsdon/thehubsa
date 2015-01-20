<?php

defined('ABSPATH') or die("No script kiddies please!");
define('SHORTCODE_THEHUBSA_FORM_SIGNUP_NPO', 'thehubsa_form_signup_npo');

/** 
 * Signup form for NPOs
 *
 */

class form_npo 
{
	/**
	 *
	 */

	static function instance() {
		static $inst = Null;
		if (!isset($inst)) {
			$inst = new form_npo();
		}
		return $inst;
	}


	function css_bootstrap()
	{
		?>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<?php
	}

	/**
	 *
	 */

	function html_form_signup() 
	{
		$this->css_bootstrap(); 

		?>
		<form>
			<h1>ORGANISATION REGISTRATION FORM</h1>

			<!-- Name of organisation -->

			<h2>NAME OF ORGANISATION</h2>

			<div class="form-group">
				<label for="">NPO registration number &amp; date of registration</label>
				<input type="text" class="form-control" id="" placeholder="NPO registration number &amp; date of registration" />
			</div>

			<div class="form-group">
				<label for="">Other registration numbers </label>
				<input type="text" class="form-control" id="" placeholder="Other registration numbers" />
			</div>

			<div class="form-group">
				<label for="">Physical address </label>
				<input type="text" class="form-control" id="" placeholder="Physical address" />
			</div>

			<div class="form-group">
				<label for="">Postal address </label>
				<input type="text" class="form-control" id="" placeholder="Postal address" />
			</div>


			<!-- contact details -->
			<h2>CONTACT DETAILS</h2>
			<div class="form-group"> 
				<label for="">Contact person </label>
				<input type="text" class="form-control" id="" placeholder="Contact person " />
			</div>

			<div class="form-group"> 
				<label for="">Telephone number </label>
				<input type="text" class="form-control" id="" placeholder="Telephone number " />
			</div>

			<div class="form-group"> 
				<label for="">Cell number </label>
				<input type="text" class="form-control" id="" placeholder="Cell number " />
			</div>

			<div class="form-group"> 
				<label for="">email address </label>
				<input type="text" class="form-control" id="" placeholder="email address " />
			</div>

			<div class="form-group"> 
				<label for="">Website address </label>
				<input type="text" class="form-control" id="" placeholder="Website address " />
			</div>

			<div class="form-group"> 
				<label for="">Preferred link for listing </label>
				<input type="text" class="form-control" id="" placeholder="Preferred link for listing " />
			</div>

			<div class="form-group"> 
				<label for="">Facebook page </label>
				<input type="text" class="form-control" id="" placeholder="Facebook page " />
			</div>

			<div class="form-group"> 
				<label for="">Operating hours </label>
				<input type="text" class="form-control" id="" placeholder="Operating hours " />
			</div>

			<div class="form-group"> 
				<label for="">Services offered</label>
				<input type="text" class="form-control" id="" placeholder="Services offered" />
			</div>

			<button type="submit" class="btn btn-default">Submit</button>
		</form>	
		<?php
	}

	/**
	 *
	 */

	function process_form_signup()
	{
	}

	/**
	 *
	 */

	function html_thank_you()
	{

	}

	/**
	 * Register shortcode
	 *
	 */

	static function shortcode()
	{
	    $res = self::instance()->process_form_signup();

	    ob_start();

	    if(empty($res)) {
	        self::instance()->html_form_signup();
	    } elseif (!empty($res['errors'])) {
	        self::instance()->html_form_signup($res['errors']);
	    } else {
	        self::instance()->html_thank_you();
	    }
	    
	    return ob_get_clean();
	}
}

// register shortcode

add_shortcode( SHORTCODE_THEHUBSA_FORM_SIGNUP_NPO, 'form_npo::shortcode' );

// [eof]