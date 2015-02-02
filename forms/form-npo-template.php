<?php // move this to a require once ?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>


<form action="<?= esc_url( $_SERVER['REQUEST_URI']); ?>" method="post">
	<h1>ORGANISATION REGISTRATION FORM</h1>

	<!-- Name of organisation -->

	<h2>NAME OF ORGANISATION</h2>

	<div class="form-group <?php $this->hasError('npo-name') && print 'has-error' ?>">
		<label class="control-label" for="">NPO name : <?= $this->getError('npo-name') ?></label>
		<input type="text" name="npo-name" class="form-control" id="" placeholder="NPO name" value="<?= $this->getValue('npo-name'); ?>"/>
	</div>

	<div class="form-group <?php $this->hasError('npo-reg-number') && print 'has-error' ?>">
		<label class="control-label" for="">NPO registration number : <?= $this->getError('npo-reg-number') ?></label>
		<input type="text" value="<?= $this->getValue('npo-reg-number'); ?>" name="npo-reg-number" class="form-control" id="" placeholder="NPO registration number" />
	</div>

	<div class="form-group <?php $this->hasError('npo-reg-other') && print 'has-error' ?>">
		<label class="control-label" for="">Other registration numbers and descriptions (not required) : <?= $this->getError('npo-reg-other') ?></label>
		<input type="text" value="<?= $this->getValue('npo-reg-other'); ?>" name="npo-reg-other" class="form-control" id="" placeholder="Other registration numbers" />
	</div>

	<!-- address type -->

	<div class="form-group <?php $this->hasError('npo-address') && print 'has-error' ?>">
		<label class="control-label" for="">Physical address : <?= $this->getError('npo-address') ?></label>
		<textarea rows=4 type="text" name="npo-address" class="form-control" id="" placeholder="Physical address"><?= $this->getValue('npo-address'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('npo-postal') && print 'has-error' ?>">
		<label class="control-label" for="">Postal address : <?= $this->getError('npo-postal') ?></label>
		<textarea rows=4 type="text" name="npo-postal" class="form-control" id="" placeholder="Postal address"><?= $this->getValue('npo-postal'); ?></textarea>
	</div>


	<!-- contact details -->
	<h2>CONTACT DETAILS</h2>
	<div class="form-group  <?php $this->hasError('npo-contact') && print 'has-error' ?>"> 
		<label class="control-label" for="">Contact person  (Title, First Name, Surname) : <?= $this->getError('npo-contact') ?></label>
		<input type="text" value="<?= $this->getValue('npo-contact'); ?>" name="npo-contact" class="form-control" id="" placeholder="Contact person " />
	</div>

	<div class="form-group  <?php $this->hasError('npo-tel') && print 'has-error' ?>"> 
		<label class="control-label" for="">Telephone number  (example: +2721800000 no spaces) : <?= $this->getError('npo-tel') ?></label>
		<input type="text" value="<?= $this->getValue('npo-tel'); ?>" name="npo-tel" class="form-control" id="" placeholder="Telephone number " />
	</div>

	<div class="form-group  <?php $this->hasError('npo-mobile') && print 'has-error' ?>"> 
		<label class="control-label" for="">Cell number  (example 0822222222222 no spaces) : <?= $this->getError('npo-mobile') ?></label>
		<input type="text" value="<?= $this->getValue('npo-mobile'); ?>" name="npo-mobile" class="form-control" id="" placeholder="Cell number " />
	</div>

	<div class="form-group  <?php $this->hasError('npo-email') && print 'has-error' ?>"> 
		<label class="control-label" for="">Email address : <?= $this->getError('npo-email') ?></label>
		<input type="text" value="<?= $this->getValue('npo-email'); ?>" name="npo-email" class="form-control" id="" placeholder="Email address " />
	</div>

	<div class="form-group  <?php $this->hasError('npo-website') && print 'has-error' ?>"> 
		<label class="control-label" for="">Website address : <?= $this->getError('npo-website') ?></label>
		<input type="text" value="<?= $this->getValue('npo-website'); ?>" name="npo-website" class="form-control" id="" placeholder="Website address " />
	</div>

	<div class="form-group  <?php $this->hasError('npo-url') && print 'has-error' ?>"> 
		<label class="control-label" for="">Preferred link for listing  (if not your home page as above) : <?= $this->getError('npo-url') ?></label>
		<input type="text" value="<?= $this->getValue('npo-url'); ?>" name="npo-url" class="form-control" id="" placeholder="Preferred link for listing " />
	</div>

	<div class="form-group  <?php $this->hasError('npo-facebook') && print 'has-error' ?>"> 
		<label class="control-label" for="">Facebook page : <?= $this->getError('npo-facebook') ?></label>
		<input type="text" value="<?= $this->getValue('npo-facebook'); ?>" name="npo-facebook" class="form-control" id="" placeholder="Facebook page " />
	</div>

<!-- 			<div class="form-group  <?php $this->hasError('npo-xxx') && print 'has-error' ?>"> 
		<label class="control-label" for="">Operating hours  <?= $this->getError('npo-xxx') ?></label>
		<input type="text" class="form-control" id="" placeholder="Operating hours " />
	</div>
-->
<?php for($i=1; $i <= 5; $i++): ?>
	<div class="form-group  <?php $this->hasError('npo-service-offered-<?= $i ?>') && print 'has-error' ?>"> 
		<?php if($i == 1) : ?><label class="control-label" for="">Services offered (in order of importance) : <?= $this->getError('npo-service-offered-<?= $i ?>') ?></label><?php endif ?>

		<div class="input-group">
			<div class="input-group-addon"><?= $i ?>.</div>

			<select  class="form-control" name="npo-service-offered-<?= $i ?>" id="services_<?= $i; ?>">
				<option>-- Services offered --</option>
				<?php foreach($services as $service): ?>
					<option value="<?= $service->id ?>" <?php $this->getValue('npo-service-offered-'.$i) ==  $service->id && print 'selected'; ?> ><?= $service->Service; ?></option>
				<?php endforeach; ?>
				<option value="-- Other --" id="services_other_<?= $i; ?>" <?php $this->getValue('npo-service-offered-'.$i) == '-- Other --' && print 'selected'; ?>   >-- Other (Please indicate) --</option>					
			</select>
		</div>

		<div <?php $this->getValue('npo-service-offered-'.$i) != '-- Other --' && print 'style="display: none;"' ?> id="service_other_input_<?= $i; ?>">
			<div class="input-group">
				<div class="input-group-addon">Other:</div>
				<input  type="text" value="<?= $this->getValue('npo-service-offered-other-'.$i); ?>" name="npo-service-offered-other-<?= $i ?>" class="form-control"  placeholder="Other (Please inidcate)" />
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


	<div class="form-group  <?php $this->hasError('npo-description') && print 'has-error' ?>">
		<label class="control-label" for="">Give a short description (400 characters or less) of your organisation : <?= $this->getError('npo-description') ?></label>
		<textarea rows=4 name="npo-description" type="text" class="form-control" id="" placeholder="Give a short description (400 characters or less) of your organisation"><?= $this->getValue('npo-description'); ?></textarea>
	</div>



	<h2>SKILLS/RESOURCE BANK</h2>

	<div class="form-group  <?php $this->hasError('npo-services-other') && print 'has-error' ?>">
		<label class="control-label" for="">What can your organisation offer to the community (eg training, office space, haircuts) : <?= $this->getError('npo-services-other') ?></label>
		<textarea rows=4 name="npo-services-other" type="text" class="form-control" id="" placeholder="What can your organisation offer to the community (eg training, office space, haircuts)"><?= $this->getValue('npo-services-other'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('npo-associated') && print 'has-error' ?>">
		<label class="control-label" for="">Associated Organisations : <?= $this->getError('npo-associated') ?></label>
		<textarea rows=4 name="npo-associated" type="text" class="form-control" id="" placeholder="Associated organisations"><?= $this->getValue('npo-associated'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('npo-needs') && print 'has-error' ?>">
		<label class="control-label" for="">Needs list : <?= $this->getError('npo-needs') ?></label>
		<textarea rows=4 name="npo-needs" type="text" class="form-control" id="" placeholder="Needs list"><?= $this->getValue('npo-needs'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('npo-wishlist') && print 'has-error' ?>">
		<label class="control-label" for=""> Wish list : <?= $this->getError('npo-wishlist') ?></label>
		<textarea rows=4 name="npo-wishlist" type="text" class="form-control" id="" placeholder="Wish list"><?= $this->getValue('npo-wishlist'); ?></textarea>
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

	<div class="form-group  <?php $this->hasError('npo-payment-eft') && print 'has-error' ?>">
		<div class="checkbox">
		    <label class="control-label">
		      <input name="npo-payment-eft" <?php $this->getValue('npo-payment-eft') && print 'checked' ?> onclick="$('#btn-submit').prop('disabled', false).addClass('btn-primary').removeClass('btn-default');" type="checkbox"> 
		      Payment Made via EFT <?= $this->getError('npo-payment-eft') ?>
		    </label>
		 </div>
		<div class="checkbox">
		    <label class="control-label">
		      <input name="npo-payment-deposit" <?php $this->getValue('npo-payment-deposit') && print 'checked' ?> onclick="$('#btn-submit').prop('disabled', false).addClass('btn-primary').removeClass('btn-default');" type="checkbox"> 
		      Payment Made via Deposit <?= $this->getError('npo-payment-deposit') ?>
		    </label>
		</div>
	</div>

	<button id="btn-submit" disabled type="submit" class="btn btn-default" name="npo-submit">Submit</button>
	&nbsp;&nbsp;|&nbsp;&nbsp;<a href="">Reset Form</a>
</form>	