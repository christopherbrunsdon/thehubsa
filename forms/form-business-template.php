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
	<h1>BUSINESS/COMPANY REGISTRATION FORM</h1>

	<!-- Name of organisation -->

	<h2>NAME OF ORGANISATION</h2>

	<div class="form-group <?php $this->hasError('business-name') && print 'has-error' ?>">
		<label class="control-label" for="">Name Of Business : <?= $this->getError('business-name') ?></label>
		<input type="text" name="business-name" class="form-control" id="" placeholder="Name Of Business" value="<?= $this->getValue('business-name'); ?>"/>
	</div>

	<div class="form-group <?php $this->hasError('business-reg-number') && print 'has-error' ?>">
		<label class="control-label" for="">Company Registration Number &amp; Date Of Registration : <?= $this->getError('business-reg-number') ?></label>
		<input type="text" value="<?= $this->getValue('business-reg-number'); ?>" name="business-reg-number" class="form-control" id="" placeholder="Company Registration Number &amp; Date Of Registration" />
	</div>


	<!-- address type -->

	<div class="form-group <?php $this->hasError('business-address') && print 'has-error' ?>">
		<label class="control-label" for="">Physical address : <?= $this->getError('business-address') ?></label>
		<textarea rows=4 type="text" name="business-address" class="form-control" id="" placeholder="Physical address"><?= $this->getValue('business-address'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('business-postal') && print 'has-error' ?>">
		<label class="control-label" for="">Postal address : <?= $this->getError('business-postal') ?></label>
		<textarea rows=4 type="text" name="business-postal" class="form-control" id="" placeholder="Postal address"><?= $this->getValue('business-postal'); ?></textarea>
	</div>


	<!-- contact details -->
	<h2>CONTACT DETAILS</h2>
	<div class="form-group  <?php $this->hasError('business-contact') && print 'has-error' ?>"> 
		<label class="control-label" for="">Contact person  (Title, First Name, Surname) : <?= $this->getError('business-contact') ?></label>
		<input type="text" value="<?= $this->getValue('business-contact'); ?>" name="business-contact" class="form-control" id="" placeholder="Contact person " />
	</div>

	<div class="form-group  <?php $this->hasError('business-tel') && print 'has-error' ?>"> 
		<label class="control-label" for="">Telephone number  (example: +2721800000 no spaces) : <?= $this->getError('business-tel') ?></label>
		<input type="text" value="<?= $this->getValue('business-tel'); ?>" name="business-tel" class="form-control" id="" placeholder="Telephone number " />
	</div>

	<div class="form-group  <?php $this->hasError('business-mobile') && print 'has-error' ?>"> 
		<label class="control-label" for="">Cell number  (example 0822222222222 no spaces) : <?= $this->getError('business-mobile') ?></label>
		<input type="text" value="<?= $this->getValue('business-mobile'); ?>" name="business-mobile" class="form-control" id="" placeholder="Cell number " />
	</div>

	<div class="form-group  <?php $this->hasError('business-email') && print 'has-error' ?>"> 
		<label class="control-label" for="">Email address : <?= $this->getError('business-email') ?></label>
		<input type="text" value="<?= $this->getValue('business-email'); ?>" name="business-email" class="form-control" id="" placeholder="Email address " />
	</div>

	<div class="form-group  <?php $this->hasError('business-website') && print 'has-error' ?>"> 
		<label class="control-label" for="">Website address : <?= $this->getError('business-website') ?></label>
		<input type="text" value="<?= $this->getValue('business-website'); ?>" name="business-website" class="form-control" id="" placeholder="Website address " />
	</div>

<!-- 	<div class="form-group  <?php $this->hasError('business-url') && print 'has-error' ?>"> 
		<label class="control-label" for="">Preferred link for listing  (if not your home page as above) : <?= $this->getError('business-url') ?></label>
		<input type="text" value="<?= $this->getValue('business-url'); ?>" name="business-url" class="form-control" id="" placeholder="Preferred link for listing " />
	</div>
 -->
	<div class="form-group  <?php $this->hasError('business-facebook') && print 'has-error' ?>"> 
		<label class="control-label" for="">Facebook page : <?= $this->getError('business-facebook') ?></label>
		<input type="text" value="<?= $this->getValue('business-facebook'); ?>" name="business-facebook" class="form-control" id="" placeholder="Facebook page " />
	</div>

	<div class="form-group  <?php $this->hasError('business-Operating Hours') && print 'has-error' ?>"> 
		<label class="control-label" for="">Operating Hours: <?= $this->getError('business-Operating Hours') ?></label>
		<input type="text" value="<?= $this->getValue('business-Operating Hours'); ?>" name="business-Operating Hours" class="form-control" id="" placeholder="Operating Hours" />
	</div>

<!-- 
	<div class="form-group  <?php $this->hasError('business-description') && print 'has-error' ?>">
		<label class="control-label" for="">Give a short description (400 characters or less) of your organisation : <?= $this->getError('business-description') ?></label>
		<textarea rows=4 name="business-description" type="text" class="form-control" id="" placeholder="Give a short description (400 characters or less) of your organisation"><?= $this->getValue('business-description'); ?></textarea>
	</div> -->



<!-- 	<h2>SKILLS/RESOURCE BANK</h2>
 -->
	<div class="form-group  <?php $this->hasError('business-services-other') && print 'has-error' ?>">
		<label class="control-label" for="">Services Offered : <?= $this->getError('business-services-other') ?></label>
		<textarea rows=4 name="business-services-other" type="text" class="form-control" id="" placeholder="Services Offered"><?= $this->getValue('business-services-other'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('business-skills-banks') && print 'has-error' ?>">
		<label class="control-label" for="">Skills Bank : <?= $this->getError('business-skills-banks') ?></label>
		<textarea rows=4 name="business-skills-banks" type="text" class="form-control" id="" placeholder="Skills Bank"><?= $this->getValue('business-skills-banks'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('business-associated') && print 'has-error' ?>">
		<label class="control-label" for="">Other Organisations Associated With : <?= $this->getError('business-associated') ?></label>
		<textarea rows=4 name="business-associated" type="text" class="form-control" id="" placeholder="Other Organisations Associated With"><?= $this->getValue('business-associated'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('business-needs') && print 'has-error' ?>">
		<label class="control-label" for="">Area Of Social Responsibility? <?= $this->getError('business-needs') ?></label>
		<textarea rows=4 name="business-needs" type="text" class="form-control" id="" placeholder="Area Of Social Responsibility?"><?= $this->getValue('business-needs'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('business-donation-time') && print 'has-error' ?>">
		<label class="control-label" for=""> Donation of Time? Describe : <?= $this->getError('business-donation-time') ?></label>
		<textarea rows=4 name="business-donation-time" type="text" class="form-control" id="" placeholder="Donation of Time? Describe"><?= $this->getValue('business-wishlist'); ?></textarea>
	</div>

	<div class="form-group  <?php $this->hasError('business-donation-goods') && print 'has-error' ?>">
		<label class="control-label" for=""> Donation of Goods? Describe : <?= $this->getError('business-donation-goods') ?></label>
		<textarea rows=4 name="business-donation-goods" type="text" class="form-control" id="" placeholder="Donation of Goods? Describe"><?= $this->getValue('business-wishlist'); ?></textarea>
	</div>

	<h3>Disclaimer</h3>

	<p>
The HUB SA Helderberg, including its committee and other members and any other person acting on
behalf of The HUB SA Helderberg (“The HUB SA Helderberg”) is hereby absolved from all and any 
liability or claims of whatsoever nature  for loss or damage (including any special or consequential 
damages)  arising directly or indirectly out of or flowing from any services or assistance rendered or 
function fulfilled or activity carried out to any person or party by The HUB SA Helderberg , provided 
that The HUB SA Helderberg acted in good faith and in a reasonable manner.
	</p>

<p>
	The HUB SA reserves the right to accept/decline any affiliation
</p>

	<p>
Commitment fee: If you agree to proceed on this journey with us, then an annual
partner fee of R300 will be applicable. The fee is about giving a monetary value to the 
commitment you are making.
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


	<button id="btn-submit" type="submit" class="btn btn-primary" name="business-submit">Submit</button>
	&nbsp;&nbsp;|&nbsp;&nbsp;<a href="">Reset Form</a>
</form>	