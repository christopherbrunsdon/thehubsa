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

			<!-- address type -->

			<div class="form-group">
				<label for="">Physical address </label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="Physical address"></textarea>
			</div>

			<div class="form-group">
				<label for="">Postal address </label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="Postal address"></textarea>
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

<!-- 			<div class="form-group"> 
				<label for="">Operating hours </label>
				<input type="text" class="form-control" id="" placeholder="Operating hours " />
			</div>
 -->
		<?php for($i=1; $i <= 5; $i++): ?>
			<div class="form-group"> 
				<?php if($i == 1) : ?><label for="">Services offered</label><?php endif ?>
				<select  class="form-control" id="">
					<option>-- Services offered --</option>
					<option value="">Adult abuse victim support</option>
					<option value="">Adult education</option>
					<option value="">Adult rape victim support</option>
					<option value="">Animal abuse intervention</option>
					<option value="">Child abuse victim support</option>
					<option value="">Child rape victim support</option>
					<option value="">Crisis pregnancy support</option>
					<option value="">ECD education</option>
					<option value="">Environmental projects</option>
					<option value="">Feeding scheme</option>
					<option value="">Food gardens</option>
					<option value="">HIV and AIDS intervention</option>
					<option value="">Literacy scheme</option>
					<option value="">Lost and found animals</option>
					<option value="">Lost and found children/adults</option>
					<option value="">Skills training </option>
					<option value="">Substance abuse</option>
					<option value="">Support for homeless</option>
					<option value="">Support for new mothers</option>
					<option value="">Support for the disabled</option>
					<option value="">Support for the elderly</option>
					<option value="">Support for the terminal</option>
					<option value="">Tertiary education</option>
					<option value="">Wildlife</option>
				</select>
			</div>
		<?php endfor; ?>


			<h2>SKILLS/RESOURCE BANK</h2>

			<div class="form-group">
				<label for="">What can your organisation contribute? </label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="What can your organisation contribute?"></textarea>
			</div>

			<div class="form-group">
				<label for="">Associated Organisations</label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="Associated organisations"></textarea>
			</div>

			<div class="form-group">
				<label for="">Needs / Wish list</label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="Needs / Wish list"></textarea>
			</div>

			<div class="checkbox">
			    <label>
			      <input type="checkbox"> Payment Made
			    </label>
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