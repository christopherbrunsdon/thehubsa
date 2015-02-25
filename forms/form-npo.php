<?php

defined('ABSPATH') or die("No script kiddies please!");
define('SHORTCODE_THEHUBSA_FORM_SIGNUP_NPO', 'thehubsa_form_signup_npo');

require_once("form.php");
require_once("error-helper.php");

/** 
 * Signup form for NPOs
 *
 */

class form_npo extends form
{

    const MAX_LOGO_SIZE = 1500000;

    public $show_banking = true;

    private
        $npo = null,
        $error = null;

    /**
     *
     */
    public function __construct()
    {
        $this->error=new error_helper();
        $this->npo=new model_thehub_npos();

        $this->npo->npo_services=array();
        for($i=1; $i <= model_thehub_npo_services::NUMBER_PER_NPO; $i++) {
            $this->npo->npo_services[$i] = new model_thehub_npo_services();
        }
    }

	/**
	 *
	 */
	function render()
	{
        $services=model_thehub_npo_service_types::get_services();
        include("form-npo-template.php");
	}

	/**
	 *
	 */
	function process($data, $fileData = Null)
	{
        $has_error=False;

		if(!isset($data['submit'])) {
		    return Null;
		}

        $this->error=new error_helper();

        $this->npo=new model_thehub_npos();
        $this->npo->set_data($data);
        $has_error=$this->npo->validate()?:True;

        $this->npo->npo_services=array();
        for($i=1; $i <= model_thehub_npo_services::NUMBER_PER_NPO; $i++) {
            $service_id=isset($data["service-offered-{$i}"])?$data["service-offered-{$i}"]:Null;
            $service_other=isset($data["service-offered-other{$i}"])?$data["service-offered-other{$i}"]:Null;

            if($service_id=='-- Other --') {
                $service_id=Null;
            } else {
                $service_other=Null;
            }

            $this->npo->npo_services[$i]=new model_thehub_npo_services();
            $this->npo->npo_services[$i]->set_data(array(
                "fkService"=>$service_id,
                "ServiceOther"=>$service_other,
                "RankOrder"=>$i
            ));
        }

        // image uploader
        //
        // ref: http://codex.wordpress.org/Function_Reference/wp_handle_upload
        // image upload
        //
        // Move this into a helper ....
        //
        $image_error=Null;
        $logo_path=Null;
//        $logo_path_url=Null;
//        $logo_type=Null;

        if(is_array($fileData) && $fileData['logo']['name']) {
            if($fileData['logo']["error"]) {
                $image_error="A technical error occured: {$fileData['logo']['error']}";
            }

            if($fileData['logo']["size"] > self::MAX_LOGO_SIZE) {
                $image_error="Image size is too big. Please upload a smaller file.";
            }
            elseif(!in_array($fileData['logo']["type"], array("image/jpeg", "image/png"))) {
                $image_error="Image must be a JPEG or PNG";
            }
            else {
                $uploaded_file=$fileData['logo'];
                $upload_overrides=array( 'test_form' => false); //, 'test_type' => false ); // needs to be passed else upload will be rejected
                $move_file=wp_handle_upload( $uploaded_file, $upload_overrides );

                if ($move_file && isset($move_file['file'])) {
                    $logo_path=$move_file['file'];
//                    $logo_path_url=$move_file['url'];
//                    $logo_type=$move_file['type'];
                } else {
                    $image_error="Technical error with logo upload.";
                }
                // var_dump("<pre>", $movefile, "</pre>");die();
            }
        } else {
            if (isset($data["logoPath"])) {
                $logo_path=$data["logo_path"];
            }
        }

        $this->npo->LogoPath=$logo_path;
        if(isset($image_error)) {
            $this->error->LogoPath=$image_error;
            $has_error=True;
        }

    // var_dump("<pre>", $data);

        if (!$has_error) {
            $this->npo->save();

            foreach($this->npo_services as $npo_service) {
                $npo_service->fkNpo=$this->npo->id;
                $npo_service->save();
            }

            return True;
        } else {
            $this->error->load_errors($this->npo->validation_errors);
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