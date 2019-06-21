<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends CI_Model {
	
	public function getStates()
	{
		$query = $this->db->get('system_states');
		return $query->result();
	}
	
	public function getStateById($q = null)
	{
		$query = $this->db->get('system_states');
		return $query->result();
	}
}
