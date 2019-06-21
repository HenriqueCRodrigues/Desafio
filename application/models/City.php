<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Model {
	
	public function getCities($id = null)
	{	
		if ($id) {
			$this->db->where('state_id', $id);
		}

		$query = $this->db->get('system_cities');
		return $query->result();
	}
	
	public function getCityById($id = null)
	{	
		$result = null;
		if($id) {
			$this->db->where('state_id', $id);
			$query = $this->db->get('system_cities');
			$result = $query->result();
		}
		
		return $result;
	}
}
