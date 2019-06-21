<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CityController extends CI_Controller {
	public function __construct(){
	  parent::__construct();
	  $this->load->library('session');
	}

	public function getCityByStateIdAjax($id = null)
	{
		$this->load->model('City', 'city');
		$query = null;
		if ($id) {
			$query = $this->city->getCityById($id);
		}		
		echo json_encode($query);
	}


	public function getCityByStateId($id = null)
	{
		$this->load->model('City', 'city');
		$query = null;
		if ($id) {
			$query = $this->city->getCities($id);
		}		
		
		return $query;
	}
}
