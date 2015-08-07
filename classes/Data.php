<?php
class Data {
	private $_db, $_data = array();

	public function __construct($user = null) {
		$this->_db = DB::getInstance();
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function find($text = null) {
		// Check if user_id specified and grab details
		if($text) {
			$field = (is_numeric($text)) ? 'id' : 'text';
			$data = $this->_db->get('data', array($field, '=', $text));

			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function create($fields = array()) {
		if(!$this->_db->insert('data', $fields)) {
			throw new Exception('There was a problem creating an account.');
		}
	}

	public function update($fields = array(), $id = null) {
		if(!$id && $this->isLoggedIn()) {
			$id = $this->data()->id;
		}

		if(!$this->_db->update('data', $id, $fields)) {
			throw new Exception('There was a problem updating.');
		}
	}

	public function data() {
		return $this->_data;
	}
}