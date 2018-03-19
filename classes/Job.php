<?php

class Job {
	private $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function getUserJobs($id) {
		if ($this->_db
				->select('jobs', array('jobs.*', 'jobs.id as jobId', 'users.fname', 'users.lname', 'users.company_name', 'users.phone', 'regions.*', 'industries.*', 'users.logo'))
				->join('left', 'users', array('users.id', '=', 'jobs.user_id'))
				->join('left', 'regions', array('regions.id', '=', 'jobs.job_location'))
				->join('left', 'industries', array('industries.id', '=', 'jobs.trade_required'))
				->where(array('jobs.active', '=', 1))
				->where(array('jobs.verified', '=', 1))
				->where(array('jobs.user_id', '=', $id))
				->orderBy('jobs.created_at DESC')
				->get()) 
		{
			return $this->_db;
		}

	}

	public function getAllJobs() {
		if ($this->_db
				->select('jobs', array('jobs.*', 'jobs.id as jobId', 'users.fname', 'users.lname', 'users.company_name', 'users.phone', 'regions.*', 'industries.*', 'users.logo'))
				->join('left', 'users', array('users.id', '=', 'jobs.user_id'))
				->join('left', 'regions', array('regions.id', '=', 'jobs.job_location'))
				->join('left', 'industries', array('industries.id', '=', 'jobs.trade_required'))
				->where(array('jobs.active', '=', 1))
				->where(array('jobs.verified', '=', 1))
				->orderBy('jobs.created_at DESC')
				->get()) {
			return $this->_db;
		}
	}

	public function create($fields = array()) {
		if (!$this->_db->insert('jobs
			', $fields)) {
			throw new Exception('There was a problem posting your job');
		}
	}

	public function addQuote($fields = array()) {
		if (!$this->_db->insert('quotes
			', $fields)) {
			throw new Exception('There was a problem posting your job');
		}
	}

	public function showJob($jobId) {
		$this->_db->select('jobs', array('jobs.*', 'jobs.id as jobId', 'users.fname', 'users.lname', 'users.company_name', 'users.phone', 'regions.*', 'industries.*', 'users.logo', 'quotes.*'))
				->join('left', 'users', array('users.id', '=', 'jobs.user_id'))
				->join('left', 'regions', array('regions.id', '=', 'jobs.job_location'))
				->join('left', 'industries', array('industries.id', '=', 'jobs.trade_required'))
				->join('left', 'quotes', array('quotes.quote_id', '=', 'jobs.id'))
				->where(array('jobs.id', '=', $jobId))
				->where(array('jobs.active', '=', 1))
				->get();
		return $this->_db;
	}

	public function getQuotes($jobId) {
		$this->_db->select('quotes')
				->where(array('job_id', '=', $jobId))
				->orderBy('posted_at DESC')
				->get();
		return $this->_db;
	}
}