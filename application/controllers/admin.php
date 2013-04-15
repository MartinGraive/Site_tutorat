<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index()
	{
		$this->login();
	}
	


	public function login($modulePrecedent = NULL, $pagePrecedente = NULL, $id = NULL)
	{
		$this->output->enable_profiler(TRUE);
		$this->load->library('form_validation');
		$this->load->helper('form');		

		$this->form_validation->set_rules('utilisateur', 'Nom d\'utilisateur : ', 'required');
		$this->form_validation->set_rules('mdp', 'Mot de passe : ', 'required');

		if ($this->form_validation->run() == FALSE || 
			$this->input->post('utilisateur') != "tueurs" || 
			$this->input->post('mdp') != "chaptal" )
		{
			$data_header['title'] ="Identifiez vous"; 
			$this->load->view('header', $data_header);	
			$this->load->view('login_view');
			$this->load->view('footer');
		}
		else
		{
			$this->session->set_userdata('admin', TRUE);
			redirect('/'.$modulePrecedent.'/'.$pagePrecedente.'/'.$id);
		}


	}
}
