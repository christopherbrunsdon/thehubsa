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

  const MAX_LOGO_SIZE = 1500000;

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

	function process($data, $fileData = Null)
	{
		if(!isset($data['npo-submit'])) {
		    return Null;
		}
// var_dump("<pre>", $data, "</pre>");
    $npo = new model_thehub_npos();
    $res = $npo->validate($data);

    $this->_form_data = $res['data'];


    // ref: http://codex.wordpress.org/Function_Reference/wp_handle_upload
    // image upload

    // Move this into a helper ....

    if(is_array($fileData) && $fileData['npo-logo']['name'] != "") {
      // if($fileData['npo-logo']["error"]) {
      //   $res['errors']['npo-logo'] = "A technical error occured: {$fileData['npo-logo']['error']}";
      // }

      if($fileData['npo-logo']["size"] > self::MAX_LOGO_SIZE) {
       $res['errors']['npo-logo'] = "Image size is too big. Please upload a smaller file.";
      } 
      elseif($fileData['npo-logo']["type"] != "image/jpeg" && $fileData['npo-logo']["type"] != "image/png") {
        $res['errors']['npo-logo'] = "Image must be a JPEG or PNG";
      }
      else {
        $uploadedfile     = $fileData['npo-logo']; 
        $upload_overrides = array( 'test_form' => false); //, 'test_type' => false ); // needs to be passed else upload will be rejected
        $movefile         = wp_handle_upload( $uploadedfile, $upload_overrides );

        if ( $movefile && isset($movefile['file'])) {
          $this->_form_data["npo-logo-file"]=$data["npo-logo-file"] = $movefile['file'];
          $this->_form_data["npo-logo-url"] = $data["npo-logo-url"] = $movefile['url'];
          $data["npo-logo-type"] = $movefile['type'];
        } else {
          $res['errors']['npo-log'] = "Technical error with logo upload.";
        }
// var_dump("<pre>", $movefile, "</pre>");die();
      }
    } else {
      if (isset($data["npo-logo-file"])) {
        $this->_form_data["npo-logo-file"] = $data["npo-logo-file"];
      }
      
      if(isset($data["npo-logo-url"])) {
        $this->_form_data["npo-logo-url"] = $data["npo-logo-url"];
      }
    }

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
          'logo_path' => $data["npo-logo-file"],
        );

      $npo->set_data($mapped_data);
      $npo->save();

      for ($i = 1; $i <= model_thehub_npo_services::NUMBER_PER_NPO; $i++) {
        $service_id    = $data["npo-service-offered-{$i}"];
        $service_other = $data["npo-service-offered-other-{$i}"];

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