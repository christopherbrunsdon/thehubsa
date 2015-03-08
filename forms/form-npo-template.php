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

	<div class="form-group <?php isset($this->error->Name) && print 'has-error' ?>">
		<label class="control-label" for="">NPO name : <?= $this->error->Name ?></label>
		<input type="text" name="Name" class="form-control" id="Name" placeholder="NPO name" value="<?= $this->npo->Name; ?>"/>
	</div>

	<div class="form-group <?php isset($this->error->RegNumber) && print 'has-error' ?>">
		<label class="control-label" for="">NPO registration number : <?= $this->error->RegNumber ?></label>
		<input type="text" value="<?= $this->npo->RegNumber; ?>" name="RegNumber" class="form-control" id="RegNumber" placeholder="NPO registration number" />
	</div>

	<div class="form-group <?php isset($this->error->RegNumberOther) && print 'has-error' ?>">
		<label class="control-label" for="">Other registration numbers and descriptions (not required) : <?= $this->error->RegNumberOther ?></label>
		<input type="text" value="<?= $this->npo->RegNumberOther; ?>" name="RegNumberOther" class="form-control" id="RegNumberOther" placeholder="Other registration numbers" />
	</div>

	<!-- address type -->

	<div class="form-group <?php isset($this->error->Address) && print 'has-error' ?>">
		<label class="control-label" for="">Physical address : <?= $this->error->Address ?></label>
		<textarea rows=4 type="text" name="Address" class="form-control" id="Address" placeholder="Physical address"><?= $this->npo->Address; ?></textarea>
	</div>

	<div class="form-group  <?php isset($this->error->AddressPostal) && print 'has-error' ?>">
		<label class="control-label" for="">Postal address : <?= $this->error->AddressPostal ?></label>
		<textarea rows=4 type="text" name="AddressPostal" class="form-control" id="AddressPostal" placeholder="Postal address"><?= $this->npo->AddressPostal; ?></textarea>
	</div>


	<!-- contact details -->
	<h2>CONTACT DETAILS</h2>
	<div class="form-group  <?php isset($this->error->Contact) && print 'has-error' ?>">
		<label class="control-label" for="">Contact person  (Title, First Name, Surname) : <?= $this->error->Contact ?></label>
		<input type="text" value="<?= $this->npo->Contact; ?>" name="Contact" class="form-control" id="Contact" placeholder="Contact person " />
	</div>

	<div class="form-group  <?php isset($this->error->Tel) && print 'has-error' ?>">
		<label class="control-label" for="">Telephone number  (example: +2721800000 no spaces) : <?= $this->error->Tel ?></label>
		<input type="text" value="<?= $this->npo->Tel; ?>" name="Tel" class="form-control" id="Tel" placeholder="Telephone number " />
	</div>

	<div class="form-group  <?php isset($this->error->Mobile) && print 'has-error' ?>">
		<label class="control-label" for="">Cell number  (example 0822222222222 no spaces) : <?= $this->error->Mobile ?></label>
		<input type="text" value="<?= $this->npo->Mobile; ?>" name="Mobile" class="form-control" id="Mobile" placeholder="Cell number " />
	</div>

	<div class="form-group  <?php isset($this->error->Email) && print 'has-error' ?>">
		<label class="control-label" for="">Email address : <?= $this->error->Email ?></label>
		<input type="text" value="<?= $this->npo->Email; ?>" name="Email" class="form-control" id="Email" placeholder="Email address " />
	</div>

	<div class="form-group  <?php isset($this->error->wwwDomain) && print 'has-error' ?>">
		<label class="control-label" for="">Website address : <?= $this->error->wwwDomain ?></label>
		<input type="text" value="<?= $this->npo->wwwDomain; ?>" name="wwwDomain" class="form-control" id="wwwDomain" placeholder="Website address " />
	</div>

	<div class="form-group  <?php isset($this->error->wwwHomepage) && print 'has-error' ?>">
		<label class="control-label" for="">Preferred link for listing  (if not your home page as above) : <?= $this->error->wwwHomepage ?></label>
		<input type="text" value="<?= $this->npo->wwwHomepage; ?>" name="wwwHomepage" class="form-control" id="wwwHomepage" placeholder="Preferred link for listing " />
	</div>

	<div class="form-group  <?php isset($this->error->wwwFacebook) && print 'has-error' ?>">
		<label class="control-label" for="">Facebook page : <?= $this->error->wwwFacebook ?></label>
		<input type="text" value="<?= $this->npo->wwwFacebook; ?>" name="wwwFacebook" class="form-control" id="wwwFacebook" placeholder="Facebook page " />
	</div>

	<div class="form-group  <?php isset($this->error->LogoPath) && print 'has-error' ?>">
		<label class="control-label" for="">Logo : <?= $this->error->LogoPath ?></label><br />
		<small>Maximum size of 1000px x 1000px. JPEG or PNG format.</small>		
		<input type="file" name="logo" class="form-control" id="" placeholder="Logo" />
	
		<input type="hidden" value="<?= $this->npo->LogoPath; ?>" id="LogoPath" name="LogoPath" />
		<?php if($this->npo->get_logo_url()): ?>
			<img src="<?= $this->npo->get_logo_url(); ?>" />
		<?php endif; ?>
	</div>
	<div>
	</div>


