<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

<?php
	// List A-Z
?>


<nav>
  <ul class="pagination  pagination-sm">
    <li>
		<?php if($filter): ?>
			<li>
				<a href="?filter=">Reset</a>
			</li>
		<?php endif; ?>

		<?php foreach (range('A','Z') as $alpha): ?>
			<li <?php (strtolower($filter) == strtolower($alpha)) && print 'class="active"' ?> >
				<a href="?filter=<?= $alpha ?>"><?= $alpha ?>
					<?php (strtolower($filter) == strtolower($alpha)) && print '<span class="sr-only">(current)</span>'; ?>
				</a>
			</li>
		<?php endforeach; ?>

	</li>
  </ul>
</nav>

<?php $count_results = count($npos); ?>

<?php if(0): ?>
	<div class="page-header">	
		<h1>
			<?php if(1 && empty($filter)): ?>
				All Charities
			<?php else: ?>
				Charities starting with <?= ucwords($filter); ?>
			<?php endif; ?>

			<small>(Viewing <?= $count_results = count($npos) ?> Results)</small>
		</h1>
	</div>
<?php endif; ?>



<div style="width: 350px;" xxxclass="container-fluid">
	<form class="form" action="" method="get">
	<div class="form-group">
		<h2>Find</h2>
		Looking for a cause to support
	</div>

	<div class="input-group custom-search-form">
		<input id="search-npo" name="search-npo" type="text" class="form-control" placeholder="Search... " value="<?php echo filter_input(INPUT_GET, "search-npo"); ?>">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit">
	              <span class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	</div>

	<br />

	<div class="form-group">


	<select id="service-npo" name="service-npo" class="form-control" placeholder="Select">
		<option value="">Select...</option>
		<?php foreach(model_thehub_npo_service_types::get_services() as $service): ?>
			<option value="<?php echo $service->id; ?>" <?php echo $service->id==filter_input(INPUT_GET,'service-npo') ?'selected':''; ?> ><?php echo $service->Service; ?></option>
		<?php endforeach; ?>
	</select>
	</div>

	</div>
</form>


<?php if(!empty($npos)): ?>
	
	<div>
		NPO's found
	</div>

	<ul>
		<?php foreach($npos as $npo): ?>
		
			<li><a href="?npo-id=<?php echo $npo->id; ?>"><?php echo $npo->Name; ?></a></li>

		<?php endforeach; ?>
	</ul>

<?php endif; ?>


<?php /*
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
					<li>Adult education</li>
					<li>ECD education</li>
					<li>Literacy scheme</li>
					<li>Skills training </li>
					<li>Support for new mothers</li>
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


<?php endif; ?>
*/
