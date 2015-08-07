<?php

class Website_Details {

    private $_db,
            $_data = array();


    public function __construct() {
        $this->_db = DB::getInstance();
        // echo "<pre>";
        // var_dump($this);
        // echo "</pre>";
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function find($details = null) {
        // Check if user_id specified and grab details
        if ($details) {
            $field = (is_numeric($details)) ? 'id' : 'email';
            $data = $this->_db->get('website_details', array($field, '=', $details));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function create($fields = array()) {
        if (!$this->_db->insert('website_details', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    public function update($fields = array(), $id = null) {

        if (!$this->_db->update('website_details', $id, $fields)) {
            throw new Exception('There was a problem updating.');
        }
    }

    public function data() {
        return $this->_data;
    }

    public function getWebsiteDetails() {
        return $this->_db->query("SELECT * FROM website_details");
    }

}