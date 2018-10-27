<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('usuarios_m', 'um');
	}

	public function login() {
		$this->um->login();
	}

	public function register() {
		if(isset($this->session->logged)) {
			if($this->session->logged === TRUE && $this->session->logged !== NULL) {
				redirect(base_url('inicio/home'),'refresh');
			}
		} else {
			$this->load->view('usuarios/register');
		}
	}

	public function save() {
		$this->um->register();
		redirect(base_url('inicio/home'),'refresh');
	}

	public function logout() {
		$this->um->logout();
	}
}