<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MedicoController extends CI_Controller {
	public function __construct(){
	  parent::__construct();
	  $this->load->library('session');
	}
	public function index()
	{
		$this->load->model('Medico', 'medico');
		$data['medicos'] = $this->medico->getMedicos();
		$this->load->view('home', $data);
		//$this->load->view('welcome_message');
	}

	public function cadastrar()
	{
		$this->load->model('State', 'state');
		$data['states'] = $this->state->getStates();
		$data['error'] = $this->session->userdata('error');
		$this->load->view('cadastrar', $data);	
	}
	
	public function insert()
	{
		$this->session->set_flashdata('error', false);

		$data  = [];		
		$data['name']  	  		= $this->input->post('name');
		$data['especialidade']	= $this->input->post('especialidade');
		$data['crm']   	  		= $this->input->post('crm');
		$data['email'] 	  		= $this->input->post('email');
		$data['phone']    		= $this->input->post('phone');
		$data['cep']   	  		= $this->input->post('cep');
		$data['city_id']  		= $this->input->post('city');	
		$data['state_id'] 		= $this->input->post('state');
		
		$this->load->library('session');	
		if (in_array('', $data))
		{
	      $data = [];
		  $data['error'] = true;
		  $this->session->set_flashdata('error', true);
		  redirect('MedicoController/cadastrar');
		}
		
		$this->load->model('Medico', 'medico');
		$this->medico->addMedico($data);

		$this->session->set_flashdata('error',false);
		$this->session->set_flashdata('med_success',true);
		redirect('/');
	}

	public function atualizar($id = null)
	{
		if($id == null)
		{
		  redirect('/');
		}

		$this->load->model('State', 'state');
		$this->load->model('City', 'city');
		$this->load->model('Medico', 'medico');

		$query = $this->medico->getMedicoById($id);
		$state_id = $query ? $query->state_id : null;
		$data['medico'] = $query;
		$data['states'] = $this->state->getStates();
		$data['cities'] = $this->city->getCityById($state_id);
		$data['error'] 	= $this->session->userdata('error');
		
		$this->load->view('atualizar.php',$data);
	}

	public function update($id = null)
	{
		$this->session->set_flashdata('error', false);

		$data  = [];		
		$data['name']  	  		= $this->input->post('name');
		$data['especialidade']	= $this->input->post('especialidade');
		$data['crm']   	  		= $this->input->post('crm');
		$data['email'] 	  		= $this->input->post('email');
		$data['phone']    		= $this->input->post('phone');
		$data['cep']   	  		= $this->input->post('cep');
		$data['city_id']  		= $this->input->post('city');	
		$data['state_id'] 		= $this->input->post('state');
		
		$this->load->library('session');	
		if (in_array('', $data))
		{
	      $data = [];
		  $data['error'] = true;
		  $this->session->set_flashdata('error', true);
		  redirect("MedicoController/atualizar/$id");
		}
		
		$this->load->model('Medico', 'medico');
		$this->medico->updateMedico($id, $data);

		$this->session->set_flashdata('error',false);
		$this->session->set_flashdata('med_success',true);
		redirect('/');
	}

	public function delete($id = null)
	{
		if($id == null)
		{
		  redirect('/');
		}

		$this->load->model('Medico', 'medico');

		$this->medico->DeleteMedicoById($id);
		redirect('/');
	}
}
