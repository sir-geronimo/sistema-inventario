<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuarios_m', 'um');
	}

	public function index()	{
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}

		redirect(base_url('inicio/home'),'refresh');
	}

	public function login() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				$this->load->view('usuarios/login');
			}
		} else {
			$this->load->view('usuarios/login');
		}

		if(isset($this->session->logged)) {
			if($this->session->logged === TRUE && $this->session->logged !== NULL) {
				redirect(base_url('inicio/home'),'refresh');				
			}
		}
	}

	public function home() {
		if(isset($this->session->logged)) {
			if($this->session->logged !== TRUE && $this->session->logged === NULL) {
				redirect(base_url('inicio/login'),'refresh');
			}
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}

		$this->load->view('dashboard');
	}
}
