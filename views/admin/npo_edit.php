<h2>
	<u>Editing NPO:</u> <?php echo $npo; ?>

	&nbsp;&nbsp;

	<a href="<?php echo admin_url("admin.php?page=".THEHUBSA_ADMIN_NPOS_SLUG."&id={$npo->id}&action=view"); ?>"
		class="add-new-h2">Cancel</a>
</h2>

<br />

<?php $form->render(); ?>
