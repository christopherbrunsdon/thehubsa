<?php

//defined('ABSPATH') or die("No script kiddies please!");
define('SHORTCODE_THEHUBSA_LIST_NPO', 'thehubsa_list_npo');

class controller_npo 
{

	/**
	 * List NPOs
	 */
	public function render()
	{
		$npo_id = filter_input(INPUT_GET, "npo-id");
		
		if($npo_id) {
			$this->render_npo();
		} else {
			$this->render_list();
		}
	}

	/**
	 * List NPOs
	 */
	public function render_list()
	{
		$filter = filter_input(INPUT_GET, "search-npo")?:filter_input(INPUT_GET, "filter");
		$filter_service = filter_input(INPUT_GET, "service-npo");
		$npos = model_thehub_npos::get_by_name($filter, $filter_service);
		include(dirname(__FILE__)."/../views/lists/list-npo.php");
	}

	/**
	 *
	 */	
	public function render_npo()
	{
		$npo_id = filter_input(INPUT_GET, "npo-id");		
		$npo = model_thehub_npos::get_by_id($npo_id);
		include(dirname(__FILE__)."/../views/lists/listing-npo.php");
	}

}

add_shortcode( SHORTCODE_THEHUBSA_LIST_NPO, array(new controller_npo() ,'render'));
