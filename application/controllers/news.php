<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	public function index()
	{
		$this->output->enable_profiler(TRUE);
		$data_header['title'] ="Bienvenus sur le site des tueurs de Chaptal"; 
		$this->load->view('header', $data_header);	

		$this->load->model('news_model');
		
		$news = $this->news_model->listNews();
		$data_view['news']=$news;
		$data_view['admin']=$this->session->userdata('admin');

		$this->load->view('news/news_view', $data_view);
		$this->load->view('footer');
	}

	public function ajout()
	{
		$this->output->enable_profiler(TRUE);
		if(!$this->session->userdata('admin'))
		{
			redirect("/admin/login/news/ajout");
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
				$this->load->view('news/ajouter_view');
				$this->load->view('footer');
			}
			else
			{
				$this->load->model('news_model');
				$this->news_model->addNews($this->input->post('titre'),$this->input->post('contenu'));
				redirect('');
			}
		}

	}

	public function modifier($id)
	{
		$this->output->enable_profiler(TRUE);
		if(!$this->session->userdata('admin'))
		{
			redirect('/admin/login/news/modifier/'.$id);
		}
		
		else
		{
			$this->load->model('news_model');

			if(!$this->input->post('titre') && !$this->input->post('contenu'))
			{	
				$data_header['title'] ="Page de modification"; 
				$this->load->library('form_validation');
				$this->load->helper('form');	
				$this->load->view('header', $data_header);	

				$news = $this->news_model->getNewsById($id);
				$data_view['news']=$news;
				$this->load->view('news/modifier_view', $data_view);
				$this->load->view('footer');
			}
			else
			{
				$this->news_model->updateNews($id, $this->input->post('titre'), $this->input->post('contenu'));
				redirect('');
			}
		}
	}
	

	public function supprimer($id = NULL)
	{
		$this->output->enable_profiler(TRUE);
		if(!$this->session->userdata('admin'))
		{
			redirect('/admin/login/news/supprimer/'.$id);
		}
		
		else
		{
			$this->load->model('news_model');

			if(isset($id))
			{	
				$this->news_model->deleteNews($id);
				redirect('');
			}
			else
			{
				$this->news_model->deleteNews($this->input->post('id'));
				redirect('');
			}
		}
	}


}

/* End of file news.php */
/* Location: ./application/controllers/news.php */
