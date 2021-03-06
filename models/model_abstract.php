<?php
//defined('ABSPATH') or die("No script kiddies please!");

abstract class model_abstract
{
    public
        $validation_errors=Null;

    // abstract methods

    public function is_new()
    {
        return (bool)!isset($this->id);
    }

    public function sanitize() {}

    public function validate() {}

    public function save() {}

    /**
     * @param $data
     */
    public function set_data($data)
    {
        if(is_object($data)) {
            return $this->set_data(get_object_vars($data));
        }

        if(!is_array($data)) {
            return;
        }

        foreach(get_object_vars($this) as $k=>$v) {
            if(array_key_exists($k, $data)) {
                $this->$k=stripslashes($data[$k]);
            }
        }
    }

    /**
     * Is active
     *
     * Apply active rules here
     *
     * @return bool
     */
    public function is_active()
    {
        return (bool)(isset($this->bActive) && $this->bActive);
    }

    /**
     * @param bool $active

     * @return bool
     */
    public function set_active($active = True)
    {
        $this->bActive = $active;

        if(!$this->is_new()) {
            $this->save();
        }

        return $this->is_active();
    }

}