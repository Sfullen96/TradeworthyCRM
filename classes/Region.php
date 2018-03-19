<?php

class Region {
	private $_db;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function getAll($orderBy = null, $limit = null) {
		if ($this->_db->select('regions')->orderBy($orderBy)->get()) {
			return $this->_db;
		}
	}

	public function get($id) {
		if ($this->_db->select('regions')->where(array('id', '=', $id))) {
			return $this->_db->first();
		}		
	}

	public function getByName($name) {
		if ($this->_db->select('regions')->where(array('name', '=', $name))) {
			return $this->_db->first();
		}
	}
}