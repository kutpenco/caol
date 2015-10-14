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
		$this->load->model('cao_fatura_model', 'cao_fatura');
		$this->load->model('cao_cliente_model', 'cao_cliente');
	}

	public function index() {

		$this->masterpage->view('view_dashboard');

	}

	public function ajax_get_relatorio($tipo_relatorio) {

		$post = $this->input->post();

		if ($post) {
			$record_consultores = $this->cao_cliente->list_cliente($post["peopleList"]);
		} else {
			$record_consultores = false;
		}

		//Selectiona formato de relatorio, conforme vaor $tipo_relatorio:
		// 0 - tabela | 1 - Gráfico Barra | 2 - Pizza.
		$relatorio = $this->cao_fatura->get_relatorio($record_consultores, $tipo_relatorio);
		//var_dump_pretty($relatorio);

		if ($relatorio) {
			$data = array(
				"relatorio" => $relatorio->dataset,
				"maxY"      => $relatorio->maxY,
			);
		} else {
			$data = array(
				"relatorio" => false,
			);
		}

		$this->load->view('view_people_'.$tipo_relatorio, $data);

	}

	public function relatorio() {

		$record_clientes = $this->cao_cliente->list_cliente();

		$data = array(
			"title"          => "clientes",
			"controller"     => $this->router->fetch_class(),
			"records"        => $record_clientes->dataset,
			"tipo_relatorio" => "report",
			"ajax_data_type" => "html",

		);

		$this->masterpage->view('view_report', $data);
	}

	public function grafico() {

		$record_clientes = $this->cao_cliente->list_cliente();

		$data = array(
			"title"          => "clientes",
			"controller"     => $this->router->fetch_class(),
			"records"        => $record_clientes->dataset,
			"tipo_relatorio" => "chart",
			"ajax_data_type" => "html",

		);

		//$this->load->view('view_test_graph', $data);

		$this->masterpage->view('view_report', $data);

	}

	public function pizza() {

		$record_clientes = $this->cao_cliente->list_cliente();

		$data = array(
			"title"          => "clientes",
			"controller"     => $this->router->fetch_class(),
			"graphics_js"    => false,
			"records"        => $record_clientes->dataset,
			"tipo_relatorio" => "pie",

		);

		$this->masterpage->view('view_report', $data);

	}

}

/* End of file cliente.php */
/* Location: ./application/controllers/cliente.php */