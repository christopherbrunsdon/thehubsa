<?php

defined('ABSPATH') or die("No script kiddies please!");
define('SHORTCODE_THEHUBSA_FORM_SIGNUP_NPO', 'thehubsa_form_signup_npo');

require_once("form.php");

/** 
 * Signup form for NPOs
 *
 */

class form_npo extends form
{
	/**
	 *
	 */

	function render($data = Null, $errors = Null) 
	{
    $services = model_thehub_npo_service_types::get_services();
		include("form-npo-template.php");
	}

	/**
	 *
	 */

	function process($data)
	{
		if(!isset($data['npo-submit'])) {
		    return Null;
		}
// var_dump("<pre>", $data, "</pre>");
    $npo = new model_thehub_npos();
    $res = $npo->validate($data);

    $this->_form_data = $res['data'];

    // var_dump("<pre>", $data);
    if (empty($res['errors'])) {
      // map data

      $mapped_data = array(
          'Name' => $data["npo-name"],
          'RegNumber' => $data["npo-reg-number"],
          'RegNumberOther' => $data["npo-reg-other"],
          'Address' => $data["npo-address"],
          'AddressPostal' => $data["npo-postal"],
          'Contact' => $data["npo-contact"],
          'Tel' => $data["npo-tel"],
          'Mobile' => $data["npo-mobile"],
          'Email' => $data["npo-email"],
          'wwwDomain' => $data["npo-website"],
          'wwwHomepage' => $data["npo-url"],
          'wwwFacebook' => $data["npo-facebook"],
          'Description' => $data["npo-description"],
          'ServicesOffered' => $data["npo-services-other"],
          'AssociatedOrganisations' => $data["npo-associated"],
          'listNeeds' => $data["npo-needs"],
          'listWish' => $data["npo-wishlist"],
          'paymentEft' => isset($data["npo-payment-eft"])?$data["npo-payment-eft"]:0,
          'paymentDeposit' => isset($data["npo-payment-deposit"])?$data["npo-payment-deposit"]:0,
        );

      $npo->set_data($mapped_data);
      $npo->save();

      for ($i = 1; $i <= model_thehub_npo_services::NUMBER_PER_NPO; $i++) {
        $service_id    = $data["npo-service-offered-{$i}"];
        $service_other = $data["npo-service-offered-other-{$i}"];


// error_log("${i} \$service_id = ${service_id}");
// error_log("${i} \$service_other = ${service_other}");

        if($service_id == '-- Other --') {
          $service_id = Null;
        } else {
          $service_other = Null;
        }

        $npo_service = new model_thehub_npo_services();
        $npo_service->set_data(array(
          'fkNpo' => $npo->_id,
          'fkService' => $service_id,
          'ServiceOther' => $service_other,
          'RankOrder' => $i));

        $npo_service->save();
        return True;
      }
    } else {
        $this->addError($res['errors']);
        return False;
    }
	}

	/**
	 *
	 */

	function render_thank_you()
	{
    echo "<h2>Thank You!</h2>";
	}
}

// register shortcode


add_shortcode( SHORTCODE_THEHUBSA_FORM_SIGNUP_NPO, array(new form_npo() ,'shortcode'));
 
// [eof]