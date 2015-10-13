<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class consultor extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/consultor
	 *	- or -
	 * 		http://example.com/index.php/consultor/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/consultor/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		$this->masterpage->use_session_info();
		$this->load->model('cao_fatura_model', 'cao_fatura');
	}

	public function index() {

		$this->masterpage->view('view_dashboard');

	}

	public function ajax_get_relatorio($tipo_relatorio) {

		$post = $this->input->post();

		//Selectiona formato de relatorio, conforme vaor $tipo_relatorio:
		// 0 - tabela | 1 - Gráfico Barra | 2 - Pizza.
		$relatorio = $this->cao_fatura->get_relatorio_consultor($post["peopleList"], $tipo_relatorio);

		//var_dump_pretty($relatorio);

		$data = array(
			"relatorio" => $relatorio->dataset,
			"maxY"      => $relatorio->maxY,
		);

		$this->load->view('view_people_'.$tipo_relatorio, $data);

	}

	public function relatorio() {

		$record_consultores = $this->cao_usuario_model->list_consultor();

		$data = array(
			"title"          => "Consultores",
			"records"        => $record_consultores,
			"tipo_relatorio" => "report",
			"ajax_data_type" => "html",

		);

		$this->masterpage->view('view_report', $data);
	}

	public function grafico() {

		$record_consultores = $this->cao_usuario_model->list_consultor();

		$data = array(
			"title"          => "Consultores",
			"records"        => $record_consultores,
			"tipo_relatorio" => "chart",
			"ajax_data_type" => "html",

		);

		//$this->load->view('view_test_graph', $data);

		$this->masterpage->view('view_report', $data);

	}

	public function pizza() {

		$record_consultores = $this->cao_usuario_model->list_consultor();

		$data = array(
			"title"          => "Consultores",
			"graphics_js"    => false,
			"records"        => $record_consultores,
			"tipo_relatorio" => "pie",

		);

		$this->masterpage->view('view_report', $data);

	}

}

/* End of file consultor.php */
/* Location: ./application/controllers/consultor.php */