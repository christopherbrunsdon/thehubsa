<?php

defined('ABSPATH') or die("No script kiddies please!");

// required for form uploading in wordpress
if ( ! function_exists( 'wp_handle_upload' ) ) {
  require_once( ABSPATH . 'wp-admin/includes/file.php' );
}

// form

abstract class form 
{

	protected $_form_errors=Null;
	
	protected $_form_data=Null;

	
	public function __construct()
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

	function render(){} //$data=Null, $errors=Null) {}

	function process() {}

	function render_thank_you() {}
	
    /**
     *
     */
	public function __toString() {
    	return $this->render();
    }

//    /**
//     * @param $npo
//     * @return bool
//     */
//    public function load_data($data)
//    {
//        $this->_form_data = empty($data) ? Null : $data;
//    }
//
//    /**
//     * Magic method get
//     *
//     * @return mixed/null on not exit
//     */
//    public function __set($name, $value)
//    {
//        if(strpos($name, 'error_')===0)
//        {
//            return $this->setError(substr($name, strlen('error_')), $value);
//        }
//        return $this->_form_data[$name]=$value;
//    }
//
//    /**
//     * Magic method get
//     *
//     * @return mixed/null on not exit
//     */
//    public function __get($name)
//    {
//        if(strpos($name, 'error_')===0)
//        {
//            return $this->getError(substr($name, strlen('error_')));
//        }
//        return $this->getValue($name);
//    }
//
//    /**
//     * @param $name
//     * @return bool
//     */
//    public function __isset($name)
//    {
//        error_log("Isset: {$name}");
//        return isset($this->_form_data[$name]);
//    }
//
//    /**
//     * Get value
//     *
//     * @return mixed/null on not exit
//     */
//    public function getValue($field)
//    {
//    	return is_array($this->_form_data) && array_key_exists($field, $this->_form_data)
//    	 			? $this->_form_data[$field]
//    	 			: Null;
//    }
//
//    /**
//     * Add error
//     *
//     */
//    public function addError($field, $msg='error')
//    {
//        // bulk upload
//        if(is_array($field)) {
//            foreach($field as $f => $m) {
//                $this->addError($f, $m);
//            }
//            return;
//        }
//
//    	if(!is_array($this->_form_errors)) {
//    		$this->_form_errors=array();
//    	}
//    	$this->_form_errors[$field]=$msg;
//    }
//
//    /**
//     * Get error
//     *
//     * @return mixed/null on not exit
//     */
//    public function getError($field)
//    {
//    	return is_array($this->_form_errors) && array_key_exists($field, $this->_form_errors)
//    				? $this->_form_errors[$field]
//    				: Null;
//    }
//
//    /**
//     * Has error
//     *
//     * @return boolean
//     */
//    public function hasError($field)
//    {
//    	return (bool)!is_null($this->getError($field));
//    }

	/**
	 * Register shortcode
	 *
	 */

	public function shortcode()
	{
		$res=$this->process($_POST, $_FILES);

	    ob_start();

	    if($res===Null) {
	        $this->render();
	    } elseif ($res===False) {
	        $this->render();
	    } else {
	        $this->render_thank_you();
	    }
	    
	    return ob_get_clean();
	}
}