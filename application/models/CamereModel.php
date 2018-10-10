<?php 
	Class CamereModel extends CI_Model {

		Public function __construct() { 
			parent::__construct(); 
		} 

		Public function camere($conditions = array(),$page = 1,$filters = array(),$orderBy = "") {

			$this->load->helper('strings');

			foreach ($filters as $key => $value) {

				$new_key = str_replace_first("_",".",$key);
				$filters[$new_key] = $filters[$key];
				unset($filters[$key]);

			}

			$offset = ($page - 1) * 20; 

			$count = $this->db->select('id')
							->join("proprietati","proprietati.id=camere.fk_proprietate")
							->from('camere')
							->like($filters)
							->where($conditions)
							->count_all_results();
			$pages = ceil($count / 20);

			$query = $this->db->select('camere.*, 
										proprietati.nume, 
										proprietati.id as id_proprietate')
							->join("proprietati","proprietati.id=camere.fk_proprietate")
							->like($filters)
							->order_by($orderBy)
							->get_where("camere",$conditions,20,$offset);
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

		Public function adaugaCamera($data) {

			if ($this->db->insert("camere", $data))
				return true;

		}

		Public function modificaCamera($data) {

			if ($this->db->where('id',$data['id'])->update('camere', $data))
				return true;

		}

		Public function stergeCamera($id) {

			if ($this->db->delete("camere", "id = ".$id))
				return true;

		}

		Public function proprietati($conditions) {

			return $this->db->select('id,nume')->get_where("proprietati",$conditions)->result();

		}

		Public function oferte($conditions = array(),$page = 1,$filters = array(),$orderBy = "") {

			$this->load->helper('strings');

			foreach ($filters as $key => $value) {

				$new_key = str_replace_first("_",".",$key);
				$filters[$new_key] = $filters[$key];
				unset($filters[$key]);

			}

			$offset = ($page - 1) * 20; 

			$count = $this->db->select('id')
							->join("oferte_camera_link","oferte_camera_link.fk_oferta=oferte.id")
							->join("camere","camere.id=oferte_camera_link.fk_camera")
							->join("proprietati","proprietati.id=camere.fk_proprietate")
							->from('oferte')
							->like($filters)
							->where($conditions)
							->count_all_results();
			$pages = ceil($count / 20);

			$query = $this->db->select('oferte.*, 
										GROUP_CONCAT(camere.id SEPARATOR "; ") as id_camera,
										GROUP_CONCAT(camere.numar SEPARATOR "; ") as numar_camera,
										GROUP_CONCAT(camere.pret SEPARATOR "; ") as pret_camera, 
										proprietati.nume as nume_proprietate, 
										proprietati.id as id_proprietate')
							->join("oferte_camera_link","oferte_camera_link.fk_oferta=oferte.id")
							->join("camere","camere.id=oferte_camera_link.fk_camera")
							->join("proprietati","proprietati.id=camere.fk_proprietate")
							->like($filters)
							->group_by('oferte.id')
							->order_by($orderBy)
							->get_where("oferte",$conditions,20,$offset);
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

		Public function adaugaOferta($data) {

			$procesData = array(
				"nume" => $data['nume'],
				"pret" => $data['pret'],
				"data_inceput" => $data['data_inceput'],
				"data_sfarsit" => $data['data_sfarsit']
			);

			$this->db->insert("oferte", $procesData);
			$id_oferta = $this->db->insert_id();

			$procesData2 = array();

			foreach($data["fk_camera"] as $link)
				array_push($procesData2,
					array(
						"fk_camera" =>$link,
						"fk_oferta"=>$id_oferta
					)
				);

			if ($this->db->insert_batch("oferte_camera_link",$procesData2))
				return true;

		}

		Public function modificaOferta($data) {

			$procesData = array(
				"nume" => $data["nume"],
				"pret" => $data["pret"],
				"data_inceput" => $data["data_inceput"],
				"data_sfarsit" => $data["data_sfarsit"]
			);

			$procesData2 = array();

			foreach($data["fk_camera"] as $link)
				array_push($procesData2,
					array(
						"fk_camera" =>$link,
						"fk_oferta"=>$data['id']
					)
				);

			if ($this->db->where('id',$data['id'])->update('oferte', $procesData) && 
				$this->db->delete('oferte_camera_link',"fk_oferta = ".$data['id']) &&
				$this->db->insert_batch("oferte_camera_link",$procesData2))
				return true;

		}

		Public function stergeOferta($id) {

			if ($this->db->delete("oferte", "id = ".$id) && $this->db->delete("oferte_camera_link", "fk_oferta = ".$id))
				return true;

		}


	} 
?>