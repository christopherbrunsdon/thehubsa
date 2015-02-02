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


	<div class="page-header">	
		<h1>
			<?php if(empty($filter)): ?>
				All Charities
			<?php else: ?>
				Charities starting with <?= ucwords($filter); ?>
			<?php endif; ?>

			<small>(Viewing <?= $count_results = count($npos) ?> Results)</small>
		</h1>
	</div>

	<hr />

	<?php if(empty($npos)): ?>
		
		No results.

	<?php else: ?>
		<div class="container-fluid">

			<div class="row">
				
				<?php $rows_per_col = ceil($count_results / 3); ?>
				<?php $pre=''; $i=1; foreach($npos as $npo): ?>
			
					<?php if($i == 1 || $i % $rows_per_col == 0): ?>
						<?php echo $pre; $pre='</ul></div>'; ?>
						<div class="col-xs-6 col-sm-4"><ul>			
					<?php endif; ?>

					<li>
						<a href="?npo_id=<?= $npo->id ?>"><?= $npo->Name; ?></a>
					</li>

				<?php $i++; endforeach; ?>
				<?= $pre; ?>
			<div>

		</div>
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

<p>
	<strong>Registration Number: </strong><?= $npo->RegNumber ?>
</p>

<p>
	<strong>Physical address:</strong><br />
	<?= nl2br($npo->Address); ?>
</p>
<p>
	<strong>Postal address:</strong><br />
	<?= nl2br($npo->AddressPostal); ?>
</p>

<p>
	<strong>Website: </strong><a href="<?= (stripos($npo->wwwDomain, "http") !== 0?'http://':'').$npo->wwwDomain; ?>" target="_blank"><?= $npo->wwwDomain ?></a>
</p>

<p>
	<strong>Contact details:</strong><br />
	<strong>Tel: </strong> <?= $npo->Tel ?><br />
	<strong>Cell:</strong> <?= $npo->Mobile; ?>
</p>

<p>
	<strong>Needs List:</strong><br />
	<?= nl2br($npo->listNeeds); ?>
</p>

<p>
	<strong>Wish List:</strong><br />
	<?= nl2br($npo->listWish); ?>
</p>

<?php endif; ?>
