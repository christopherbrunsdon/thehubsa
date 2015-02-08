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

<?php if(empty($npo)): ?>

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


	<?php if(empty($npos)): ?>
		
		No results.

	<?php else: ?>
		<div style="width: 350px;" xxxclass="container-fluid">

			<!-- <div class="row"> -->
				<!-- <div class="col-md-6"> -->
				<!-- <div class="col-xs-6 col-sm-4"> -->
				 <?php $rows_per_col = ceil($count_results / 3); ?>
				
<?php if(0): ?>				
				<?php $pre=''; $i=1; foreach($npos as $npo): ?>
			
					<?php // if($i == 1 || $i % $rows_per_col == 0): ?>
						<?php // echo $pre; $pre='</ul></div>'; ?>
						<!-- <div class="col-xs-6 col-sm-4"><ul>			 -->
					<?php // endif; ?>

					<li>
						<a href="?npo_id=<?= $npo->id ?>"><?= $npo->Name; ?></a>
					</li>

				<?php $i++; endforeach; ?>
				<?php // $pre; ?>
<?php endif; ?>

<form>
	<h2>Find</h2>
	<p>
		Looking for a cause to support
	</p>

  <div class="form-group">

	<input class="form-control" type="text" placeholder="Search... " />
	<!-- add search icon -->
</div>



  <div class="form-group">


	<select class="form-control" placeholder="Select">
		<option>Select...</option>
		<option>Adult abuse victim support</option>
		<option>Adult education</option>
		<option>Adult rape victim support</option>
		<option>Animal abuse intervention</option>
		<option>Child abuse victim support</option>
		<option>Child rape victim support</option>
		<option>Crisis pregnancy support</option>
		<option>ECD education</option>
		<option>Environmental projects</option>
		<option>Feeding scheme</option>
		<option>Food gardens</option>
		<option>HIV and AIDS intervention</option>
		<option>Literacy scheme</option>
		<option>Lost and found animals</option>
		<option>Lost and found children/adults</option>
		<option>Skills training </option>
		<option>Substance abuse</option>
		<option>Support for homeless</option>
		<option>Support for new mothers</option>
		<option>Support for the disabled</option>
		<option>Support for the elderly</option>
		<option>Support for the terminal</option>
		<option>Tertiary education</option>
		<option>Wildlife</option>
	</select>
	</div>

<!-- </div>
			<div>

		</div>
 -->	
</div>
</form>

<?php endif; ?>


<?php else: ?>

<nav>
	<ul class="pagination  pagination-sm">
		<li>
			<a href="?filter=">View All Charities</a>
		</li>
	</ul>
</nav>

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
<!-- 		<p>
			<img src="<?= $npo->logo; ?>" />
		</p>

		<p>
			<?= nl2br($npo->Description); ?>
		</p>
 -->
		<p></p>
			<strong>Services offered :</strong>
			<?php // nl2br($npo->ServicesOffered); ?>
			<!-- CSS: remove gap -->
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

<?php endif; ?>
