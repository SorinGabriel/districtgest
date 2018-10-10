<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function index()
	{

		if (!$this->checkLogin()) 
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));
		$data['user'] =$user_data[0];

		$data['title'] = 'Prima Pagina';
		$data['page'] = 'home-page';

		$this->load->view('general/head',$data);
		$this->load->view('general/navigation',$data);

	}
	public function logout() {

		$this->session->sess_destroy();
		redirect("/");

	}
	private function checkLogin() {

		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');

		return $this->LoginModel->connect($username,$password);
		
	}

}