<?php for($i=1; $i <= model_thehub_npo_services::NUMBER_PER_NPO; $i++): ?>
	<div class="form-group <?php $this->error->service_offered_{$i} && print 'has-error' ?>">
		<?php if($i == 1) : ?><label class="control-label" for="">Services offered (in order of importance) : <?= $this->error->service_offered_{$i} ?></label><?php endif ?>

		<div class="input-group">
			<div class="input-group-addon"><?= $i ?>.</div>
			<select  class="form-control" name="service-offered-<?= $i ?>" id="services_<?= $i; ?>">
				<option>-- Services offered --</option>
				<?php foreach($services as $service): ?>
					<option value="<?= $service->id ?>" <?php $this->npo->_npo_services[$i-1]->fkService == $service->id && print 'selected'; ?> ><?= $service->Service; ?></option>
				<?php endforeach; ?>
				<option value="-1" id="services_other_<?= $i; ?>" <?php !$this->npo->_npo_services[$i-1]->fkService && $this->npo->_npo_services[$i-1]->ServiceOther && print 'selected'; ?>   >-- Other (Please indicate) --</option>
			</select>
		</div>

		<div <?php ($this->npo->_npo_services[$i-1]->fkService || !$this->npo->_npo_services[$i-1]->ServiceOther) && print 'style="display: none;"' ?> id="service_other_input_<?= $i; ?>">
			<div class="input-group">
				<div class="input-group-addon">Other:</div>
				<input  type="text" value="<?= $this->npo->_npo_services[$i-1]->ServiceOther ?>" name="service-offered-other-<?= $i ?>" class="form-control"  placeholder="Other (Please indicate)" />
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('#services_<?= $i; ?>').change(function(){
			var selected_item = $(this).val()
			if(selected_item == -1){ // 'Other'
			    $('#service_other_input_<?= $i; ?>').show(); //show textbox if Other is selected
			}else{
			    $('#service_other_input_<?= $i; ?>').hide(); //Hide textbox if anything else is selected
			}
		});
	</script>
<?php endfor; ?>


	<div class="form-group  <?php isset($this->error->Description) && print 'has-error' ?>">
		<label class="control-label" for="">Give a short description (400 characters or less) of your organisation : <?= $this->error->Description ?></label>
		<textarea rows=4 name="Description" type="text" class="form-control" id="" placeholder="Give a short description (400 characters or less) of your organisation"><?= $this->npo->Description; ?></textarea>
	</div>



	<h2>SKILLS/RESOURCE BANK</h2>

	<div class="form-group  <?php isset($this->error->ServicesOffered) && print 'has-error' ?>">
		<label class="control-label" for="">What can your organisation offer to the community (eg training, office space, haircuts) : <?= $this->error->ServicesOffered; ?></label>
		<textarea rows=4 name="ServicesOffered" type="text" class="form-control" id="" placeholder="What can your organisation offer to the community (eg training, office space, haircuts)"><?= $this->npo->ServicesOffered; ?></textarea>
	</div>

	<div class="form-group  <?php isset($this->error->AssociatedOrganisations) && print 'has-error' ?>">
		<label class="control-label" for="">Associated Organisations : <?= $this->error->AssociatedOrganisations ?></label>
		<textarea rows=4 name="AssociatedOrganisations" type="text" class="form-control" id="" placeholder="Associated organisations"><?= $this->npo->AssociatedOrganisations; ?></textarea>
	</div>

	<div class="form-group  <?php isset($this->error->listNeeds) && print 'has-error' ?>">
		<label class="control-label" for="">Needs list : <?= $this->error->listNeeds ?></label>
		<textarea rows=4 name="listNeeds" type="text" class="form-control" id="" placeholder="Needs list"><?= $this->npo->listNeeds; ?></textarea>
	</div>

	<div class="form-group  <?php isset($this->error->listWish) && print 'has-error' ?>">
		<label class="control-label" for=""> Wish list : <?= $this->error->listWish ?></label>
		<textarea rows=4 name="listWish" type="text" class="form-control" id="" placeholder="Wish list"><?= $this->npo->listWish; ?></textarea>
	</div>

	<?php if(!$this->npo->id): //!isset($this->npo->show_banking) || $this->npo->show_banking): ?>
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

		<div class="form-group  <?php isset($this->error->paymentEft) && print 'has-error' ?>">
			<div class="checkbox">
			    <label class="control-label">
			      <input value=1 name="paymentEft" <?php $this->npo->paymentEft && print 'checked' ?> onclick="$('#btn-submit').prop('disabled', false).addClass('btn-primary').removeClass('btn-default');" type="checkbox">
			      Payment Made via EFT <?= $this->error->paymentEft ?>
			    </label>
			 </div>
			<div class="checkbox">
			    <label class="control-label">
			      <input value=1 name="paymentDeposit" <?php $this->npo->paymentDeposit && print 'checked' ?> onclick="$('#btn-submit').prop('disabled', false).addClass('btn-primary').removeClass('btn-default');" type="checkbox">
			      Payment Made via Deposit <?= $this->error->paymentDeposit ?>
			    </label>
			</div>
		</div>
	<?php endif; ?>


	<?php if($this->npo->id): ?>
		<input type="hidden" value="<?= $this->npo->id; ?>" name="id" id="id" />
        <input type="hidden" value="<?= $this->npo->is_active(); ?>" name="bActive" id="bActive" />
        <button id="btn-submit" type="submit" class="btn btn-default" name="submit">Update</button>
	<?php else: ?>
		<button id="btn-submit" <?php !$this->npo->paymentEft && !$this->npo->paymentDeposit && print "disabled "?> type="submit" class="btn btn-default" name="submit">Submit</button>
	<?php endif; ?>

	&nbsp;&nbsp;|&nbsp;&nbsp;<a href="">Reset Form</a>

</form>

