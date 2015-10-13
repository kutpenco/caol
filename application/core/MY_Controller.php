<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * A base controller with a support to authetication user data.
 *
 *
 * @author César Urdaneta
 * @copyright Copyright (c) 2015, César Urdaneta <http://www.betadevconsult.com.br>
 */

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->_check_auth();
	}

	private function _check_auth() {

		$method     = $this->router->fetch_method();
		$controller = $this->router->fetch_class();

		$user = $this->cao_usuario_model->get_auth();

		//var_dump_pretty($user);

		if ($user && strtolower($controller) == "login" && strtolower($controller) == "logout") {
			redirect('home');
		} else if (!$user && strtolower($controller) != "login") {
			redirect('login');

		}
	}

}