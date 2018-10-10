<?php 
	Class RezervariModel extends CI_Model {

		Public function __construct() { 
			parent::__construct(); 
		} 

		Public function rezervari($conditions = array(),$page = 1,$filters = array(),$orderBy = "") {

			$this->load->helper('strings');

			foreach ($filters as $key => $value) {

				$new_key = str_replace_first("_",".",$key);
				$filters[$new_key] = $filters[$key];
				unset($filters[$key]);

			}

			$offset = ($page - 1) * 20; 

			$count = $this->db->select('id')
							->join("clienti","clienti.id=rezervari.fk_client")
							->join("rezervari_camera_link","rezervari_camera_link.fk_rezervare=rezervari.id")
							->join("camere","camere.id=rezervari_camera_link.fk_camera")
							->join("oferte","oferte.id=rezervari_camera_link.fk_oferta")
							->join("proprietati","proprietati.id=camere.fk_proprietate")
							->from('rezervari')
							->like($filters)
							->where($conditions)
							->count_all_results();
			$pages = ceil($count / 20);

			$query = $this->db->select('rezervari.*, 
										clienti.nume as nume,
										clienti.telefon as telefon,
										clienti.email as email,
										proprietati.nume as nume_proprietate, 
										proprietati.id as id_proprietate,
										GROUP_CONCAT(camere.numar SEPARATOR "; ") as numar_camera,
										GROUP_CONCAT(IF(oferte.id="","",CONCAT(camere.numar," - Cu Oferta - ",oferte.nume)) SEPARATOR "; ") as oferte_camera,
										GROUP_CONCAT(camere.id SEPARATOR "; ") as id_camera,
										GROUP_CONCAT(CONCAT(camere.id,IFNULL(CONCAT("+",oferte.id),"")) SEPARATOR "; ") as id_camera_oferta,
										SUM(camere.pret) as pret_standard,
										DATEDIFF(rezervari.data_sfarsit,rezervari.data_inceput) as numar_zile,
										oferte.id as id_oferta,
										oferte.nume as nume_oferta,
										SUM(IFNULL(oferte.pret,camere.pret)) as pret_oferta')
							->join("clienti","clienti.id=rezervari.fk_client")
							->join("rezervari_camera_link","rezervari_camera_link.fk_rezervare=rezervari.id")
							->join("camere","camere.id=rezervari_camera_link.fk_camera")
							->join("oferte","oferte.id=rezervari_camera_link.fk_oferta","left")
							->join("proprietati","proprietati.id=camere.fk_proprietate")
							->like($filters)
							->group_by("rezervari.id")
							->order_by($orderBy)
							->get_where("rezervari",$conditions,20,$offset);
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

		Public function adaugaRezervare($data) {

			$procesData = array(
				"fk_client" => $data['fk_client'],
				"data_inceput" => $data['data_inceput'],
				"data_sfarsit" => $data['data_sfarsit']
			);

			if (!$this->db->insert("rezervari", $procesData))
				return false;

  			$fK_rezervare = $this->db->insert_id();

			$procesData2 = array();

			foreach($data["fk_camera"] as $link) {
				$parts = explode("+",$link);
				if (!isset($parts[1]))
					$parts[1] = -1;
				array_push($procesData2,
					array(
						"fk_camera"=>$parts[0],
						"fk_rezervare"=>$fK_rezervare,
						"fk_oferta"=>$parts[1]
					)
				);
			}

			if ($this->db->insert_batch('rezervari_camera_link',$procesData2))
				return true;

		}

		Public function modificaRezervare($data) {

			$procesData = array(
				"fk_client" => $data['fk_client'],
				"data_inceput" => $data['data_inceput'],
				"data_sfarsit" => $data['data_sfarsit']
			);

			$procesData2 = array();

			foreach($data["fk_camera"] as $link) {
				$parts = explode("+",$link);
				if (!isset($parts[1]))
					$parts[1] = -1;
				array_push($procesData2,
					array(
						"fk_camera"=>$parts[0],
						"fk_rezervare"=>$data['id'],
						"fk_oferta"=>$parts[1]
					)
				);
			}

			if ($this->db->where('id',$data['id'])->update('rezervari', $procesData) && 
				$this->db->delete('rezervari_camera_link',"fK_rezervare = ".$data['id']) &&
				$this->db->insert_batch("rezervari_camera_link",$procesData2))
				return true;
			
		}

		Public function stergeRezervare($id) {

			if ($this->db->delete("rezervari", "id = ".$id) &&
				$this->db->delete("rezervari_camera_link", "fK_rezervare = ".$id))
				return true;

		}

		Public function proprietati($conditions) {

			return $this->db->select('id,nume')->get_where("proprietati",$conditions)->result();

		}

		Public function camere($conditions) {

			return $this->db->select('camere.id,camere.numar,camere.pret,camere.fk_proprietate')
							->join("proprietati","proprietati.id=camere.fk_proprietate")
							->get_where("camere",$conditions)->result();

		}

		Public function camereSiOferte($conditions) {

			$this->load->helper('sort_helper');

			$result = array_merge(
				$this->db->select('camere.id,camere.numar,camere.numar as group_numar,camere.pret,camere.fk_proprietate')
				->join("proprietati","proprietati.id=camere.fk_proprietate")
				->get_where("camere",$conditions)->result(),
				$this->db->select('CONCAT(camere.id,"+",oferte.id) as id,CONCAT(camere.numar," - Cu Oferta - ",oferte.nume) as numar,camere.numar as group_numar,oferte.pret as pret,camere.fk_proprietate')
				->join("proprietati","proprietati.id=camere.fk_proprietate")
				->join("oferte_camera_link","oferte_camera_link.fk_camera=camere.id")
				->join("oferte","oferte.id=oferte_camera_link.fk_oferta")
				->get_where("camere",$conditions)->result()
			);

			usort($result,"sortareNumarCamere");

			return $result;

		}

		Public function oferte($conditions) {

			return $this->db->select('oferte.id,oferte.nume,oferte.pret')
							->join("oferte_camera_link","oferte_camera_link.fk_oferta=oferte.id")
							->join("camere","camere.id=oferte_camera_link.fk_camera")
							->join("proprietati","proprietati.id=camere.fk_proprietate")
							->get_where("oferte",$conditions)->result();

		}

		Public function clienti($conditions = array(),$page = 1,$filters = array(),$orderBy = "") {

			$this->load->helper('strings');

			foreach ($filters as $key => $value) {

				$new_key = str_replace_first("_",".",$key);
				$filters[$new_key] = $filters[$key];
				unset($filters[$key]);

			}

			$offset = ($page - 1) * 20; 

			$count = $this->db->select('id')
							->from('clienti')
							->like($filters)
							->where($conditions)
							->count_all_results();
			$pages = ceil($count / 20);

			$query = $this->db->select('*')
							->like($filters)
							->order_by($orderBy)
							->get_where("clienti",$conditions,20,$offset);
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

		Public function adaugaClient($data) {

			if ($this->db->insert("clienti", $data))
				return $this->db->insert_id();
			else
				return false;

		}

		Public function modificaClient($data) {

			if ($this->db->where('id',$data['id'])->update('clienti', $data))
				return true;

		}

		Public function stergeClient($id) {

			if ($this->db->delete("clienti", "id = ".$id))
				return true;

		}

	} 
?>