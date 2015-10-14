<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * Classe para conexões com cliente
 * */

class cao_cliente_model extends MY_Model {

	public function cao_cliente() {
		parent::__construct();
		$this->_table      = 'cao_cliente';
		$this->primary_key = 'co_cliente';

	}

	public function list_cliente($filter_in = null) {

		$obj = new stdClass();

		$query = $this->db
		              ->select("c.co_cliente codigo, c.no_razao nome")
		              ->from("cao_cliente as c")
		              ->where("c.tp_cliente", "A");

		if ($filter_in != null) {

			$query = $query->where_in("c.co_cliente", $filter_in);

		}

		$query = $query->get();

		if ($query && $query->num_rows > 0) {
			$obj->dataset = $query->result();
			$obj->name    = "cliente";
			return $obj;
		}

		return false;
	}

}
