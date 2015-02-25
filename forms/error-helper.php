<?php

//Error helper class

defined('ABSPATH') or die("No script kiddies please!");

// form

class error_helper
{

	protected $_errors=Null;
	
	/**
	 *
	 */
	public function __constructor($errors = null)
	{
		$this->load_errors($errors);
	}

    /**
     * @param $npo
     * @return bool
     */
    public function load_errors($errors)
    {
        $this->_errors=empty($errors) ? Null : $errors;
    }

    /**
     * Magic method get
     *
     * @return mixed/null on not exit
     */
    public function __set($name, $value)
    {
        return $this->_errors[$name]=$value;
    }

    /**
     * Magic method get
     *
     * @return mixed/null on not exit
     */
    public function __get($name)
    {
//        error_log("\$name = {$name}");
    	return is_array($this->_errors) && isset($this->_errors[$name])
    	 			? $this->_errors[$name]
    	 			: Null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_errors[$name]);
    }

}