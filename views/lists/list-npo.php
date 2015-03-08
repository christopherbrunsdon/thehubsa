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

	<select id="service-npo" name="service-npo" class="form-control" placeholder="Select"
        onchange="this.form.submit();" >
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

