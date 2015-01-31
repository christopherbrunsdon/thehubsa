<?php

defined('ABSPATH') or die("No script kiddies please!");

abstract class form 
{

	private $_form_errors = Null;
	
	private $_form_data = Null;

	
	public function __constructor()
	{

	}

	public function saveSession()
	{

	}

	public function loadSession()
	{

	}

	/**
	 * interface methods
	 */

	function render() {}

	function process() {}

	function render_thank_you() {}
	
	public function __toString() {
    	return $this->render();
    }

    /**
     * Get value
     *
     * @return mixed/null on not exit
     */
    public function getValue($field)
    {
    	return is_array($this->_form_data) && array_key_exists($field, $this->_form_data)
    	 			? $this->_form_data[$field]
    	 			: Null;
    }

    /**
     * Get error
     *
     * @return mixed/null on not exit
     */
    public function getError($field)
    {
    	return is_array($this->_form_errors) && array_key_exists($field, $this->_form_errors)
    				? $this->_form_errors[$field] 
    				: Null;
    }

    /**
     * Has error
     *
     * @return boolean
     */
    public function hasError($field)
    {
    	return (bool)!is_null($this->getError($field));
    }

	/**
	 * Register shortcode
	 *
	 */

	public function shortcode()
	{
		$res = $this->process($_POST);

	    ob_start();

	    if(empty($res)) {
	        $this->render();
	    } elseif (!empty($res['errors'])) {
	        $this->render($res['errors']);
	    } else {
	        $this->render_thank_you();
	    }
	    
	    return ob_get_clean();
	}
}