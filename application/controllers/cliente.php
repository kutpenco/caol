<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class cliente extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/cliente
	 *	- or -
	 * 		http://example.com/index.php/cliente/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/cliente/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		$this->masterpage->use_session_info();
		$this->load->model('campaigns_model');
	}

	public function index() {

		$this->masterpage->view('admin/view_dashboard');

	}

	public function logout() {
		redirect(base_url('login/logout/'));
	}

}

/* End of file cliente.php */
/* Location: ./application/controllers/cliente.php */