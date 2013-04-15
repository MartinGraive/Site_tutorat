<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timetable_model extends CI_Model {

	protected $table = 'timetable';

    public function __construct()
    {
        parent::__construct();
    }

	public function addCours($tuteurs, $jour, $heure, $matiere)
	{
		$data = array(
					'tuteurs'=>$tuteurs,
					'jour'=>$this->$jour,
					'heure'=>$heure,
					'matiere'=>$matiere);
		$this->db->insert($this->table, $data);
	}

	public function deleteCours($id)
	{
		$this->db->where("id", $id)->delete($this->table);
	}

	public function listCours()
	{
		return $this->numberToDay($this->db->query("SELECT id, tuteurs, jour, DATE_FORMAT(heure, '%Hh%i') AS heure, matiere 
											FROM $this->table ORDER BY jour, heure")->result());
		
	}

	public function getCoursById($id)
	{
		return $this->numberToDay($this->db->select('tuteurs, jour, heure, matiere')
						->from($this->table)
						->where('id', $id)
						->get()
						->result());
	}

	public function updateCours($id, $tuteurs, $jour, $heure, $matiere)
	{
		if($tuteurs != NULL)
		{
			$this->db->set("tuteurs", $tuteurs);
		}

		if($jour != NULL)
		{
			$this->db->set("jour", $this->dayToNumber($jour));
		}
		if($heure != NULL)
		{
			$this->db->set("heure", $heure);
		}
		if ($matiere !=NULL)
		{	
			$this->db->set('matiere', $matiere);
		}

		$this->db->where('id', $id)->update($this->table);
	}

	private function numberToDay($requete)
	{
		foreach ($requete as &$cours)
		{
			switch ($cours->jour)
			{
				case 0:
					$cours->jour = "Lundi";
					break;
				case 1:
					$cours->jour = "Mardi";
					break;
				case 2:
					$cours->jour = "Mercredi";
					break;
				case 3:
					$cours->jour = "Jeudi";
					break;
				case 4:
					$cours->jour = "Vendredi";
					break;
				case 5:
					$cours->jour = "Samedi";
					break;
				case 6:
					$cours->jour = "Dimanche";
					break;
			}
		}
		
	return $requete;
	}
}


/* End of file timetable_model.php */
/* Location: ./application/models/timetable_model.php */
