<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timetable extends CI_Controller
{
	public function index()
	{
		$this->output->enable_profiler(TRUE);
		$data_header['title'] ="Horaires des tutorats"; 
		$this->load->view('header', $data_header);	

		$this->load->model('timetable_model');
		
		$cours = $this->timetable_model->listCours();
		$data_view['cours']=$cours;
		$data_view['admin']=$this->session->userdata('admin');

		$this->load->view('timetable/timetable_view', $data_view);
		$this->load->view('footer');
	}

	public function ajout()
	{
		$this->output->enable_profiler(TRUE);
		if(!$this->session->userdata('admin'))
		{
			redirect("/admin/login/timetable/ajout");
		}
		


		else
		{
			$data_header['title'] ="Page d'administration"; 
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			$this->form_validation->set_rules('titre', 'Titre :', 'required');
			$this->form_validation->set_rules('contenu', 'Contenu :', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('header', $data_header);	
				$this->load->view('timetable/ajouter_view');
				$this->load->view('footer');
			}
			else
			{
				$this->load->model('timetable_model');
				$this->timetable_model->addCours($this->input->post('titre'),$this->input->post('contenu'));
				redirect('');
			}
		}
	}

	public function modifier($id)
	{
		$this->output->enable_profiler(TRUE);
		if(!$this->session->userdata('admin'))
		{
			redirect('/admin/login/timetable/modifier/'.$id);
		}
		
		else
		{
			$this->load->model('timetable_model');

			if(!$this->input->post('titre') && !$this->input->post('contenu'))
			{	
				$data_header['title'] ="Page de modification"; 
				$this->load->library('form_validation');
				$this->load->helper('form');	
				$this->load->view('header', $data_header);	

				$cours = $this->timetable_model->getCoursById($id);
				$data_view['cours']=$cours;
				$this->load->view('timetable/modifier_view', $data_view);
				$this->load->view('footer');
			}
			else
			{
				$this->timetable_model->updateCours($id, $this->input->post('titre'), $this->input->post('contenu'));
				redirect('');
			}
		}
	}

	
	public function supprimer($id = NULL)
	{
		$this->output->enable_profiler(TRUE);
		if(!$this->session->userdata('admin'))
		{
			redirect('/admin/login/timetable/supprimer/'.$id);
		}
		
		else
		{
			$this->load->model('timetable_model');

			if(isset($id))
			{	
				$this->timetable_model->deleteCours($id);
				redirect('');
			}
			else
			{
				$this->timetable_model->deleteCours($this->input->post('id'));
				redirect('');
			}
		}
	}

}
