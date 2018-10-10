<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index($err = NULL)
	{

		if ($this->checkLogin())
			redirect('/homepage');

		$data['title'] = 'Login';
		$data['page'] = 'login-page';
		$data['error'] = $err;

		$this->load->view('general/head',$data);
		$this->load->view('login/loginpage',$data);

	}
	public function try() {

		$_POST = $this->security->xss_clean($_POST);

		if (empty($_POST['username']) && empty($_POST['password']))
			$this->index("Nu ati completat datele"); 
		
		if (!$this->LoginModel->connect($_POST['username'],$_POST['password']))
			$this->index("Date de conectare gresite");
		else
			$this->saveSession();

	}
	private function saveSession() {

		$_POST = $this->security->xss_clean($_POST);

		$sessiondata = array( 
		   'username'  => $_POST['username'], 
		   'password'  => $_POST['password']
		);  

		$this->session->set_userdata($sessiondata);

		redirect('/homepage');

	}
	private function checkLogin() {

		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');

		return $this->LoginModel->connect($username,$password);
		
	}
}
