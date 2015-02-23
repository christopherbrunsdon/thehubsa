<?php // move this to a require once ?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>


<form action="<?= esc_url( $_SERVER['REQUEST_URI']); ?>"  enctype="multipart/form-data" method="post">
	<h1>ORGANISATION REGISTRATION FORM</h1>

	<!-- Name of organisation -->

	<h2>NAME OF ORGANISATION</h2>

	<div class="form-group <?php $this->error_Name && print 'has-error' ?>">
		<label class="control-label" for="">NPO name : <?= $this->error_Name ?></label>
		<input type="text" name="Name" class="form-control" id="Name" placeholder="NPO name" value="<?= $this->Name; ?>"/>
	</div>

	<div class="form-group <?php $this->error_RegNumber && print 'has-error' ?>">
		<label class="control-label" for="">NPO registration number : <?= $this->error_RegNumber ?></label>
		<input type="text" value="<?= $this->RegNumber; ?>" name="RegNumber" class="form-control" id="RegNumber" placeholder="NPO registration number" />
	</div>

	<div class="form-group <?php $this->error_RegNumberOther && print 'has-error' ?>">
		<label class="control-label" for="">Other registration numbers and descriptions (not required) : <?= $this->error_RegNumberOther ?></label>
		<input type="text" value="<?= $this->RegNumberOther; ?>" name="RegNumberOther" class="form-control" id="RegNumberOther" placeholder="Other registration numbers" />
	</div>

	<!-- address type -->

	<div class="form-group <?php $this->error_Address && print 'has-error' ?>">
		<label class="control-label" for="">Physical address : <?= $this->error_Address ?></label>
		<textarea rows=4 type="text" name="Address" class="form-control" id="Address" placeholder="Physical address"><?= $this->Address; ?></textarea>
	</div>

	<div class="form-group  <?php $this->error_PostalAddress && print 'has-error' ?>">
		<label class="control-label" for="">Postal address : <?= $this->error_PostalAddress ?></label>
		<textarea rows=4 type="text" name="PostalAddress" class="form-control" id="PostalAddress" placeholder="Postal address"><?= $this->PostalAddress; ?></textarea>
	</div>


	<!-- contact details -->
	<h2>CONTACT DETAILS</h2>
	<div class="form-group  <?php $this->error_Contact && print 'has-error' ?>"> 
		<label class="control-label" for="">Contact person  (Title, First Name, Surname) : <?= $this->error_Contact ?></label>
		<input type="text" value="<?= $this->Contact; ?>" name="Contact" class="form-control" id="Contact" placeholder="Contact person " />
	</div>

	<div class="form-group  <?php $this->error_Tel && print 'has-error' ?>"> 
		<label class="control-label" for="">Telephone number  (example: +2721800000 no spaces) : <?= $this->error_Tel ?></label>
		<input type="text" value="<?= $this->Tel; ?>" name="Tel" class="form-control" id="Tel" placeholder="Telephone number " />
	</div>

	<div class="form-group  <?php $this->error_Mobile && print 'has-error' ?>"> 
		<label class="control-label" for="">Cell number  (example 0822222222222 no spaces) : <?= $this->error_Mobile ?></label>
		<input type="text" value="<?= $this->Mobile; ?>" name="Mobile" class="form-control" id="Mobile" placeholder="Cell number " />
	</div>

	<div class="form-group  <?php $this->error_Email && print 'has-error' ?>"> 
		<label class="control-label" for="">Email address : <?= $this->error_Email ?></label>
		<input type="text" value="<?= $this->Email; ?>" name="Email" class="form-control" id="Email" placeholder="Email address " />
	</div>

	<div class="form-group  <?php $this->error_wwwDomain && print 'has-error' ?>"> 
		<label class="control-label" for="">Website address : <?= $this->error_wwwDomain ?></label>
		<input type="text" value="<?= $this->wwwDomain; ?>" name="wwwDomain" class="form-control" id="wwwDomain" placeholder="Website address " />
	</div>

	<div class="form-group  <?php $this->error_wwwHomepage && print 'has-error' ?>"> 
		<label class="control-label" for="">Preferred link for listing  (if not your home page as above) : <?= $this->error_wwwHomepage ?></label>
		<input type="text" value="<?= $this->wwwHomepage; ?>" name="wwwHomepage" class="form-control" id="wwwHomepage" placeholder="Preferred link for listing " />
	</div>

	<div class="form-group  <?php $this->error_wwwFacebook && print 'has-error' ?>"> 
		<label class="control-label" for="">Facebook page : <?= $this->error_wwwFacebook ?></label>
		<input type="text" value="<?= $this->wwwFacebook; ?>" name="wwwFacebook" class="form-control" id="wwwFacebook" placeholder="Facebook page " />
	</div>

	<div class="form-group  <?php $this->error_LogoPath && print 'has-error' ?>"> 
		<label class="control-label" for="">Logo : <?= $this->error_LogoPath ?></label><br />
		<small>Maximum size of 1000px x 1000px. JPEG or PNG format.</small>		
		<input type="file" name="logo" class="form-control" id="" placeholder="Logo" />
	
		<input type="hidden" value="<?= $this->LogoPath; ?>" name="LogoPath" />
		<?php /**if($this->get_logo_url()): ?>
			<img src="<?= $this->get_logo_url(); ?>" />
			<input type="hidden" value="<?= $this->get_logo_url(); ?>" name="logo-url" />
		<?php endif; **/?>
	</div>
	<div>
	</div>


