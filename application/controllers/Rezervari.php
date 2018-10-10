<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rezervari extends CI_Controller {

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

		$data['title'] = 'Rezervari';
		$data['controller'] = 'rezervari';
		$data['page'] = 'reservations-page';

		if (!$this->checkApi()) {
			$this->load->view('general/head',$data);
			$this->load->view('general/navigation',$data);
		}

		$this->load->model("RezervariModel");

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
		$conditions2["clienti.fk_companie"] = $user_data[0]->{"fk_companie"};

		$data['complete-data'] = $this->RezervariModel->rezervari($conditions,$page,$filters,$orderBy);
		$data['proprietati'] = $this->RezervariModel->proprietati($conditions);
		$data['camere'] = $this->RezervariModel->camere($conditions);
		$data['camereSiOferte'] = $this->RezervariModel->camereSiOferte($conditions);
		$data['oferte'] = $this->RezervariModel->oferte($conditions);
		$data['clienti'] = $this->RezervariModel->clienti($conditions2)['data'];
		$data['data'] = $data['complete-data']['data'];
		$data['total'] = $data['complete-data']['total'];

		if (!$this->checkApi()) {
			$this->load->view("rezervari/rezervari",$data);
			$this->load->view("rezervari/modals/adauga-rezervare");
			$this->load->view("rezervari/modals/sterge-rezervare");
			$this->load->view("rezervari/modals/modifica-rezervare");
			$this->load->view("rezervari/modals/adauga-client");
			$this->load->view('general/footer');
		}
		else
			echo json_encode($data['complete-data']);

	}

	public function adaugaRezervare()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("RezervariModel");

		$_POST = $this->security->xss_clean($_POST);

		if ($this->RezervariModel->adaugaRezervare($_POST))
			redirect('rezervari/index');
		else 
			echo 'EROARE LA ADAUGARE REZERVARE';

	}

	public function modificaRezervare()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("RezervariModel");

		$id = $this->uri->segment(3,1);

		$_POST['id'] = $id;

		$_POST = $this->security->xss_clean($_POST);

		if ($this->RezervariModel->modificaRezervare($_POST))
			redirect('rezervari/index');
		else 
			echo 'EROARE LA MODIFICARE REZERVARE';

	}

	public function stergeRezervare()
	{
		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("RezervariModel");

		$id = $this->uri->segment(3,1);

		$id = $this->security->xss_clean($id);

		if ($this->RezervariModel->stergeRezervare($id)) {
			redirect('rezervari/index');
		}
		else
			echo 'EROARE LA STERGERE REZERVARE';

	}

	public function clienti()
	{

		if (!$this->checkLogin()) 
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));
		$data['user'] = $user_data[0];

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$data['title'] = 'Clienti';
		$data['controller'] = 'clienti';
		$data['page'] = 'clients-page';

		if (!$this->checkApi()) {
			$this->load->view('general/head',$data);
			$this->load->view('general/navigation',$data);
		}

		$this->load->model("RezervariModel");

		if ($this->checkApi())
			$page = $this->uri->segment(4,1);
		else
			$page = $this->uri->segment(3,1);

		$page = $this->security->xss_clean($page);
		$_POST = $this->security->xss_clean($_POST);

		$orderBy = (isset($_POST['orderby']) ? $_POST['orderby'] : '');

		unset($_POST['orderby']);
		$filters = $_POST;
		$conditions["clienti.fk_companie"] = $user_data[0]->{"fk_companie"};

		$data['complete-data'] = $this->RezervariModel->clienti($conditions,$page,$filters,$orderBy);
		$data['data'] = $data['complete-data']['data'];
		$data['total'] = $data['complete-data']['total'];

		if (!$this->checkApi()) {
			$this->load->view("rezervari/clienti",$data);
			$this->load->view("rezervari/modals/adauga-client");
			$this->load->view("rezervari/modals/sterge-client");
			$this->load->view("rezervari/modals/modifica-client");
			$this->load->view('general/footer');
		}
		else
			echo json_encode($data['complete-data']);

	}

	public function adaugaClient()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("RezervariModel");

		$_POST["fk_companie"] = $user_data[0]->{"fk_companie"};

		$_POST = $this->security->xss_clean($_POST);

		$id = $this->RezervariModel->adaugaClient($_POST);

		if ($id) {
			if (!$this->checkApi())
				redirect('rezervari/clienti');
			else {
				$_POST['id'] = $id;
				echo json_encode($_POST);
			}
		}
		else 
			echo 'EROARE LA ADAUGARE CLIENTI';

	}

	public function modificaClient()
	{

		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("RezervariModel");

		$id = $this->uri->segment(3,1);

		$_POST['id'] = $id;

		$_POST = $this->security->xss_clean($_POST);

		if ($this->RezervariModel->modificaClient($_POST))
			redirect('rezervari/clienti');
		else 
			echo 'EROARE LA MODIFICARE CLIENT';

	}

	public function stergeClient()
	{
		if (!$this->checkLogin())
			redirect('/');

		$user_data = $this->LoginModel->getUserData($this->session->userdata('username'));

		if (!$this->user_restrict($user_data)) {
			$this->load->view('general/unauthorized');
			return 0;
		}

		$this->load->model("RezervariModel");

		$id = $this->uri->segment(3,1);

		$id = $this->security->xss_clean($id);

		if ($this->RezervariModel->stergeClient($id)) {
			redirect('rezervari/clienti');
		}
		else
			echo 'EROARE LA STERGERE CLIENT';

	}

	private function checkLogin() {

		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');

		return $this->LoginModel->connect($username,$password);

	}

	private function user_restrict($user_data) {

		return ($user_data[0]->{"drept_rezervari"} == 1 ? TRUE : FALSE);

	}

	private function checkApi() {

		$api = $this->uri->segment(3,1);

		return ($api == "api" ? TRUE : FALSE);

	}

}
