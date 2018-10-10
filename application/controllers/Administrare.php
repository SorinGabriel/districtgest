<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrare extends CI_Controller {

	public function utilizatori()
	{

		if (!$this->checkLogin()) 
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));
		$data['user'] = $user_data[0];

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$data['title'] = 'Utilizatori';
		$data['controller'] = 'utilizatori';
		$data['page'] = 'users-page';

		if (!$this->checkApi()) {
			$this->load->view('general/head',$data);
			$this->load->view('general/navigation',$data);
		}

		$this->load->model("AdministrareModel");

		if ($this->checkApi())
			$page = $this->uri->segment(4,1);
		else
			$page = $this->uri->segment(3,1);

		$page = $this->security->xss_clean($page);
		$_POST = $this->security->xss_clean($_POST);

		$orderBy = (isset($_POST['orderby']) ? $_POST['orderby'] : '');

		unset($_POST['orderby']);
		$filters = $_POST;
		$conditions["fk_companie"] = $user_data[0]->{"fk_companie"};

		$data['complete-data'] = $this->AdministrareModel->utilizatori($conditions,$page,$filters,$orderBy);
		$data['data'] = $data['complete-data']['data'];
		$data['total'] = $data['complete-data']['total'];

		if (!$this->checkApi()) {
			$this->load->view("administrare/utilizatori",$data);
			$this->load->view("administrare/modals/adauga-utilizator");
			$this->load->view("administrare/modals/sterge-utilizator");
			$this->load->view("administrare/modals/modifica-utilizator");
			$this->load->view("administrare/modals/drepturi-utilizator");
			$this->load->view('general/footer');
		}
		else
			echo json_encode($data['complete-data']);

	}

	public function adaugaUtilizator()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("AdministrareModel");

		$_POST['fk_companie'] = $user_data[0]->{"fk_companie"};

		$_POST = $this->security->xss_clean($_POST);

		if ($this->AdministrareModel->adaugaUtilizator($_POST))
			redirect('administrare/utilizatori');
		else 
			echo 'EROARE LA ADAUGARE UTILIZATOR';

	}

	public function modificaUtilizator()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("AdministrareModel");

		$id = $this->uri->segment(3,1);

		$_POST['id'] = $id;

		$_POST = $this->security->xss_clean($_POST);

		if ($this->AdministrareModel->modificaUtilizator($_POST))
			redirect('administrare/utilizatori');
		else 
			echo 'EROARE LA MODIFICARE UTILIZATOR';

	}

	public function modificaDrepturiUtilizator()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("AdministrareModel");

		$id = $this->uri->segment(3,1);

		$_POST['id'] = $id;

		unset($_POST['submit']);

		$_POST = $this->security->xss_clean($_POST);

		if ($this->AdministrareModel->modificaDrepturiUtilizator($_POST))
			redirect('administrare/utilizatori');
		else 
			echo 'EROARE LA MODIFICARE UTILIZATOR';

	}

	public function stergeUtilizator()
	{
		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("AdministrareModel");

		$id = $this->uri->segment(3,1);

		$id = $this->security->xss_clean($id);

		if ($this->AdministrareModel->stergeUtilizator($id)) {
			redirect('administrare/utilizatori');
		}
		else
			echo 'EROARE LA STERGERE UTILIZATOR';

	}

	public function proprietati()
	{

		if (!$this->checkLogin()) 
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));
		$data['user'] = $user_data[0];

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$data['title'] = 'Proprietati';
		$data['controller'] = 'proprietati';
		$data['page'] = 'proprietati-page';

		if (!$this->checkApi()) {
			$this->load->view('general/head',$data);
			$this->load->view('general/navigation',$data);
		}

		$this->load->model("AdministrareModel");

		if ($this->checkApi())
			$page = $this->uri->segment(4,1);
		else
			$page = $this->uri->segment(3,1);

		$page = $this->security->xss_clean($page);
		$_POST = $this->security->xss_clean($_POST);

		$orderBy = (isset($_POST['orderby']) ? $_POST['orderby'] : '');

		unset($_POST['orderby']);
		$filters = $_POST;
		$conditions["proprietati.fk_companie"] = $user_data[0]->{"fk_companie"};

		$data['complete-data'] = $this->AdministrareModel->proprietati($conditions,$page,$filters,$orderBy);
		$data['tipProprietati'] = $this->AdministrareModel->tipProprietati();
		$data['data'] = $data['complete-data']['data'];
		$data['total'] = $data['complete-data']['total'];

		if (!$this->checkApi()) {
			$this->load->view("administrare/proprietati",$data);
			$this->load->view("administrare/modals/adauga-proprietate",$data);
			$this->load->view("administrare/modals/sterge-proprietate",$data);
			$this->load->view("administrare/modals/modifica-proprietate",$data);
			$this->load->view('general/footer');
		}
		else
			echo json_encode($data['complete-data']);

	}

	public function adaugaProprietate()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("AdministrareModel");

		$_POST['fk_companie'] = $user_data[0]->{"fk_companie"};

		$_POST = $this->security->xss_clean($_POST);

		if ($this->AdministrareModel->adaugaProprietate($_POST))
			redirect('administrare/proprietati');
		else 
			echo 'EROARE LA ADAUGARE PROPRIETATE';

	}

	public function modificaProprietate()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("AdministrareModel");

		$id = $this->uri->segment(3,1);

		$_POST['id'] = $id;

		$_POST = $this->security->xss_clean($_POST);

		if ($this->AdministrareModel->modificaProprietate($_POST))
			redirect('administrare/proprietati');
		else 
			echo 'EROARE LA MODIFICARE PROPRIETATE';

	}

	public function stergeProprietate()
	{
		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("AdministrareModel");

		$id = $this->uri->segment(3,1);

		$id = $this->security->xss_clean($id);

		if ($this->AdministrareModel->stergeProprietate($id)) {
			redirect('administrare/proprietati');
		}
		else
			echo 'EROARE LA STERGERE PROPRIETATE';

	}	

	private function checkLogin() {

		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');

		return $this->LoginModel->connect($username,$password);

	}

	private function user_restrict($user_data) {

		return ($user_data[0]->{"drept_administrare"} == 1 ? TRUE : FALSE);

	}

	private function checkApi() {

		$api = $this->uri->segment(3,1);

		return ($api == "api" ? TRUE : FALSE);

	}

}
