<?php

defined('ABSPATH') or die("No script kiddies please!");

abstract class form 
{

	protected $_form_errors = Null;
	
	protected $_form_data = Null;

	
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

	function render($data = Null, $errors = Null) {}

	function process($data) {}

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
     * Add error
     *
     */
    public function addError($field, $msg='error')
    {
    	if(!is_array($this->_form_errors)) {
    		$this->_form_errors=array();
    	}
    	$this->_form_errors[$field] = $msg;
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