<?php

defined('ABSPATH') or die("No script kiddies please!");
define('SHORTCODE_THEHUBSA_LIST_NPO', 'thehubsa_list_npo');

class controller_npo 
{

	/**
	 * List NPOs
	 */
	public function render_list()
	{
		$npos = $npo = Null;
		
		$filter = filter_input(INPUT_GET, "filter");
		$npo_id = filter_input(INPUT_GET, "npo_id");
		
		if($npo_id) {
			$npo = model_thehub_npos::get_by_id($npo_id);
		} else {
			$npos = model_thehub_npos::get_by_name($filter);
		}

		include(dirname(__FILE__)."/../views/lists/list-npo.php");
	}
}

add_shortcode( SHORTCODE_THEHUBSA_LIST_NPO, array(new controller_npo() ,'render_list'));
