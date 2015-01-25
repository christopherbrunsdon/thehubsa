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
		<!-- jquery -->
		<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
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
				<label for="">NPO name</label>
				<input type="text" class="form-control" id="" placeholder="NPO name" />
			</div>

			<div class="form-group">
				<label for="">NPO registration number</label>
				<input type="text" class="form-control" id="" placeholder="NPO registration number" />
			</div>

			<div class="form-group">
				<label for="">Other registration numbers and descriptions (not required) </label>
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
				<label for="">Contact person  (Title, First Name, Surname)</label>
				<input type="text" class="form-control" id="" placeholder="Contact person " />
			</div>

			<div class="form-group"> 
				<label for="">Telephone number  (example: +2721800000 no spaces)"</label>
				<input type="text" class="form-control" id="" placeholder="Telephone number " />
			</div>

			<div class="form-group"> 
				<label for="">Cell number  (example 0822222222222 no spaces)</label>
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
				<label for="">Preferred link for listing  (if not your home page as above)</label>
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
				<?php if($i == 1) : ?><label for="">Services offered (in order of importance)</label><?php endif ?>

				<div class="input-group">
					<div class="input-group-addon"><?= $i ?>.</div>

					<select  class="form-control" id="services_<?= $i; ?>">
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
						<option value="-- Other --" id="services_other_<?= $i; ?>">-- Other (Please indicate) --</option>					
					</select>
				</div>

				<div style="display: none;" id="service_other_input_<?= $i; ?>">
					<div class="input-group">
						<div class="input-group-addon">Other:</div>
						<input  type="text" class="form-control"  placeholder="Other (Please inidcate)" />
					</div>
				</div>
			</div>

			<script type="text/javascript">
				$('#services_<?= $i; ?>').change(function(){
					var selected_item = $(this).val()
					if(selected_item == "-- Other --"){ // 'Other' 
					    $('#service_other_input_<?= $i; ?>').show(); //show textbox if Other is selected
					}else{
					    $('#service_other_input_<?= $i; ?>').hide(); //Hide textbox if anything else is selected
					}
				});
			</script>
		<?php endfor; ?>


			<div class="form-group">
				<label for="">Give a short description (400 characters or less) of your organisation</label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="Give a short description (400 characters or less) of your organisation"></textarea>
			</div>



			<h2>SKILLS/RESOURCE BANK</h2>

			<div class="form-group">
				<label for="">What can your organisation offer to the community (eg training, office space, haircuts) </label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="What can your organisation offer to the community (eg training, office space, haircuts)"></textarea>
			</div>

			<div class="form-group">
				<label for="">Associated Organisations</label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="Associated organisations"></textarea>
			</div>

			<div class="form-group">
				<label for="">Needs list</label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="Needs list"></textarea>
			</div>

			<div class="form-group">
				<label for=""> Wish list</label>
				<textarea rows=4 type="text" class="form-control" id="" placeholder="Wish list"></textarea>
			</div>

			<p>
				The HUB SA Helderberg reserves the right to accept/decline any affiliation.
			</p>
			<p>
				The HUB SA Helderberg, including its committee and other members and any other person acting on behalf of The HUB SA Helderberg (“The HUB SA Helderberg”) is hereby absolved from all and any liability or claims of whatsoever nature for loss or damage (including any special or consequential damages) arising directly or indirectly out of or flowing from any services or assistance rendered or function fulfilled or activity carried out to any person or party by The HUB SA Helderberg , provided that The HUB SA Helderberg acted in good faith and in a reasonable manner.
			</p>
			<p>
				Commitment fee: R200
			</p>
			<p>
				Applicable on submission of registration form (non-refundable)
			</p>
			<p>
				Thereafter an annual fee will apply. The fee is about giving a monetary value to the commitment you are making.
			</p>
			<p>
				<h4>Bank details: </h4> <br />
				<strong>Name: </strong> The HUB SA Helderberg <br />
				<strong>Bank: </strong> FNB <br />
				<strong>ACCOUNT TYPE: </strong> Business Cheque <br />
				<strong>Account number: </strong> 62501541339 <br />
				<strong>Branch code: </strong> 200912 – Somerset Mall <br />
				<strong>Confirmation of payment:</strong> lynettepullen@gmail.com
			</p>

			<div class="checkbox">
			    <label>
			      <input onclick="$('#btn-submit').prop('disabled', false).addClass('btn-primary').removeClass('btn-default');" type="checkbox"> 
			      Payment Made via EFT
			    </label>
			 </div>
			<div class="checkbox">
			    <label>
			      <input onclick="$('#btn-submit').prop('disabled', false).addClass('btn-primary').removeClass('btn-default');" type="checkbox"> 
			      Payment Made via Deposit
			    </label>
			 </div>

			<button id="btn-submit" disabled type="submit" class="btn btn-default">Submit</button>
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