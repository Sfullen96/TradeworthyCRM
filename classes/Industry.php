<?php

class Industry {
	private $_db;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function getAll($orderBy = null, $limit = null) {
		if ($this->_db->select('industries')->orderBy($orderBy)->get()) {
			return $this->_db;
		}
	}

	public function get($id) {
		if ($this->_db->get('industries')->where(array('id', '=', $id))) {
			return $this->_db->first();
		}		
	}

	public function getByName($name) {
		if ($this->_db->get('industries')->where(array('name', '=', $name))) {
			return $this->_db->first();
		}
	}
}
