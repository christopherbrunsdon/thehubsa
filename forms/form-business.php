<?php

defined('ABSPATH') or die("No script kiddies please!");

require_once("form.php");

/** 
 * Signup form for NPOs
 *
 */

class form_business extends form
{
	/**
	 *
	 */

	function render($data = Null, $errors = Null) 
	{
        $services = model_thehub_npo_service_types::get_services();
		include("form-business-template.php");
	}

	/**
	 *
	 */

	function process($data)
	{
	}

	/**
	 *
	 */

	function render_thank_you()
	{
    echo "<h2>Thank You!</h2>";
	}
}

// [eof]