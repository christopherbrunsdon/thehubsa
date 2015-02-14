<h2>
	<u>Viewing NPO:</u> <?php echo $npo; ?>

	&nbsp;&nbsp;


	<a href='<?php echo admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG."&id=".$npo->id.'&action='.($npo->is_active()?'deactivate':'activate')); ?>'
		onclick="return confirm('You are about to <?php echo ($npo->is_active()? 'Deactivate' : 'Activate'); ?> the NPO <?php echo $npo->Name; ?>');"
		class="add-new-h2" ><?php echo ($npo->is_active()? 'Deactivate' : 'Activate'); ?></a>
</h2>

<br />

<table border=1>

	<tr class="">
		<th align="right">id:</th>
		<td><?php echo $npo->id; ?></td>
	</tr>

	<tr class="">
		<th align="right">Name:</th>
		<td><?php echo $npo->Name; ?></td>
	</tr>

	<tr class="">
		<th align="right">Logo:</th>
		<td>
			<?php if($npo->logo): ?> 
				<img style="max-width: 100px; max-height: 100px;" src="<?php echo $npo->logo; ?>" />  
			<?php else:  ?>
				* No Logo *
			<?php endif; ?>
		</td>
	</tr>	

	<tr class="">
		<th align="right">Reg Number:</th>
		<td><?php echo $npo->RegNumber; ?></td>
	</tr>

	<tr class="">
		<th align="right">Reg Number Other:</th>
		<td><?php echo $npo->RegNumberOther; ?></td>
	</tr>

	<tr class="">
		<th align="right">Address:</th>
		<td><?php echo nl2br($npo->Address); ?></td>
	</tr>

	<tr class="">
		<th align="right">Address Postal:</th>
		<td><?php echo nl2br($npo->AddressPostal); ?></td>
	</tr>

	<tr class="">
		<th align="right">Contact:</th>
		<td><?php echo $npo->Contact; ?></td>
	</tr>

	<tr class="">
		<th align="right">Telephone Number:</th>
		<td><?php echo $npo->Tel; ?></td>
	</tr>

	<tr class="">
		<th align="right">Cell Number:</th>
		<td><?php echo $npo->Mobile; ?></td>
	</tr>

	<tr class="">
		<th align="right">Email:</th>
		<td><?php echo $npo->Email; ?></td>
	</tr>

	<tr class="">
		<th align="right">Website:</th>
		<td><?php echo $npo->wwwDomain; ?></td>
	</tr>

	<tr class="">
		<th align="right">Preferred Link:</th>
		<td><?php echo $npo->wwwHomepage; ?></td>
	</tr>

	<tr class="">
		<th align="right">Facebook:</th>
		<td><?php echo $npo->wwwFacebook; ?></td>
	</tr>

	<tr class="">
		<th align="right">Services Offered:</th>
		<td>
			<?php if(isset($npo->services_offered)): ?>
				<ul>
					<?php foreach($npo->services_offered as $service): ?>
						<li><?php echo $service->Service; ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</td>
	</tr>		

	<tr class="">
		<th align="right">Description:</th>
		<td><?php echo nl2br($npo->Description); ?></td>
	</tr>

	<tr class="">
		<th align="right">What can organisation offer:</th>
		<td><?php echo nl2br($npo->ServicesOffered); ?></td>
	</tr>

	<tr class="">
		<th align="right">Associated Organisations:</th>
		<td><?php echo nl2br($npo->AssociatedOrganisations); ?></td>
	</tr>

	<tr class="">
		<th align="right">Needs List: </th>
		<td><?php echo nl2br($npo->listNeeds); ?></td>
	</tr>

	<tr class="">
		<th align="right">Wish List:</th>
		<td><?php echo nl2br($npo->listWish); ?></td>
	</tr>

	<tr class="">
		<th align="right">Payment Eft:</th>
		<td><?php echo $npo->paymentEft; ?></td>
	</tr>

	<tr class="">
		<th align="right">Payment Deposit:</th>
		<td><?php echo $npo->paymentDeposit; ?></td>
	</tr>

	<tr class="">
		<th align="right">Active:</th>
		<td><?php echo $npo->is_active()?"Yes":"No"; ?></td>
	</tr>

	<tr class="">
		<th align="right">Notes:</th>
		<td><?php echo $npo->Notes; ?></td>
	</tr>

	<tr class="">
		<th align="right">WhenCreated:</th>
		<td><?php echo $npo->WhenCreated; ?></td>
	</tr>

	<tr class="">
		<th align="right">WhenUpdated:</th>
		<td><?php echo $npo->WhenUpdated; ?></td>
	</tr>


</table>