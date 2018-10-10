<?php 
	Class LoginModel extends CI_Model {

		Public function __construct() { 
			parent::__construct(); 
		} 

		Public function connect($username,$password) {

			$query = $this->db->get_where("utilizatori",array("utilizator"=>$username));
			$result = $query->result(); 

			if (empty($result)) return false;

			if (password_verify($password,$result[0]->{"parola"})) return true;

			return false;
		}

		Public function getUserData($username) {

			$query = $this->db->get_where("utilizatori",array("utilizator"=>$username));
			$result = $query->result(); 

			return $result;

		}

	} 
?>