<?php /*** for($i=1; $i <= 5; $i++): ?>
	<div class="form-group  <?php $this->error_serviceffered-<?= $i ?>') && print 'has-error' ?>"> 
		<?php if($i == 1) : ?><label class="control-label" for="">Services offered (in order of importance) : <?= $this->error_serviceffered-<?= $i ?>') ?></label><?php endif ?>

		<div class="input-group">
			<div class="input-group-addon"><?= $i ?>.</div>

			<select  class="form-control" name="service-offered-<?= $i ?>" id="services_<?= $i; ?>">
				<option>-- Services offered --</option>
				<?php foreach($services as $service): ?>
					<option value="<?= $service->id ?>" <?php $this->service-offered-'.$i) ==  $service->id && print 'selected'; ?> ><?= $service->Service; ?></option>
				<?php endforeach; ?>
				<option value="-- Other --" id="services_other_<?= $i; ?>" <?php $this->service-offered-'.$i) == '-- Other --' && print 'selected'; ?>   >-- Other (Please indicate) --</option>					
			</select>
		</div>

		<div <?php $this->service-offered-'.$i) != '-- Other --' && print 'style="display: none;"' ?> id="service_other_input_<?= $i; ?>">
			<div class="input-group">
				<div class="input-group-addon">Other:</div>
				<input  type="text" value="<?= $this->service-offered-other-'.$i); ?>" name="service-offered-other-<?= $i ?>" class="form-control"  placeholder="Other (Please inidcate)" />
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
<?php endfor; ***/ ?>


	<div class="form-group  <?php $this->error_Description && print 'has-error' ?>">
		<label class="control-label" for="">Give a short description (400 characters or less) of your organisation : <?= $this->error_Description ?></label>
		<textarea rows=4 name="Description" type="text" class="form-control" id="" placeholder="Give a short description (400 characters or less) of your organisation"><?= $this->Description; ?></textarea>
	</div>



	<h2>SKILLS/RESOURCE BANK</h2>

	<div class="form-group  <?php $this->error_ServicesOffered && print 'has-error' ?>">
		<label class="control-label" for="">What can your organisation offer to the community (eg training, office space, haircuts) : <?= $this->error_ServicesOffered; ?></label>
		<textarea rows=4 name="ServicesOffered" type="text" class="form-control" id="" placeholder="What can your organisation offer to the community (eg training, office space, haircuts)"><?= $this->ServicesOffered; ?></textarea>
	</div>

	<div class="form-group  <?php $this->error_AssociatedOrganisations && print 'has-error' ?>">
		<label class="control-label" for="">Associated Organisations : <?= $this->error_AssociatedOrganisations ?></label>
		<textarea rows=4 name="AssociatedOrganisations" type="text" class="form-control" id="" placeholder="Associated organisations"><?= $this->AssociatedOrganisations; ?></textarea>
	</div>

	<div class="form-group  <?php $this->error_listNeeds && print 'has-error' ?>">
		<label class="control-label" for="">Needs list : <?= $this->error_listNeeds ?></label>
		<textarea rows=4 name="listNeeds" type="text" class="form-control" id="" placeholder="Needs list"><?= $this->listNeeds; ?></textarea>
	</div>

	<div class="form-group  <?php $this->error_listWish && print 'has-error' ?>">
		<label class="control-label" for=""> Wish list : <?= $this->error_listWish ?></label>
		<textarea rows=4 name="listWish" type="text" class="form-control" id="" placeholder="Wish list"><?= $this->listWish; ?></textarea>
	</div>

	<?php if(!isset($this->show_banking) || $this->show_banking): ?>
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

		<div class="form-group  <?php $this->error_paymentEft && print 'has-error' ?>">
			<div class="checkbox">
			    <label class="control-label">
			      <input name="paymentEft" <?php $this->paymentEft && print 'checked' ?> onclick="$('#btn-submit').prop('disabled', false).addClass('btn-primary').removeClass('btn-default');" type="checkbox"> 
			      Payment Made via EFT <?= $this->error_paymentEft ?>
			    </label>
			 </div>
			<div class="checkbox">
			    <label class="control-label">
			      <input name="paymentDeposit" <?php $this->paymentDeposit && print 'checked' ?> onclick="$('#btn-submit').prop('disabled', false).addClass('btn-primary').removeClass('btn-default');" type="checkbox"> 
			      Payment Made via Deposit <?= $this->error_paymentDeposit ?>
			    </label>
			</div>
		</div>
	<?php endif; ?>


	<?php if($this->id): ?>
		<input type="hidden" value="<?= $this->id; ?>" name="id" id="id" />
		<button id="btn-submit" type="submit" class="btn btn-default" name="submit">Update</button>	
	<?php else: ?>
		<button id="btn-submit" disabled type="submit" class="btn btn-default" name="submit">Submit</button>
	<?php endif; ?>

	&nbsp;&nbsp;|&nbsp;&nbsp;<a href="">Reset Form</a>

</form>	