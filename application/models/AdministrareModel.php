<?php 
	Class AdministrareModel extends CI_Model {

		Public function __construct() { 
			parent::__construct(); 
		} 

		Public function utilizatori($conditions = array(),$page = 1,$filters = array(),$orderBy = "") {

			$this->load->helper('strings');

			foreach ($filters as $key => $value) {

				$new_key = str_replace_first("_",".",$key);
				$filters[$new_key] = $filters[$key];
				unset($filters[$key]);

			}

			$offset = ($page - 1) * 20; 

			$count = $this->db->select('id')
							->from('utilizatori')
							->like($filters)
							->where($conditions)
							->count_all_results();
			$pages = ceil($count / 20);

			$query = $this->db->like($filters)
							->order_by($orderBy)
							->get_where("utilizatori",$conditions,20,$offset);
			$result = $query->result(); 

			for ($i = 0; $i < count($result); $i++)
				unset($result[$i]->{'parola'});

			return 
			array(
				"total" => array(
					"count" => $count,
					"pages" => $pages
				),
				"data" => $result 
			);
			
		}

		Public function adaugaUtilizator($data) {

			$procesData = array(
				"utilizator" 	=> $data["username"],
				"parola"		=> password_hash($data["password"], PASSWORD_BCRYPT),
				"adresa_mail"	=> $data["adresa-mail"],
				"numar_telefon"	=> $data["numar-telefon"],
				"fk_companie"	=> $data["fk_companie"]
			);

			if ($this->db->insert("utilizatori", $procesData))
				return true;

		}

		Public function modificaUtilizator($data) {

			$procesData = array(
				"utilizator" 	=> $data["username"],
				"parola"		=> password_hash($data["password"], PASSWORD_BCRYPT),
				"adresa_mail"	=> $data["adresa-mail"],
				"numar_telefon"	=> $data["numar-telefon"],
			);

			if (empty($data["password"]))
				unset($procesData["parola"]);

			if ($this->db->where('id',$data['id'])->update('utilizatori', $procesData))
				return true;

		}

		Public function modificaDrepturiUtilizator($data) {

			if ($this->db->where('id',$data['id'])->update('utilizatori', $data))
				return true;		

		}

		Public function stergeUtilizator($id) {

			if ($this->db->delete("utilizatori", "id = ".$id))
				return true;

		}

		Public function proprietati($conditions = array(),$page = 1,$filters = array(),$orderBy = "") {

			$this->load->helper('strings');

			foreach ($filters as $key => $value) {

				$new_key = str_replace_first("_",".",$key);
				$filters[$new_key] = $filters[$key];
				unset($filters[$key]);

			}

			$offset = ($page - 1) * 20; 

			$count = $this->db->select('id')
							->from('proprietati')
							->join("tip-proprietati","tip-proprietati.id=proprietati.tip")
							->like($filters)
							->where($conditions)
							->count_all_results();
			$pages = ceil($count / 20);

			$query = $this->db->select('proprietati.*,
										tip-proprietati.nume as tip_nume')
							->join("tip-proprietati","tip-proprietati.id=proprietati.tip")
							->like($filters)
							->order_by($orderBy)
							->get_where("proprietati",$conditions,20,$offset);
			$result = $query->result(); 

			return 
			array(
				"total" => array(
					"count" => $count,
					"pages" => $pages
				),
				"data" => $result 
			);
			
		}

		Public function tipProprietati() {

			return $this->db->get("tip-proprietati")->result();

		}

		Public function adaugaProprietate($data) {

			if ($this->db->insert("proprietati", $data))
				return true;

		}

		Public function modificaProprietate($data) {

			if ($this->db->where('id',$data['id'])->update('proprietati', $data))
				return true;

		}

		Public function stergeProprietate($id) {

			if ($this->db->delete("proprietati", "id = ".$id))
				return true;

		}


	} 
?>