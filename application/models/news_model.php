<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {

	protected $table = 'news';

    public function __construct()
    {
        parent::__construct();
    }

	public function addNews($titre, $contenu)
	{
		$data = array(
					'titre'=>$titre,
					'contenu'=>$contenu,
					'date'=>date('Y-m-d'));
		$this->db->insert($this->table, $data);
	}

	public function deleteNews($id)
	{
		$this->db->where("id", $id)->delete($this->table);
	}

	public function listNews()
	{
		return $this->db->query("SELECT id, titre, contenu, DATE_FORMAT(date, '%d/%m/%Y') AS date FROM $this->table ORDER BY date desc")
						->result();
	}

	public function getNewsById($id)
	{
		return $this->db->select('titre, contenu, date')
						->from($this->table)
						->where('id', $id)
						->get()
						->row();
	}

	public function updateNews($id, $titre, $contenu)
	{
		if($contenu != NULL)
		{
			$this->db->set("contenu", $contenu);
		}

		if($titre != NULL)
		{
			$this->db->set("titre", $titre);
		}
		
		$this->db->set("date", date("Y-m-d"));
		$this->db->where('id', $id)->update($this->table);
	}
}


/* End of file news_model.php */
/* Location: ./application/models/news_model.php */
