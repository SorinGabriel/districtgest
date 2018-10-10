<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camere extends CI_Controller {

	public function index()
	{

		if (!$this->checkLogin()) 
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));
		$data['user'] = $user_data[0];

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$data['title'] = 'Camere';
		$data['controller'] = 'camere';
		$data['page'] = 'rooms-page';

		if (!$this->checkApi()) {
			$this->load->view('general/head',$data);
			$this->load->view('general/navigation',$data);
		}

		$this->load->model("CamereModel");

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

		$data['complete-data'] = $this->CamereModel->camere($conditions,$page,$filters,$orderBy);
		$data['proprietati'] = $this->CamereModel->proprietati($conditions);
		$data['data'] = $data['complete-data']['data'];
		$data['total'] = $data['complete-data']['total'];

		if (!$this->checkApi()) {
			$this->load->view("camere/camere",$data);
			$this->load->view("camere/modals/adauga-camera");
			$this->load->view("camere/modals/sterge-camera");
			$this->load->view("camere/modals/modifica-camera");
			$this->load->view('general/footer');
		}
		else
			echo json_encode($data['complete-data']);

	}

	public function adaugaCamera()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("CamereModel");

		$_POST = $this->security->xss_clean($_POST);

		if ($this->CamereModel->adaugaCamera($_POST))
			redirect('camere/index');
		else 
			echo 'EROARE LA ADAUGARE CAMERA';

	}

	public function modificaCamera()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("CamereModel");

		$id = $this->uri->segment(3,1);

		$_POST['id'] = $id;

		$_POST = $this->security->xss_clean($_POST);

		if ($this->CamereModel->modificaCamera($_POST))
			redirect('camere/index');
		else 
			echo 'EROARE LA MODIFICARE CAMERA';

	}

	public function stergeCamera()
	{
		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("CamereModel");

		$id = $this->uri->segment(3,1);

		$id = $this->security->xss_clean($id);

		if ($this->CamereModel->stergeCamera($id)) {
			redirect('camere/index');
		}
		else
			echo 'EROARE LA STERGERE CAMERA';

	}

	public function oferte()
	{

		if (!$this->checkLogin()) 
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));
		$data['user'] = $user_data[0];

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$data['title'] = 'Oferte';
		$data['controller'] = 'oferte';
		$data['page'] = 'deals-page';

		if (!$this->checkApi()) {
			$this->load->view('general/head',$data);
			$this->load->view('general/navigation',$data);
		}

		$this->load->model("CamereModel");

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

		$data['complete-data'] = $this->CamereModel->oferte($conditions,$page,$filters,$orderBy);
		$data['camere'] = $this->CamereModel->camere($conditions)['data'];
		$data['proprietati'] = $this->CamereModel->proprietati($conditions);
		$data['data'] = $data['complete-data']['data'];
		$data['total'] = $data['complete-data']['total'];

		if (!$this->checkApi()) {
			$this->load->view("camere/oferte",$data);
			$this->load->view("camere/modals/adauga-oferta");
			$this->load->view("camere/modals/sterge-oferta");
			$this->load->view("camere/modals/modifica-oferta");
			$this->load->view('general/footer');
		}
		else
			echo json_encode($data['complete-data']);

	}

	public function adaugaOferta()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("CamereModel");

		$_POST = $this->security->xss_clean($_POST);

		if ($this->CamereModel->adaugaOferta($_POST))
			redirect('camere/oferte');
		else 
			echo 'EROARE LA ADAUGARE OFERTA';

	}

	public function modificaOferta()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("CamereModel");

		$id = $this->uri->segment(3,1);

		$_POST['id'] = $id;

		$_POST = $this->security->xss_clean($_POST);

		if ($this->CamereModel->modificaOferta($_POST))
			redirect('camere/oferte');
		else 
			echo 'EROARE LA MODIFICARE OFERTA';

	}

	public function stergeOferta()
	{
		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("CamereModel");

		$id = $this->uri->segment(3,1);

		$id = $this->security->xss_clean($id);

		if ($this->CamereModel->stergeOferta($id)) {
			redirect('camere/oferte');
		}
		else
			echo 'EROARE LA STERGERE OFERTA';

	}

	private function checkLogin() {

		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');

		return $this->LoginModel->connect($username,$password);

	}

	private function user_restrict($user_data) {

		return ($user_data[0]->{"drept_camere"} == 1 ? TRUE : FALSE);

	}

	private function checkApi() {

		$api = $this->uri->segment(3,1);

		return ($api == "api" ? TRUE : FALSE);

	}

}
