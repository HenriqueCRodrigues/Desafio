<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends CI_Model {

	public function addMedico($data)
	{
		$this->db->insert('medicos', $data);
	}

	public function getMedicos($q = null)
	{
		$query = $this->db->get('medicos');
		return $query->result();
	}
	
	public function getMedicoById($id)
	{
	    if($id != null) 
        {
			$this->db->where('id', $id);
			$this->db->limit(1);
			$query = $this->db->get('medicos');
			return $query->row();
	    }
	}

	public function updateMedico($id = null, $data = null)
	{
		if($data != null && $id != null)
		{
			$this->db->update('medicos', $data, ['id' => $id]);
		}
	}

	public function deleteMedicoById($id)
	{
	    if($id != null) 
        {
			$this->db->where('id', $id);
			$this->db->delete('medicos');
	    }
	}


}
