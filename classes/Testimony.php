<?php

class Testimony {

    private $_db,
            $_data = array();


    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function getTestimonies() {
        return $this->_db->query("SELECT * FROM testimonies WHERE allowed = 2");
    }

    public function getRandomTestimonies($num) {
        return $this->_db->query("SELECT * FROM testimonies WHERE allowed = 2 ORDER BY rand() LIMIT {$num}");
    }

    public function getNewestTestimonies($num) {
        return $this->_db->query("SELECT * FROM testimonies WHERE allowed = 2 ORDER BY created DESC LIMIT {$num}");
    }

    public function find($user = null) {
        // Check if user_id specified and grab details
        if ($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('testimonies', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function create($fields = array()) {
        if (!$this->_db->insert('testimonies', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    public function update($fields = array(), $id = null) {
        if (!$id) {
            $id = $this->data()->id;
        }

        if (!$this->_db->update('testimonies', $id, $fields)) {
            throw new Exception('There was a problem updating.');
        }
    }

    public function allowed($key) {
        $allowed = $this->_db->query("SELECT * FROM testimonies WHERE allowed = ?", array($this->data()->allowed));
        if ($allowed->count()) {
            $allow = json_decode($allowed->first()->allowed, true);
            if ($allow[$key] === 1) {
                return true;
            }
        }
        return false;
    }

    public function count($key) {
        $allowed = $this->_db->query("SELECT count(*) FROM testimonies WHERE allowed = ?", array($this->data()->allowed));
        if ($allowed->count()) {
            $allow = json_decode($allowed->first()->allowed, true);
            if ($allow[$key] === 1) {
                return true;
            }
        }
        return false;
    }

    public function data() {
        return $this->_data;
    }
}