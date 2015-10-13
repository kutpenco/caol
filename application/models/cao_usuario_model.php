<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class cao_usuario_model extends MY_Model {

	public function cao_usuario_model() {
		parent::__construct();
		$this->_table      = 'cao_usuario';
		$this->primary_key = 'co_usuario';
	}

	public function list_consultor($filter_in = null) {

		$query = $this->db
		              ->select("u.co_usuario, u.no_usuario, s.brut_salario")
		              ->from("cao_usuario as u")
		              ->join("permissao_sistema as p", "u.co_usuario = p.co_usuario")
		              ->join("cao_salario as s", "s.co_usuario = u.co_usuario", "left")
		              ->where("p.co_sistema", 1)
		              ->where("p.in_ativo", "S")
		              ->where_in("p.co_sistema", array(0, 1, 2));

		if ($filter_in != null) {

			$query = $query->where_in("p.co_usuario", $filter_in);

		}

		$query = $query->get();

		if ($query && $query->num_rows > 0) {
			return $query->result();

		}
	}

	public function count_record() {
		return $this->db->count_all('users');
	}

	public function init() {

		$fields = $this->db->list_fields($this->_table);
		$row    = new stdClass();

		foreach ($fields as $field) {
			$row->$field = "";
		}

		$row->action_title = 'Novo';

		return $row;
	}

	private function _remove_sensitive_data($userObj) {

		if (isset($userObj->ds_senha)) {
			unset($userObj->ds_senha);
		}

		return $userObj;
	}

	private function _get_user_from_db($id) {

		$userObj = parent::get($id);

		if ($userObj) {
			return $this->_remove_sensitive_data($userObj);
		}

		return false;
	}

	public function get_auth() {
		$usr_auth = $this->session->userdata('user');

		if ($usr_auth) {

			return $this->_get_user_from_db($usr_auth["username"]);

		}

		return false;
	}

	public function save_to_cookies() {

		$post = $this->input->post();

		if ($post) {

			set_custom_cookie("username", $post["inputUser"]);

		}

	}

	public function searchUserByLoginPass($login, $password) {

		$criteria = array(
			'co_usuario' => $login,
			'ds_senha'   => md5($password),
		);

		$query = $this->get_by($criteria);

		return $this->_remove_sensitive_data($query);
	}

	public function get_auth_user() {

		$user_session = $this->session->userdata("user");

		if ($user_session) {

			$obj = new stdClass();

			$obj->username = $user_session['username'];
			$obj->iduser   = $user_session['iduser'];
			$obj->fullname = $user_session['fullname'];
			$obj->fullname = $user_session['firstname'];
			$obj->user_pic = $user_session['picture'];

			return $obj;
		}

		return false;
	}
}
