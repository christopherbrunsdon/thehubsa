<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>



<div style="background: #FFFFFF; padding: 1em;" >

	<div class="page-header">	
		<h1>
			Viewing Charity: <?= $npo->Name; ?>
		</h1>
	</div>

	<div class="row">
		<div class="col-md-12">
		
			<p>
				<img src="<?= $npo->logo; ?>" />
			</p>

			<p>
				<?= nl2br($npo->Description); ?>
			</p>


		</div>

	</div>

	<div class="row">
		<div class="col-md-6">

			<p>
				<strong>Registration Number: </strong><br /><?= $npo->RegNumber ?>
			</p>

			<?php if(trim($npo->Address)): ?>
			<p>
				<strong>Physical address:</strong><br />
				<?= nl2br($npo->Address); ?>
			</p>
			<?php endif; ?>

			<?php if(trim($npo->AddressPostal)): ?>
			<p>
				<strong>Postal address:</strong><br />
				<?= nl2br($npo->AddressPostal); ?>
			</p>
			<?php endif; ?>


			<p>
				<strong>Links: </strong><br />

				<a href="<?= (stripos($npo->wwwDomain, "http") !== 0?'http://':'').$npo->wwwDomain; ?>" target="_blank"><?= $npo->wwwDomain ?></a>
			
				<br />

				<a href="<?= (stripos($npo->wwwFacebook, "http") !== 0?'http://':'').$npo->wwwFacebook; ?>" target="_blank">
	<img src="http://png-1.findicons.com/files/icons/2155/social_media_bookmark/32/facebook.png"/>
				</a>

			</p>

			<p>
				<strong>Contact details:</strong><br />

				<?php if(trim($npo->Contact)): ?>
					<strong>Contact:</strong> <?= $npo->Contact; ?><br />
				<?php endif; ?>

				<?php if(trim($npo->Tel)): ?>
					<strong>Tel: </strong> <?= $npo->Tel ?><br />
				<?php endif; ?>

				<?php if(trim($npo->Mobile)): ?>
					<strong>Cell:</strong> <?= $npo->Mobile; ?><br />
				<?php endif; ?>
			</p>
		</div>

		<div class="col-md-6">
				<strong>Services offered :</strong>
				<?php // nl2br($npo->ServicesOffered); ?>
				
				<ul>
					<?php foreach($npo->npo_services as $service): ?>
					<?php endforeach; ?>
				</ul>

				<br />
		
				<strong>Needs List:</strong><br />
				<?= ($npo->listNeeds); ?>
				<br />

				<strong>Wish List:</strong><br />
				<?= ($npo->listWish); ?>
			<br />	
		</div>
	</div>

</div>

<nav>
	<ul class="pagination  pagination-sm">
		<li>
			<a href="?filter=">View All Charities</a>
		</li>
	</ul>
</nav>
