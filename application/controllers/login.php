<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class login extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	private $connection;

	public function __construct() {
		parent::__construct();

		//$this->masterpage->use_session_info();
		$this->_prepare_login();

	}

	private function _check_auth() {
		// Return previous URL, when authenticated.
		if ($this->session->userdata('user')) {
			$url = read_prev_url_cookies();
			redirect($url);
		}
	}

	private function _prepare_login() {

		$this->masterpage->header = "shared/view_header_login";
		$this->masterpage->footer = "shared/view_footer_login";

	}

	public function index() {

		store_prev_url_cookies();

		//$this->_check_auth();
		$data["error_login"] = false;

		$this->masterpage->view('view_login', $data);
	}

	public function blocked_user() {
		$data = array(
			"msg"        => "O usuário encontra-se bloqueado.<br>Favor fazer contato com a central de suporte.",
			"source_url" => "/",
		);

		$this->masterpage->view("shared/status_action", $data);

	}

	public function auth($auth_type = "") {

		$login_view = "";

		$this->form_validation->set_rules('inputUser', 'Usuário', 'trim|xss_clean');
		$this->form_validation->set_rules('inputPassword', 'Senha', 'trim|xss_clean');

		$validation = $this->form_validation->run();

		//Choose admin login view or normal login view.

		if ($validation) {
			$username = $this->input->post("inputUser");
			$password = $this->input->post("inputPassword");

			//var_dump_pretty($this->cao_usuario_model->list_consultor());

			$userObj = $this->cao_usuario_model->searchUserByLoginPass($username, $password);

			//var_dump_pretty($userObj);

			$data['error_login'] = false;
			if (!empty($userObj)) {

				//var_dump_pretty($userObj);

				//$peopleObj = $this->people_model->get($userObj->idpeople);

				// Create a session for authenticating users.
				set_session_user($username, $userObj);

				redirect('/home');

			} else {
				$data["error_login"] = "O usuário ou senha estão incorretos";
			}

		} else {

			$data["error_login"] = "O usuário ou senha estão incorretos";

		}

		$this->masterpage->view('view_login', $data);
	}

	public function logout() {
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('permissions');

		if ($this->session->userdata('google_token')) {
			$this->session->unset_userdata('google_token');
			$this->googleplus->revokeToken();
		}

		if ($this->session->userdata('twitter_access_token')) {
			$this->_twitter_reset_session();
		}

		redirect(base_url('login/'));
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */